<?php
/**
 * Plugin load class.
 *
 * @author   ThimPress
 * @package  LearnPress/Stripe/Classes
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Addon_Stripe_Payment' ) ) {
	/**
	 * Class LP_Addon_Stripe_Payment
	 */
	class LP_Addon_Stripe_Payment extends LP_Addon {

		/**
		 * @var string
		 */
		public $version = LP_ADDON_STRIPE_PAYMENT_VER;

		/**
		 * @var string
		 */
		public $require_version = LP_ADDON_STRIPE_PAYMENT_REQUIRE_VER;

		/**
		 * @var string
		 */
		public $plugin_file = LP_ADDON_STRIPE_PAYMENT_FILE;

		public $id = 'stripe';

		/**
		 * LP_Addon_Stripe_Payment constructor.
		 */
		public function __construct() {
			parent::__construct();
		}

		/**
		 * Define Learnpress Stripe payment constants.
		 *
		 * @since 3.0.0
		 */
		protected function _define_constants() {
			define( 'LP_ADDON_STRIPE_PAYMENT_PATH', dirname( LP_ADDON_STRIPE_PAYMENT_FILE ) );
			define( 'LP_ADDON_STRIPE_PAYMENT_INC', LP_ADDON_STRIPE_PAYMENT_PATH . '/inc/' );
			define( 'LP_ADDON_STRIPE_PAYMENT_URL', plugin_dir_url( LP_ADDON_STRIPE_PAYMENT_FILE ) );
			define( 'LP_ADDON_STRIPE_PAYMENT_TEMPLATE', LP_ADDON_STRIPE_PAYMENT_PATH . '/templates/' );
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @since 3.0.0
		 */
		protected function _includes() {
			include_once LP_ADDON_STRIPE_PAYMENT_INC . 'class-lp-gateway-stripe.php';
		}

		/**
		 * Init hooks.
		 */
		protected function _init_hooks() {
			// add payment gateway class
			add_filter( 'learn_press_payment_method', array( $this, 'add_payment' ) );
			add_filter( 'learn-press/payment-methods', array( $this, 'add_payment' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		}

		/**
		 * Enqueue assets.
		 *
		 * @since 3.0.0
		 */
		public function enqueue_assets() {
			if ( learn_press_is_checkout() && LP()->settings->get( $this->id . '.enable' ) ) {
				$settings = LP()->settings();

				wp_enqueue_script( 'stripe', 'https://js.stripe.com/v3/', '', '3.0', true );
				wp_enqueue_script( 'learn-press-stripe', $this->get_plugin_url( 'assets/js/stripe.js' ), array( 'stripe' ), LP_ADDON_STRIPE_PAYMENT_VER, true );
				wp_enqueue_style( 'learn-press-stripe', $this->get_plugin_url( 'assets/css/style.css' ), array(), LP_ADDON_STRIPE_PAYMENT_VER, 'all' );

				$test_publish_key = $settings->get( "{$this->id}.test_publish_key" );
				$live_publish_key = $settings->get( "{$this->id}.live_publish_key" );
				$publish_key      = $settings->get( "{$this->id}.test_mode" ) == 'yes' ? $test_publish_key : $live_publish_key;

				$data = array(
					'publish_key'   => $publish_key,
					'plugin_url'    => plugins_url( '', LP_ADDON_STRIPE_PAYMENT_FILE ),
					'button_verify' => esc_html__( 'Updating', 'learnpress-stripe' ),
					'error_verify'  => esc_html__( 'Unable to process this payment, please try again or use alternative method.', 'learnpress-stripe' ),
				);

				wp_localize_script( 'learn-press-stripe', 'learn_press_stripe_params', $data );
			}
		}

		/**
		 * Add Stripe to payment system.
		 *
		 * @param $methods
		 *
		 * @return mixed
		 */
		public function add_payment( $methods ) {
			$methods['stripe'] = 'LP_Gateway_Stripe';

			return $methods;
		}

		/**
		 * Plugin links.
		 *
		 * @return array
		 */
		public function plugin_links() {
			$links[] = '<a href="' . admin_url( 'admin.php?page=learn-press-settings&tab=payments&section=stripe' ) . '">' . esc_html__( 'Settings', 'learnpress-stripe' ) . '</a>';

			return $links;
		}
	}
}
