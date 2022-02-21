<?php
defined( 'ABSPATH' ) || exit();

class LP_Gateway_Woo extends LP_Gateway_Abstract {

	public $title = null;

	public $id = 'woo-payment';

	/**
	 * Constructor for the gateway.
	 */
	public function __construct() {
		parent::__construct();

		$this->icon               = apply_filters( 'learn_press_woo_icon', '' );
		$this->method_title       = $this->title = __( 'WooCommerce Payment', 'learnpress-woo-payment' );
		$this->method_description = __( 'Make a payment with WooCommerce payment methods.', 'learnpress-woo-payment' );

		//add_action( 'learn_press_section_payments_' . $this->id, array( $this, 'payment_settings' ) );
		//add_filter( 'learn-press/payment-method/display', array( $this, 'disable_default_payment' ), 10, 2 );
		//add_filter( 'learn-press/end-payment-methods', array( $this, 'payment_form' ) );
		//add_filter( 'learn-press/payment-gateway/' . $this->id . '/available', array( $this, 'is_available' ), 10, 2 );
		//add_action( 'learn_press_order_received', array( $this, 'instructions' ), 99 );
	}

	private function _get_payment_method() {
		$method             = ! empty( $_REQUEST['payment_method'] ) ? $_REQUEST['payment_method'] : '';
		$woocommerce_method = ! empty( $_REQUEST['woocommerce_chosen_method'] ) ? $_REQUEST['woocommerce_chosen_method'] : '';
		if ( ( $method != 'woocommerce' ) || ! $woocommerce_method ) {
			return false;
		}

		return $woocommerce_method;
	}

	/**
	 * Process the payment and return the result
	 *
	 * @param int $order_id
	 *
	 * @return array
	 * @editor tungnx
	 * @modify 4.0.2 - comment - not use
	 */
	/*public function process_payment( $order_id ) {
		$method = $this->_get_payment_method();
		if ( ! $method ) {
			return false;
		}

		$gateways = WC()->payment_gateways()->get_available_payment_gateways();
		if ( array_key_exists( $method, $gateways ) && $gateways[ $method ]->is_available() ) {
			WC()->session->set( 'chosen_payment_method', $method );
			if ( $woo_order_id = get_post_meta( $order_id, '_woo_order_id', true ) ) {
				$results = $gateways[ $method ]->process_payment( $woo_order_id );

				return $results;
			}
		}

		return false;
	}*/

	/**
	 * Output for the order received page.
	 *
	 * @editor tungnx
	 * @modify 4.0.2 - comment - not use
	 */
	/*public function instructions( $order ) {
		if ( $order && ( $this->id == $order->payment_method ) && $this->instructions ) {
			echo stripcslashes( wpautop( wptexturize( $this->instructions ) ) );
		}
	}*/

	/*public function get_title() {
		return $this->method_title;
	}*/

	/*public function payment_settings() {
		$settings = new LP_Settings_Base();
		foreach ( $this->get_settings() as $field ) {
			$settings->output_field( $field );
		}
	}*/

	public function get_settings() {
		$desc_guest_checkout = sprintf(
			'%s<br><strong><i style="color: red">%s <a href="%s">WooCommerce Setting</a> %s"</i></strong>',
			__( 'Enable to redirect to page Checkout when add to cart', 'learnpress-woo-payment' ),
			__( 'To enable Guest checkout, please go to', 'learners-woo-payment' ),
			home_url( 'wp-admin/admin.php?page=wc-settings&tab=account' ),
			__( 'then enable 2 options: "Allow customers to place orders without an account" and "Allow customers to create an account during checkout', 'learners-woo-payment' )
		);

		$desc_enable = sprintf(
			'%s <br/> <a href="%s">%s</a>',
			__(
				'If enabled system will use Payment, Checkout page, Options of Woocommerce instead of Learnpress',
				'learnpress-woo-payment'
			),
			add_query_arg(
				array(
					'page' => 'wc-settings',
					'tab'  => 'checkout',
				),
				admin_url( 'admin.php' )
			),
			__( 'Set Woocommerce Payment methods', 'learners-woo-payment' )
		);

		$settings = [
			[
				'title' => esc_html__( 'General', 'learnpress' ),
				'type'  => 'title',
			],
			[
				'title'   => __( 'Enable', 'learnpress-woo-payment' ),
				'id'      => '[enable]',
				'default' => 'yes',
				'type'    => 'checkbox',
				'class'   => 'woo_payment_enabled',
				'desc'    => $desc_enable,
			],
			[
				'title'   => __( 'Buy courses via Product', 'learnpress-woo-payment' ),
				'id'      => 'buy_course_via_product',
				'default' => self::is_by_courses_via_product() ? 'yes' : 'no',
				'type'    => 'checkbox',
				'class'   => '',
				'desc'    => __(
					'If enable system will access assign courses to product, and user want enroll/buy course must buy via product',
					'learnpress-woo-payment'
				),
			],
			[
				'title'   => esc_html__( 'Redirect to Woo checkout', 'learnpress-woo-payment' ),
				'id'      => 'redirect_to_checkout',
				'default' => 'no',
				'type'    => 'checkbox',
				'class'   => '',
				'desc'    => $desc_guest_checkout,
			],
			/*array(
				'title'   => esc_html__( 'WooCommerce Payments', 'learnpress-woo-payment' ),
				'id'      => '[available_payments]',
				'std'     => '',
				'default' => $lpw_default,
				'type'    => 'html',
				'desc'    => __(
					'List of all available payment gateways installed and activated for WooCommerce. Click on a payment method to go to <strong>WooCommerce Payment</strong> settings.',
					'learnpress-woo-payment'
				),
				'html'    => $lpw_html,
			),*/
			[
				'type' => 'sectionend',
			],
		];

		return apply_filters( 'lp-woo/settings', $settings );

	}

	/**
	 * Check enable lp-woo-payment
	 *
	 * @return bool
	 */
	public static function is_option_enabled(): bool {
		return LP()->settings()->get( 'woo-payment.enable', 'yes' ) === 'yes';
	}

	/**
	 * Check option by courses via product enable
	 *
	 * @return bool
	 */
	public static function is_by_courses_via_product(): bool {
		$option_enable                 = LP()->settings()->get( 'woo-payment.enable' );
		$option_by_courses_via_product = LP()->settings()->get( 'woo-payment_buy_course_via_product' );

		if ( empty( $option_enable ) && empty( $option_by_courses_via_product ) ) { // for client install first without save settings
			return true;
		} elseif ( empty( $option_by_courses_via_product ) ) { // for client update addon without save settings
			return false;
		} else { // for client saved settings
			return 'yes' === $option_by_courses_via_product;
		}
	}

	/**
	 * Enable Woo Payment
	 */
	public function is_enabled() {
		return self::is_option_enabled();
	}

	/*public function disable_default_payment( $return, $id ) {
		return false;
	}*/
}
