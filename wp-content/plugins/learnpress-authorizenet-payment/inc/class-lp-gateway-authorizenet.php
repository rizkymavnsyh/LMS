<?php
/**
 * Authorize.net payment gateway class.
 *
 * @author   ThimPress
 * @package  LearnPress/Authorizenet/Classes
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Gateway_Authorizenet' ) ) {
	/**
	 * Class LP_Gateway_Authorizenet.
	 */
	class LP_Gateway_Authorizenet extends LP_Gateway_Abstract {

		/**
		 * @var bool
		 */
		public static $_getscript_loaded = false;

		/**
		 * LP_Gateway_Authorizenet constructor.
		 */
		public function __construct() {
			$this->id = 'authorizenet';

			$this->method_title       = 'Authorize.net';
			$this->method_description = esc_html__( 'Make a payment with Authorize.net payment methods.', 'learnpress-authorizenet-payment' );
			$this->icon               = apply_filters( 'learn-press/authorizenet-icon', '' );

			$this->title       = 'Authorize.net';
			$this->description = esc_html__( 'Make a payment with Authorize.net payment methods.', 'learnpress-authorizenet-payment' );

			if ( did_action( 'learn-press/authorizenet-add-on/loaded' ) ) {
				return;
			}

			add_action( 'authorizenet_checkout_order_processed', array( $this, 'checkout_order_processed' ), 10, 2 );

			// check payment gateway enable
			add_filter( 'learn-press/payment-gateway/' . $this->id . '/available', array( $this, 'authorizenet_available' ), 10, 2 );

			if ( $this->authorizenet_available() ) {
				learn_press_enqueue_script( $this->get_script() );
			}

			do_action( 'learn-press/authorizenet-add-on/loaded' );

			parent::__construct();
		}

		/**
		 * Check gateway available.
		 *
		 * @return bool
		 */
		public function authorizenet_available() {
			if ( LP()->settings()->get( "{$this->id}.enable" ) != 'yes' ) {
				return false;
			}

			if ( ( LP()->settings()->get( "{$this->id}.transaction_key" ) && LP()->settings()->get( "{$this->id}.login_id" ) ) ) {
				return true;
			}

			return true;
		}

		/**
		 * Admin payment settings.
		 *
		 * @return array
		 */
		public function get_settings() {
			return apply_filters(
				'learn-press/gateway-payment/authorizenet/settings',
				array(
					array(
						'type' => 'title',
					),
					array(
						'title'   => esc_html__( 'Enable', 'learnpress-authorizenet-payment' ),
						'id'      => '[enable]',
						'default' => 'no',
						'type'    => 'checkbox',
					),
					array(
						'title'   => esc_html__( 'Login ID', 'learnpress-authorizenet-payment' ),
						'id'      => '[login_id]',
						'default' => '',
						'type'    => 'text',
					),
					array(
						'title'   => esc_html__( 'Transaction Key', 'learnpress-authorizenet-payment' ),
						'id'      => '[transaction_key]',
						'default' => '',
						'type'    => 'text',
					),
					array(
						'title'   => esc_html__( 'Test mode', 'learnpress-authorizenet-payment' ),
						'id'      => '[test_mode]',
						'default' => 'no',
						'type'    => 'checkbox',
					),
					array(
						'title'   => esc_html__( 'Secure post', 'learnpress-authorizenet-payment' ),
						'id'      => '[secure_post]',
						'default' => 'no',
						'type'    => 'checkbox',
					),
					array(
						'type' => 'sectionend',
					),
				)
			);
		}

		/**
		 * Payment form.
		 */
		public function get_payment_form() {
			ob_start();
			$template = learn_press_locate_template( 'form.php', learn_press_template_path() . 'addons/authorizenet-payment/', LP_ADDON_AUTHORIZENET_TEMPLATE );
			include $template;

			return ob_get_clean();
		}

		/**
		 * @param $order_id
		 * @param $posted
		 */
		public function checkout_order_processed( $order_id, $posted ) {
			$lp_order_id = LP()->session->order_awaiting_payment;

			if ( $lp_order_id ) {
				$map_keys = array(
					'_order_currency'       => '_order_currency',
					'_user_id'              => '_customer_user',
					'_order_subtotal'       => '_order_total',
					'_order_total'          => '_order_total',
					'_payment_method_id'    => '_payment_method',
					'_payment_method_title' => '_payment_method_title',
				);

				foreach ( $map_keys as $k => $v ) {
					update_post_meta( $lp_order_id, $k, get_post_meta( $order_id, $v, true ) );
				}

				update_post_meta( $order_id, '_learn_press_order_id', $lp_order_id );
			}
		}

		/**
		 * Get script.
		 *
		 * @return null|string|string[]
		 */
		public function get_script() {
			if ( self::$_getscript_loaded ) {
				return '';
			}

			ob_start();
			?>
			<script>
				(function() {
					var _checkout = $('#learn-press-checkout'),
						_input_field = _checkout.find('input[name^="learn-press-authorizenet-payment"]'),
						_select_field = _checkout.find('select[name^="learn-press-authorizenet-payment"]');
					if (_checkout.find('#payment_method_authorizenet').is(':checked')) {
						_input_field.prop('disabled', false);
						_select_field.prop('disabled', false);
					}

					_checkout.find('input[type=radio][name="payment_method"]').on( 'click', function () {
						if (this.value === 'authorizenet') {
							_input_field.prop('disabled', false);
							_select_field.prop('disabled', false);
						} else {
							_input_field.prop('disabled', true);
							_select_field.prop('disabled', true);
						}
					});
				})();
			</script>
			<?php
			$script                  = ob_get_clean();
			self::$_getscript_loaded = true;

			return preg_replace( '!</?script>!', '', $script );
		}

		/**
		 * Process the payment and return the result.
		 *
		 * @param int $order_id
		 *
		 * @return array
		 */
		public function process_payment( $order_id ) {
			require_once LP_ADDON_AUTHORIZENET_PATH . '/inc/libraries/class-lp-authorizenet-AIM.php';

			$this->order = learn_press_get_order( $order_id );

			$amount = $this->order->order_total ? $this->order->order_total : 0;

			if ( $amount < 0 ) {
				$json = array(
					'result'  => 'fail',
					'message' => esc_html__( 'Total price small than zero!', 'learnpress-authorizenet-payment' ),
				);

				return $json;
			}

			$payment_setting = LP()->settings()->get( 'learn_press_authorizenet' );
			$card_num        = $_POST['learn-press-authorizenet-payment']['cardnum'];
			$exp_date        = $_POST['learn-press-authorizenet-payment']['expmonth'] . substr( $_POST['learn-press-authorizenet-payment']['expyear'], 2 );
			$card_code       = $_POST['learn-press-authorizenet-payment']['cardcvv'];

			$api_login_id    = $payment_setting['login_id'];
			$transaction_key = $payment_setting['transaction_key'];
			$test_mode       = $payment_setting['test_mode'];
			$sale            = new LearnPressAuthorizeNetAIM( $api_login_id, $transaction_key );

			if ( $test_mode !== 'yes' ) {
				$sale->setSandbox( false );
			} else {
				$sale->setSandbox( true );
			}

			$sale->setFields(
				array(
					'amount'    => $amount,
					'card_num'  => $card_num,
					'exp_date'  => $exp_date,
					'card_code' => $card_code,
				)
			);

			$response = $sale->authorizeAndCapture();

			if ( $response->approved ) {
				$this->order_complete();

				update_post_meta( $this->order->id, '_lp_transaction_id', $response->transaction_id );

				$page_id            = LP()->settings()->get( 'learn_press_profile_page_id' );
				$profile_order_slug = LP()->settings()->get( 'learn_press_profile_endpoints[profile-orders]' );
				$cuser              = wp_get_current_user();
				$url                = get_permalink( $page_id ) . $cuser->data->user_login . '\\' . $profile_order_slug;

				$json = array(
					'result'   => 'success',
					'redirect' => $url,
					'message'  => esc_html__( 'Check out payment success!', 'learnpress-authorizenet-payment' ),
				);
			} else {
				$json = array(
					'result'  => 'fail',
					'message' => $response->response_reason_text ? $response->response_reason_text : $response->error_message,
				);
			}

			return $json;
		}

		/**
		 * Complete order.
		 */
		public function order_complete() {
			if ( $this->order->status == 'completed' ) {
				return;
			}

			$this->order->payment_complete();
			LP()->cart->empty_cart();

			$this->order->add_note( sprintf( "%s payment completed with Transaction Id of '%s'", $this->title, $this->charge->id ) );

			LP()->session->order_awaiting_payment = null;
		}
	}
}
