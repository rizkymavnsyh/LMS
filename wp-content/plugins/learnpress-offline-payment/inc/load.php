<?php
/**
 * Plugin load class.
 *
 * @author   ThimPress
 * @package  LearnPress/Offline-Payment/Classes
 * @version  3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Addon_Offline_Payment' ) ) {
	/**
	 * Class LP_Addon_Offline_Payment.
	 */
	class LP_Addon_Offline_Payment extends LP_Addon {
		/**
		 * Addon version
		 *
		 * @var string
		 */
		public $version = LP_ADDON_OFFLINE_PAYMENT_VER;

		/**
		 * Require LP version
		 *
		 * @var string
		 */
		public $require_version = LP_ADDON_OFFLINE_PAYMENT_REQUIRE_VER;

		/**
		 * Path file addon.
		 *
		 * @var string
		 */
		public $plugin_file = LP_ADDON_OFFLINE_PAYMENT_FILE;

		/**
		 * LP_Addon_Offline_Payment constructor.
		 */
		public function __construct() {
			parent::__construct();

			add_filter( 'learn-press/payment-methods', array( $this, 'add_payment' ) );
			add_filter( 'learn_press_payment_method', array( $this, 'add_payment' ) );
		}

		/**
		 * Add Offline payment to payment system.
		 *
		 * @param $methods
		 *
		 * @return mixed
		 */
		public function add_payment( $methods ) {
			$methods['offline-payment'] = 'LP_Gateway_Offline_Payment';

			return $methods;
		}


		/**
		 * Define constants.
		 */
		protected function _define_constants() {
			if ( ! defined( 'LP_ADDON_OFFLINE_PAYMENT_PATH' ) ) {
				define( 'LP_ADDON_OFFLINE_PAYMENT_PATH', dirname( LP_ADDON_OFFLINE_PAYMENT_FILE ) );
			}
		}


		public function plugin_links() {
			$links = array(
				'settings' => '<a href="' . admin_url( 'admin.php?page=learn-press-settings&tab=payments&section=offline-payment' ) . '">' . __( 'Settings',
						'learnpress-offline-payment' ) . '</a>'
			);

			return $links;
		}

		/**
		 * Include needed files
		 */
		protected function _includes() {
			require_once LP_ADDON_OFFLINE_PAYMENT_PATH . "/inc/class-lp-gateway-offline-payment.php";
		}

		public function plugin_url( $file = '' ) {
			return plugins_url( '/' . $file, LP_ADDON_OFFLINE_PAYMENT_FILE );
		}
	}
}
