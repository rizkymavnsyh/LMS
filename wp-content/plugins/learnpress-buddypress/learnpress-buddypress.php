<?php
/**
 * Plugin Name: LearnPress - BuddyPress Integration
 * Plugin URI: http://thimpress.com/learnpress
 * Description: Using the profile system provided by BuddyPress.
 * Author: ThimPress
 * Version: 4.0.0
 * Author URI: http://thimpress.com
 * Tags: learnpress, lms, add-on, buddypress
 * Text Domain: learnpress-buddypress
 * Domain Path: /languages/
 * Require_LP_Version: 3.0.0
 *
 * @package learnpress-buddypress
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

define( 'LP_ADDON_BUDDYPRESS_FILE', __FILE__ );

/**
 * Class LP_Addon_BuddyPress_Preload
 */
class LP_Addon_BuddyPress_Preload {
	/**
	 * @var array
	 */
	public static $addon_info = array();

	/**
	 * LP_Addon_BuddyPress_Preload constructor.
	 */
	public function __construct() {
		// Set Base name plugin.
		define( 'LP_ADDON_BUDDYPRESS_BASENAME', plugin_basename( LP_ADDON_BUDDYPRESS_FILE ) );

		// Set version addon for LP check .
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		self::$addon_info = get_file_data(
			LP_ADDON_BUDDYPRESS_FILE,
			array(
				'Name'               => 'Plugin Name',
				'Require_LP_Version' => 'Require_LP_Version',
				'Version'            => 'Version',
			)
		);

		define( 'LP_ADDON_BUDDYPRESS_VER', self::$addon_info['Version'] );
		define( 'LP_ADDON_BUDDYPRESS_REQUIRE_VER', self::$addon_info['Require_LP_Version'] );

		// Check LP activated .
		if ( ! is_plugin_active( 'learnpress/learnpress.php' ) ) {
			add_action( 'admin_notices', array( $this, 'show_note_errors_require_lp' ) );

			deactivate_plugins( LP_ADDON_BUDDYPRESS_BASENAME );

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
		LP_Addon::load( 'LP_Addon_BuddyPress', 'inc/load.php', __FILE__ );
	}

	public function show_note_errors_require_lp() {
		?>
		<div class="notice notice-error">
			<p><?php echo( 'Please active <strong>LP version ' . LP_ADDON_BUDDYPRESS_REQUIRE_VER . ' or later</strong> before active <strong>' . self::$addon_info['Name'] . '</strong>' ); ?></p>
		</div>
		<?php
	}
}

new LP_Addon_BuddyPress_Preload();
