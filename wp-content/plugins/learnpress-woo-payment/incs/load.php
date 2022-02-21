<?php

/**
 * Class LP_Addon_Woo_Payment
 */
class LP_Addon_Woo_Payment extends LP_Addon {
	/**
	 * @var string
	 */
	public $version = LP_ADDON_WOO_PAYMENT_VER;

	/**
	 * @var string
	 */
	public $require_version = LP_ADDON_WOO_PAYMENT_REQUIRE_VER;

	/**
	 * @var string
	 */
	public $plugin_file = LP_ADDON_WOO_PAYMENT_FILE;

	/**
	 * @var int flag to get the error
	 */
	protected static $_error = 0;

	/**
	 * Courses should not display purchase button
	 *
	 * @var array
	 */
	protected $_hide_purchase_buttons = array();

	/**
	 * @var bool
	 */
	protected $_single_purchase = false;

	/**
	 * @var array
	 */
	protected $_response = array();

	/**
	 * @var LP_Addon_Woo_Payment|null
	 *
	 * Hold the singleton of LP_Woo_Payment_Preload object
	 */
	protected static $_instance = null;

	/**
	 * LP_Woo_Payment_Preload constructor.
	 */

	public function __construct() {
		parent::__construct();
		$this->_incs();
		//add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
		//add_filter( 'template_include', array( $this, 'learn_press_wc_defines' ) );
	}

	/*public function plugins_loaded() {
		$this->_incs();
		$this->learn_press_wc_defines();
	}*/

	/*function learn_press_wc_defines() {
		define( 'LP_WOO_TEMPLATE', learn_press_template_path() . '/addons/woo-payment/' );
	}*/

	/**
	 * Include files needed
	 */
	protected function _incs() {
		require_once LP_ADDON_WOO_PAYMENT_PATH . '/incs/class-lp-gateway-woo.php';
		add_filter( 'learn_press_payment_method', [ $this, 'lp_woo_settings' ] );

		if ( ! LP_Gateway_Woo::is_option_enabled() ) {
			return;
		}

		//require_once LP_ADDON_WOO_PAYMENT_PATH . '/incs/functions.php';
		require_once LP_ADDON_WOO_PAYMENT_PATH . '/incs/admin/course.php';
		include_once LP_ADDON_WOO_PAYMENT_PATH . '/incs/class-lp-woo-ajax.php';
		include_once LP_ADDON_WOO_PAYMENT_PATH . '/incs/background-process/class-lp-woo-payment-background-process.php';

		if ( LP_Gateway_Woo::is_by_courses_via_product() ) {
			require_once LP_ADDON_WOO_PAYMENT_PATH . '/incs/class-lp-woo-assign-course-to-product.php';
		} else {
			// Create type WC_Order_Item_LP_Course for wc order
			include_once LP_ADDON_WOO_PAYMENT_PATH . '/incs/class-wc-order-item-course.php';

			// Create type WC_Product_LP_Course for wc product
			require_once LP_ADDON_WOO_PAYMENT_PATH . '/incs/class-wc-product-lp-course.php';

			// WooCommerce checkout
			require_once LP_ADDON_WOO_PAYMENT_PATH . '/incs/class-lp-wc-checkout.php';
		}

		// Hooks
		require_once LP_ADDON_WOO_PAYMENT_PATH . '/incs/class-lp-wc-hooks.php';
		LP_WC_Hooks::instance();
	}

	/**
	 * Show lp woo settings
	 *
	 * @param array $methods
	 *
	 * @return array
	 */
	public function lp_woo_settings( array $methods ): array {
		$methods['woocommerce'] = 'LP_Gateway_Woo';

		return $methods;
	}

	/**
	 * @param $cart_item_key
	 * @param $product_id
	 * @param $quantity
	 * @param $variation_id
	 * @param $variation
	 * @param $cart_item_data
	 */
	/*public function added_to_cart(
		$cart_item_key,
		$product_id,
		$quantity,
		$variation_id,
		$variation,
		$cart_item_data
	) {
		if ( LP_COURSE_CPT !== get_post_type( $product_id ) ) {
			return;
		}
		if ( $this->_response['single_purchase'] ) {
			$this->_response['redirect'] = wc_get_checkout_url();
		} elseif ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
			$this->_response['redirect'] = wc_get_cart_url();
		}
		add_filter(
			'pre_option_woocommerce_cart_redirect_after_add',
			array(
				$this,
				'cart_redirect_after_add',
			),
			1000,
			2
		);
		add_filter( 'woocommerce_add_to_cart_redirect', array( $this, 'add_to_cart_redirect' ), 1000 );
		ob_start();
		wc_add_to_cart_message( array( $product_id => $quantity ), true );
		wc_print_notices();
		$this->_response['message']       = ob_get_clean();
		$this->_response['added_to_cart'] = 'yes';
		add_action( 'shutdown', array( $this, 'shutdown' ), 100 );// worked in version 2.4.8.1
	}*/

