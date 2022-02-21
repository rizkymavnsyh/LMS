<?php
/**
 * Plugin Name: LearnPress - Paid Membership Pro Integration
 * Plugin URI: http://thimpress.com/learnpress
 * Description: Paid Membership Pro add-on for LearnPress.
 * Author: ThimPress
 * Version: 4.0.1
 * Author URI: http://thimpress.com
 * Tags: learnpress, lms
 * Text Domain: learnpress-paid-membership-pro
 * Domain Path: /languages/
 * Require_LP_Version: 4.0.0
 *
 * @package learnpress-paid-membership
 */

defined( 'ABSPATH' ) || exit;

define( 'LP_ADDON_PMPRO_PATH', dirname( __FILE__ ) );
define( 'LP_ADDON_PMPRO_BASE_NAME', plugin_basename( __FILE__ ) );
define( 'LP_ADDON_PMPRO_FILE', __FILE__ );
define( 'LP_ADDON_PMPRO_URL', plugin_dir_url( __FILE__ ) );
define( 'LP_ADDON_PMPRO_TEMP', LP_ADDON_PMPRO_PATH . DIRECTORY_SEPARATOR . 'templates' );
define( 'GMC_PHYS_PATH',
	trailingslashit( WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) ) );

/**
 * Class LP_Addon_Paid_Memberships_Pro_Preload
 */
class LP_Addon_Paid_Memberships_Pro_Preload {
	public static $addon_info = array();
	protected static $_instance;
	public static $_WP_CRON_STATUS = true;

	/**
	 * LP_Addon_Paid_Memberships_Pro_Preload constructor.
	 */
	protected function __construct() {
		$can_load = true;
		// Set version addon for LP check .
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		self::$addon_info = get_file_data(
			LP_ADDON_PMPRO_FILE,
			array(
				'Name'               => 'Plugin Name',
				'Require_LP_Version' => 'Require_LP_Version',
				'Version'            => 'Version',
			)
		);

		define( 'LP_ADDON_PMPRO_VER', self::$addon_info['Version'] );
		define( 'LP_ADDON_PMPRO_REQUIRE_VER', self::$addon_info['Require_LP_Version'] );

		// Check LP activated .
		if ( ! is_plugin_active( 'learnpress/learnpress.php' ) ) {
			$can_load = false;
		} elseif ( version_compare( LP_ADDON_PMPRO_REQUIRE_VER, get_option( 'learnpress_version', '3.0.0' ), '>' ) ) {
			$can_load = false;
		}

		if ( ! $can_load ) {
			add_action( 'admin_notices', array( $this, 'show_note_errors_require_lp' ) );
			deactivate_plugins( LP_ADDON_PMPRO_BASE_NAME );

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			return;
		}

		// Sure LP loaded.
		add_action( 'learn-press/ready', array( $this, 'load' ) );

		if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
			self::$_WP_CRON_STATUS = false;
		}
	}

	/**
	 * Load addon
	 */
	public function load() {
		LP_Addon::load( 'LP_Addon_Paid_Memberships_Pro', 'inc/load.php', __FILE__ );
		$GLOBALS['lpAddonPaidMembershipsPro'] = LP_Addon::$instances['LP_Addon_Paid_Memberships_Pro'];

		include 'inc/classes/class-lp-pms-db.php';
		include 'inc/classes/class-lp-pms-ajax.php';
		include 'inc/classes/class-lp-pms-handle-curl.php';
		include 'inc/classes/class-lp-pms-woo.php';
	}

	public function show_note_errors_require_lp() {
		?>
		<div class="notice notice-error">
			<p><?php echo( 'Please active <strong>LP version ' . LP_ADDON_PMPRO_REQUIRE_VER . ' or later</strong> before active <strong>' . self::$addon_info['Name'] . '</strong>' ); ?></p>
		</div>
		<?php
	}

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
}

$GLOBALS['LP_Addon_Paid_Memberships_Pro_Preload'] = LP_Addon_Paid_Memberships_Pro_Preload::instance();
