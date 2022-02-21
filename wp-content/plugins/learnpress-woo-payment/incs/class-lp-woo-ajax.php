<?php

/**
 * Class LP_Woo_Ajax
 *
 * Handle ajax for certificates
 *
 * @since 3.1.4
 */
class LP_Woo_Ajax {
	protected static $_instance;
	/** @see lpWooAddCourseToCart */
	protected $_hook_arr = array( 'lpWooAddCourseToCart' );

	protected function __construct() {
		foreach ( $this->_hook_arr as $hook ) {
			add_action( 'wp_ajax_' . $hook, array( $this, $hook ) );
			add_action( 'wp_ajax_nopriv_' . $hook, array( $this, $hook ) );
		}
	}

	public static function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Add course to cart Woo
	 */
	public function lpWooAddCourseToCart() {
		/**
		 * @global LP_Addon_Woo_Payment $lp_addon_woo_payment
		 */
		global $lp_addon_woo_payment;

		$result = array(
			'code'    => 0,
			'message' => __( 'error', 'learnpress-woo-payment' ),
		);

		if ( ! isset( $_POST['course-id'] ) ) {
			$result['message'] = __( 'Params invalid', 'learnpress-woo-payment' );

			wp_send_json( $result );
		}

		$course_id = absint( wp_unslash( $_POST['course-id'] ) );
		$course    = learn_press_get_course( $course_id );

		if ( ! $course ) {
			$result['message'] = __( 'course is invalid', 'learnpress-woo-payment' );
			wp_send_json( $result );
		}

		$wc_cart       = WC()->cart;
		$cart_item_key = $wc_cart->add_to_cart( $course_id );

		if ( $cart_item_key ) {
			$result['code']    = 1;
			$result['message'] = $cart_item_key;

			ob_start();
			// Set content button view cart
			//LP_Addon_Woo_Payment_Preload::get_template( 'view-cart', [ 'course' => $course ] );
			$lp_addon_woo_payment->get_template( 'view-cart', compact( 'course' ) );
			$view_cart_content          = ob_get_contents();
			$result['button_view_cart'] = $view_cart_content;

			// Set content mini cart
			woocommerce_mini_cart();
			$mini_cart = ob_get_contents();
			ob_clean();
			ob_end_flush();

			$result['widget_shopping_cart_content'] = $mini_cart;
			$result['count_items']                  = $wc_cart->get_cart_contents_count();

			if ( 'yes' == LP()->settings()->get( 'woo-payment_redirect_to_checkout', 'no' ) ) {
				$result['redirect_to'] = wc_get_checkout_url();
			}
		} else {
			$wc_notices = wc_get_notices();

			if ( isset( $wc_notices['error'] ) && ! empty( $wc_notices['error'] ) ) {
				//$message_error = sanitize_text_field($wc_notices['error'][0]['notice']);
				$result['message'] = __(
					'Course is only added one time.',
					'learnpress-woo-payment'
				);
			}
		}

		wp_send_json( $result );
	}
}

LP_Woo_Ajax::getInstance();
