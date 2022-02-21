<?php
/**
 * Plugin Name: LearnPress - Stripe Payment
 * Plugin URI: http://thimpress.com/learnpress
 * Description: Stripe payment gateway for LearnPress.
 * Author: ThimPress
 * Version: 4.0.1
 * Author URI: http://thimpress.com
 * Tags: learnpress, lms, add-on, stripe
 * Text Domain: learnpress-stripe
 * Domain Path: /languages/
 * Require_LP_Version: 4.0.0
 *
 * @package learnpress-stripe-payment
 */

defined( 'ABSPATH' ) || exit;

define( 'LP_ADDON_STRIPE_PAYMENT_FILE', __FILE__ );

/**
 * Class LP_Addon_Stripe_Payment_Preload
 */
class LP_Addon_Stripe_Payment_Preload {
	/**
	 * @var array
	 */
	public static $addon_info = array();

	/**
	 * LP_Addon_Stripe_Payment_Preload constructor.
	 */
	public function __construct() {
		$can_load = true;
		// Set Base name plugin.
		define( 'LP_ADDON_STRIPE_BASENAME', plugin_basename( LP_ADDON_STRIPE_PAYMENT_FILE ) );

		// Set version addon for LP check .
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		self::$addon_info = get_file_data(
			LP_ADDON_STRIPE_PAYMENT_FILE,
			array(
				'Name'               => 'Plugin Name',
				'Require_LP_Version' => 'Require_LP_Version',
				'Version'            => 'Version',
			)
		);

		define( 'LP_ADDON_STRIPE_PAYMENT_VER', self::$addon_info['Version'] );
		define( 'LP_ADDON_STRIPE_PAYMENT_REQUIRE_VER', self::$addon_info['Require_LP_Version'] );

		// Check LP activated .
		if ( ! is_plugin_active( 'learnpress/learnpress.php' ) ) {
			$can_load = false;
		} elseif ( version_compare( LP_ADDON_STRIPE_PAYMENT_REQUIRE_VER, get_option( 'learnpress_version', '3.0.0' ), '>' ) ) {
			$can_load = false;
		}

		if ( ! $can_load ) {
			add_action( 'admin_notices', array( $this, 'show_note_errors_require_lp' ) );
			deactivate_plugins( LP_ADDON_STRIPE_BASENAME );

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
		LP_Addon::load( 'LP_Addon_Stripe_Payment', 'inc/load.php', __FILE__ );
	}

	public function show_note_errors_require_lp() {
		?>
		<div class="notice notice-error">
			<p><?php echo( 'Please active <strong>LP version ' . LP_ADDON_STRIPE_PAYMENT_REQUIRE_VER . ' or later</strong> before active <strong>' . self::$addon_info['Name'] . '</strong>' ); ?></p>
		</div>
		<?php
	}
}

/**
 * Check LearnPress is version >= 4.0.0
 *
 * @return boolean
 */
function lp_is_stripe_v4() {
	return version_compare( LEARNPRESS_VERSION, '4.0.0-beta-0', '>=' ) ? true : false;
}

new LP_Addon_Stripe_Payment_Preload();