	/**
	 * @param $a
	 * @param $b
	 *
	 * @return string
	 */
	/*public function cart_redirect_after_add( $a, $b ) {
		return 'no';
	}*/

	/**
	 * @param $a
	 *
	 * @return bool
	 */
	/*public function add_to_cart_redirect( $a ) {
		return false;
	}*/

	/**
	 *
	 */
	/*public function shutdown() {
		$output  = ob_get_clean();
		$is_ajax = ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' );
		if ( $is_ajax && $this->_response ) {
			learn_press_send_json( $this->_response );
		}
	}*/

	/**
	 * Display message if a course has already added into WooCommerce cart
	 */
	/*public function purchase_course_notice() {
		global $woocommerce;
		$course    = LP()->global['course'];
		$course_id = $course->get_id();
		$user      = learn_press_get_current_user();

		if ( ! $this->is_added_in_cart( $course_id ) ) {
			return;
		}

		if ( $user->has_purchased_course( $course_id ) ) {
			#@TODO: remove course from cart
			return;
		}
		if ( $this->_response['single_purchase'] ) {
			if ( ! $woocommerce || version_compare( $woocommerce->version, '3.0.0', '>=' ) ) {
				add_filter( 'wc_add_to_cart_message_html', array( $this, 'custom_add_to_cart_message' ) );
			} else {
				add_filter( 'wc_add_to_cart_message', array( $this, 'custom_add_to_cart_message' ) );
			}
		}
		if ( ! isset( $_REQUEST['add-to-cart'] ) || ! $_REQUEST['add-to-cart'] ) {
			// wc_add_to_cart_message( array( $course_id => 1 ) );
		}
		wc_print_notices();
		echo '<div class="hide-if-js hide">';
	}*/

	/**
	 * Replace 'View Cart' button with 'Checkout' button of WC message
	 * if our 'Single Purchase' option is selected
	 *
	 * @param $message
	 *
	 * @return mixed
	 */
	/*public function custom_add_to_cart_message( $message ) {
		if ( $this->_response['single_purchase'] ) {
			if ( preg_match( '~<a.*>(.*)</a>~', $message, $m ) ) {
				$link    = preg_replace( '~>(.*)<~', '>' . __( 'Checkout', 'learnpress-woo-payment' ) . '<', $m[0] );
				$link    = preg_replace( '~href=".*"~U', 'href="' . wc_get_checkout_url() . '"', $link );
				$message = str_replace( $m[0], $link, $message );
			}
		}

		return $message;
	}*/

	public function after_course_buttons() {
		$course = LP()->global['course'];
		if ( ! $this->is_added_in_cart( $course->get_id() ) ) {
			return;
		}
		echo '</div>';
	}

	/**
	 * @param $id
	 *
	 * @editor tungnx
	 * @modify 4.0.2 - comment - not use
	 */
	/*public function remove_course( $id ) {
		$cart = WC()->cart;
		if ( $cart_items = $cart->get_cart() ) {
			foreach ( $cart_items as $cart_item_key => $cart_item ) {
				if ( $id == $cart_item['product_id'] ) {
					$cart->remove_cart_item( $cart_item_key );
				}
			}
		}
	}*/

	/**
	 * Map meta keys from LearnPress order and WooCommerce order
	 *
	 * @return array
	 *
	 * @editor tungnx
	 * @modify 4.0.2 - comment - not use
	 */
	/*public function get_meta_map() {
		// map LP order key with WC order key
		$map_keys = array(
			'_order_currency'       => '_order_currency',
			'_user_id'              => '_customer_user',
			'_order_subtotal'       => '_order_total',
			'_order_total'          => '_order_total',
			'_payment_method_id'    => '_payment_method',
			'_payment_method_title' => '_payment_method_title',
		);

		return apply_filters( 'learnpress_woo_meta_caps', $map_keys );
	}*/

	/**
	 * If use woo checkout
	 * @return boolean
	 */
	/*public function woo_checkout_enabled() {
		return true;//$this->woo_actived() && LP()->settings->get( 'woo_payment_type' ) === 'checkout';
	}*/

	/**
	 * Payment is enabled
	 * @return boolean
	 */
	/*public function woo_payment_enabled() {
		return true;//LP()->settings->get( 'woo_payment_type' ) == 'payment' && $this->woo_actived();
	}*/

	/**
	 * WooCommercer is actived
	 * @return boolean
	 */
	/*public function woo_actived() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		return is_plugin_active( 'woocommerce/woocommerce.php' );
	}*/
}
