<?php
/**
 * Plugin Name: LearnPress - Offline Payment
 * Plugin URI: http://thimpress.com/learnpress
 * Description: Make a payment with cash.
 * Author: ThimPress
 * Version: 4.0.2
 * Author URI: http://thimpress.com
 * Tags: learnpress
 * Text Domain: learnpress-offline-payment
 * Domain Path: /languages/
 * Require_LP_Version: 3.0.0
 *
 * @package LearnPress-Offline-Payment
 */

defined( 'ABSPATH' ) || exit;

define( 'LP_ADDON_OFFLINE_PAYMENT_FILE', __FILE__ );


/**
 * Class LP_Addon_Offline_Payment_Preload
 */
class LP_Addon_Offline_Payment_Preload {
	/**
	 * @var array
	 */
	public static $addon_info = array();

	/**
	 * LP_Addon_Offline_Payment_Preload constructor.
	 */
	public function __construct() {
		// Set Base name plugin.
		define( 'LP_ADDON_OFFLINE_PAYMENT_BASENAME', plugin_basename( LP_ADDON_OFFLINE_PAYMENT_FILE ) );

		// Set version addon for LP check .
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		self::$addon_info = get_file_data(
			LP_ADDON_OFFLINE_PAYMENT_FILE,
			array(
				'Name'               => 'Plugin Name',
				'Require_LP_Version' => 'Require_LP_Version',
				'Version'            => 'Version',
			)
		);

		define( 'LP_ADDON_OFFLINE_PAYMENT_VER', self::$addon_info['Version'] );
		define( 'LP_ADDON_OFFLINE_PAYMENT_REQUIRE_VER', self::$addon_info['Require_LP_Version'] );

		// Check LP activated .
		if ( ! is_plugin_active( 'learnpress/learnpress.php' ) ) {
			add_action( 'admin_notices', array( $this, 'show_note_errors_require_lp' ) );

			deactivate_plugins( LP_ADDON_OFFLINE_PAYMENT_BASENAME );

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			return;
		}

		// Sure LP loaded.
		add_action( 'learn-press/ready', array( $this, 'load' ) );
	}

	/**
	 * Load addon
	 */
	public function load() {
		LP_Addon::load( 'LP_Addon_Offline_Payment', 'inc/load.php', __FILE__ );
	}

	public function show_note_errors_require_lp() {
		?>
		<div class="notice notice-error">
			<p><?php echo( 'Please active <strong>LP version ' . LP_ADDON_OFFLINE_PAYMENT_REQUIRE_VER . ' or later</strong> before active <strong>' . self::$addon_info['Name'] . '</strong>' ); ?></p>
		</div>
		<?php
	}
}

new LP_Addon_Offline_Payment_Preload();
