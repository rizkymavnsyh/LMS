<?php
/**
 * Plugin load class.
 *
 * @author   ThimPress
 * @package  LearnPress/2Checkout/Classes
 * @version  3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Addon_2Checkout_Payment' ) ) {
	/**
	 * Class LP_Addon_2Checkout_Payment
	 */
	class LP_Addon_2Checkout_Payment extends LP_Addon {

		/**
		 * @var string
		 */
		public $version = LP_ADDON_2CHECKOUT_VER;

		/**
		 * @var string
		 */
		public $require_version = LP_ADDON_2CHECKOUT_REQUIRE_VER;

		/**
		 * Path file addon.
		 *
		 * @var string
		 */
		public $plugin_file = LP_ADDON_2CHECKOUT_FILE;

		/**
		 * LP_Addon_2Checkout_Payment constructor.
		 */
		public function __construct() {
			parent::__construct();
		}

		/**
		 * Define Learnpress 2Checkout payment constants.
		 *
		 * @since 3.0.0
		 */
		protected function _define_constants() {
			define( 'LP_ADDON_2CHECKOUT_PAYMENT_PATH', dirname( LP_ADDON_2CHECKOUT_FILE ) );
			define( 'LP_ADDON_2CHECKOUT_PAYMENT_INC', LP_ADDON_2CHECKOUT_PAYMENT_PATH . '/inc/' );
			define( 'LP_ADDON_2CHECKOUT_PAYMENT_TEMPLATE', LP_ADDON_2CHECKOUT_PAYMENT_PATH . '/templates/' );
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @since 3.0.0
		 */
		protected function _includes() {
			include_once LP_ADDON_2CHECKOUT_PAYMENT_INC . 'class-lp-gateway-2checkout.php';
		}

		/**
		 * Init hooks.
		 */
		protected function _init_hooks() {
			// add payment gateway class
			add_filter( 'learn_press_payment_method', array( $this, 'add_payment' ) );
			add_filter( 'learn-press/payment-methods', array( $this, 'add_payment' ) );
		}

		/**
		 * Add 2Checkout to payment system.
		 *
		 * @param $methods
		 *
		 * @return mixed
		 */
		public function add_payment( $methods ) {
			$methods['2checkout'] = 'LP_Gateway_2Checkout';

			return $methods;
		}

		/**
		 * Plugin links.
		 *
		 * @return array
		 */
		public function plugin_links() {
			$links[] = '<a href="' . admin_url( 'admin.php?page=learn-press-settings&tab=payments&section=2checkout' ) . '">' . __( 'Settings',
					'learnpress-2checkout-payment' ) . '</a>';

			return $links;
		}
	}
}
