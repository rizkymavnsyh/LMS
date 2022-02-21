<?php
/**
 * Stripe payment gateway class.
 *
 * @author   ThimPress
 * @package  LearnPress/Stripe/Classes
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Gateway_Stripe' ) ) {
	/**
	 * Class LP_Gateway_Stripe
	 */
	class LP_Gateway_Stripe extends LP_Gateway_Abstract {

		/**
		 * @var array
		 */
		private $form_data = array();

		/**
		 * @var string
		 */
		private $api_endpoint = 'https://api.stripe.com/v1/';

		/**
		 * @var object
		 */
		private $charge = null;

		/**
		 * @var array|null
		 */
		protected $settings = null;

		/**
		 * @var null
		 */
		protected $order = null;

		/**
		 * @var null
		 */
		protected $posted = null;

		/**
		 * Request Token
		 *
		 * @var string
		 */
		protected $source = null;

		/**
		 * @var null
		 */
		protected $publish_key = null;

		/**
		 * @var null
		 */
		protected $secret_key = null;

		/**
		 * LP_Gateway_Stripe constructor.
		 */
		public function __construct() {
			$this->id = 'stripe';

			$this->method_title       = 'Stripe';
			$this->method_description = esc_html__( 'Make a payment with Stripe.', 'learnpress-stripe' );
			$this->icon               = '';

			// Get settings.
			$this->title       = LP()->settings()->get( "{$this->id}.title", $this->method_title );
			$this->description = LP()->settings()->get( "{$this->id}.description", $this->method_description );

			$settings = LP()->settings();

			// Add default values for fresh installs.
			if ( $settings->get( "{$this->id}.enable" ) ) {
				$this->settings                     = array();
				$this->settings['test_mode']        = $settings->get( "{$this->id}.test_mode" );
				$this->settings['test_publish_key'] = $settings->get( "{$this->id}.test_publish_key" );
				$this->settings['test_secret_key']  = $settings->get( "{$this->id}.test_secret_key" );
				$this->settings['live_publish_key'] = $settings->get( "{$this->id}.live_publish_key" );
				$this->settings['live_secret_key']  = $settings->get( "{$this->id}.live_secret_key" );

				// API Info.
				$this->publish_key = $this->settings['test_mode'] == 'yes' ? $this->settings['test_publish_key'] : $this->settings['live_publish_key'];
				$this->secret_key  = $this->settings['test_mode'] == 'yes' ? $this->settings['test_secret_key'] : $this->settings['live_secret_key'];
			}

			if ( did_action( 'learn_press/stripe-add-on/loaded' ) ) {
				return;
			}

			// check payment gateway enable.
			add_filter( 'learn-press/payment-gateway/' . $this->id . '/available', array( $this, 'stripe_available' ), 10, 2 );

			do_action( 'learn_press/stripe-add-on/loaded' );

			LP_Request::register_ajax( 'lp_stripe_verify_intent:nopriv', array( $this, 'verify_intent_after_checkout' ) );

			parent::__construct();
		}

		/**
		 * Admin payment settings.
		 *
		 * @return array
		 */
		public function get_settings() {
			$datas = apply_filters(
				'learn-press/gateway-payment/stripe/settings',
				array(
					array(
						'title'   => esc_html__( 'Enable', 'learnpress-stripe' ),
						'id'      => '[enable]',
						'default' => 'no',
						'type'    => 'yes-no',
					),
					array(
						'type'       => 'text',
						'title'      => esc_html__( 'Title', 'learnpress-stripe' ),
						'default'    => esc_html__( 'Stripe', 'learnpress-stripe' ),
						'id'         => '[title]',
						'class'      => 'regular-text',
						'visibility' => array(
							'state'       => 'show',
							'conditional' => array(
								array(
									'field'   => '[enable]',
									'compare' => '=',
									'value'   => 'yes',
								),
							),
						),
					),
					array(
						'type'       => 'textarea',
						'title'      => esc_html__( 'Description', 'learnpress-stripe' ),
						'default'    => esc_html__( 'Pay with Credit Card', 'learnpress-stripe' ),
						'id'         => '[description]',
						'editor'     => array(
							'textarea_rows' => 5,
						),
						'css'        => 'height: 100px;',
						'visibility' => array(
							'state'       => 'show',
							'conditional' => array(
								array(
									'field'   => '[enable]',
									'compare' => '=',
									'value'   => 'yes',
								),
							),
						),
					),
					array(
						'title'      => esc_html__( 'Live secret key', 'learnpress-stripe' ),
						'id'         => '[live_secret_key]',
						'type'       => 'text',
						'visibility' => array(
							'state'       => 'show',
							'conditional' => array(
								array(
									'field'   => '[enable]',
									'compare' => '=',
									'value'   => 'yes',
								),
								array(
									'field'   => '[test_mode]',
									'compare' => '!=',
									'value'   => 'yes',
								),
							),
						),
					),
					array(
						'type'       => 'text',
						'title'      => esc_html__( 'Live publish key', 'learnpress-stripe' ),
						'default'    => '',
						'id'         => '[live_publish_key]',
						'visibility' => array(
							'state'       => 'show',
							'conditional' => array(
								array(
									'field'   => '[enable]',
									'compare' => '=',
									'value'   => 'yes',
								),
								array(
									'field'   => '[test_mode]',
									'compare' => '!=',
									'value'   => 'yes',
								),
							),
						),
					),
					array(
						'title'      => esc_html__( 'Enable test mode', 'learnpress-stripe' ),
						'id'         => '[test_mode]',
						'default'    => 'no',
						'type'       => 'yes-no',
						'visibility' => array(
							'state'       => 'show',
							'conditional' => array(
								array(
									'field'   => '[enable]',
									'compare' => '=',
									'value'   => 'yes',
								),
							),
						),
					),
					array(
						'type'       => 'text',
						'title'      => esc_html__( 'Test secret key', 'learnpress-stripe' ),
						'default'    => '',
						'id'         => '[test_secret_key]',
						'visibility' => array(
							'state'       => 'show',
							'conditional' => array(
								array(
									'field'   => '[enable]',
									'compare' => '=',
									'value'   => 'yes',
								),
								array(
									'field'   => '[test_mode]',
									'compare' => '=',
									'value'   => 'yes',
								),
							),
						),
					),
					array(
						'type'       => 'text',
						'title'      => esc_html__( 'Test publish key', 'learnpress-stripe' ),
						'default'    => '',
						'id'         => '[test_publish_key]',
						'visibility' => array(
							'state'       => 'show',
							'conditional' => array(
								array(
									'field'   => '[enable]',
									'compare' => '=',
									'value'   => 'yes',
								),
								array(
									'field'   => '[test_mode]',
									'compare' => '=',
									'value'   => 'yes',
								),
							),
						),
					),
				)
			);

			if ( lp_is_stripe_v4() ) {
				array_unshift(
					$datas,
					array(
						'type' => 'title',
					)
				);

				array_push(
					$datas,
					array(
						'type' => 'sectionend',
					)
				);
			}

			return $datas;
		}

		/**
		 * Payment form.
		 */
		public function get_payment_form() {
			ob_start();
			$template = learn_press_locate_template( 'form.php', learn_press_template_path() . '/addons/stripe-payment/', LP_ADDON_STRIPE_PAYMENT_TEMPLATE );
			include $template;

			return ob_get_clean();
		}

		/**
		 * @return mixed
		 */
		public function get_icon() {
			if ( empty( $this->icon ) ) {
				$this->icon = LP_ADDON_STRIPE_PAYMENT_URL . 'assets/images/stripe.jpg';
			}

			return parent::get_icon();
		}

		/**
		 * Check gateway available.
		 *
		 * @return bool
		 */
		public function stripe_available() {
			if ( LP()->settings->get( "{$this->id}.enable" ) != 'yes' ) {
				return false;
			}

			if ( LP()->settings->get( "{$this->id}.enable" ) == 'yes' ) {

				if ( LP()->settings->get( "{$this->id}.test_mode" ) == 'yes' ) {
					if ( ! LP()->settings->get( "{$this->id}.test_secret_key" ) || ! LP()->settings->get( "{$this->id}.test_publish_key" ) ) {
						return false;
					}
				} else {
					if ( ! LP()->settings->get( "{$this->id}.live_secret_key" ) || ! LP()->settings->get( "{$this->id}.live_publish_key" ) ) {
						return false;
					}
				}
			}

			return true;
		}

		/**
		 * Stripe payment process.
		 *
		 * @param $order
		 *
		 * @return array
		 * @throws string
		 */
		public function process_payment( $order ) {
			$this->order = learn_press_get_order( $order );

			$source = $this->source_send_stripe();

			if ( ! $source || ! empty( $source->error->message ) ) {
				learn_press_add_notice( $source->error->message, 'error' );

				return array(
					'result'   => 'fail',
					'messages' => $source->error->message,
				);
			}

			$this->source = $source->id;

			$customer = $this->customer_payment_stripe();

			if ( ! empty( $customer->error->message ) ) {
				learn_press_add_notice( $customer->error->message, 'error' );

				return array(
					'result'   => 'fail',
					'messages' => $customer->error->message,
				);
			}

			update_user_option( get_current_user_id(), '_lp_stripe_customer_id', $customer->id, false );

			$stripe = $this->send_to_stripe( $customer->id );

			if ( ! empty( $stripe->error->message ) ) {
				learn_press_add_notice( $stripe->error->message, 'error' );

				return array(
					'result'   => 'fail',
					'messages' => $stripe->error->message,
				);
			}

			$pi = isset( $stripe->id ) ? $stripe->id : '';

			if ( ! empty( $pi ) ) {
				$intent = $this->confim_payment_stripe( $pi );

				if ( ! empty( $intent->error ) ) {
					learn_press_add_notice( $intent->error->message, 'error' );

					return array(
						'result'   => 'fail',
						'messages' => $intent->error->message,
					);
				}

				if ( 'requires_action' === $intent->status ) {
					learn_press_add_order_item_meta( $this->order->id, '_lp_stripe_intent_id', $intent->id );

					$verification_url = add_query_arg(
						array(
							'order'       => $this->order->id,
							'nonce'       => wp_create_nonce( 'lp_stripe_confirm_pi' ),
							'redirect_to' => rawurlencode( $this->get_return_url( $this->order ) ),
						),
						esc_url_raw( add_query_arg( 'lp-ajax', 'lp_stripe_verify_intent', remove_query_arg( array( 'remove_item', 'add-to-cart', 'added-to-cart', 'order_again', '_wpnonce' ), home_url( '/', 'relative' ) ) ), 'lp_stripe_verify_intent' )
					);

					$redirect = sprintf( '#confirm-pi-%s:%s', $intent->client_secret, rawurlencode( $verification_url ) );

					return array(
						'result'   => 'success',
						'redirect' => $redirect,
					);
				} elseif ( 'succeeded' === $intent->status ) {
					learn_press_delete_order_item_meta( $this->order->id, '_lp_stripe_intent_id', $intent->id );

					$this->order_complete();

					return array(
						'result'   => 'success',
						'redirect' => $this->get_return_url( $this->order ),
					);
				}
			}

			return array(
				'result' => 'fail',
			);
		}

		public function verify_intent_after_checkout() {
			if ( ! isset( $_GET['nonce'] ) || ! wp_verify_nonce( sanitize_key( $_GET['nonce'] ), 'lp_stripe_confirm_pi' ) ) {
				$result = array(
					'result'  => 'fail',
					'message' => esc_html__( 'Error: Verify nonce error!', 'learnpress-stripe' ),
				);

				wp_send_json( $result );
			}

			$order_id = null;

			if ( isset( $_GET['order'] ) && absint( $_GET['order'] ) ) {
				$order_id = absint( $_GET['order'] );
			}

			$order = learn_press_get_order( $order_id );

			$this->order = learn_press_get_order( $order );

			$intent_id = learn_press_get_order_item_meta( $order_id, '_lp_stripe_intent_id' );

			$intent = $this->post_data( array(), 'payment_intents/' . $intent_id, 'GET' );

			if ( ! $intent ) {
				$result = array(
					'result'  => 'fail',
					'message' => esc_html__( 'Error: Can\'t get Intent!', 'learnpress-stripe' ),
				);

				wp_send_json( $result );
			}

			clean_post_cache( $order_id );

			if ( ! $order->has_status( array( 'pending', 'failed' ) ) ) {
				$result = array(
					'result'  => 'fail',
					'message' => esc_html__( 'Error: Order status error!', 'learnpress-stripe' ),
				);

				wp_send_json( $result );
			}

			if ( isset( $intent->object ) && 'payment_intent' === $intent->object && isset( $intent->status ) && 'succeeded' === $intent->status ) {
				learn_press_delete_order_item_meta( $order_id, '_lp_stripe_intent_id', $intent->id );

				$this->order_complete();

				$result = array(
					'result'   => 'success',
					'redirect' => $this->get_return_url( $order ),
				);

			} else {
				learn_press_delete_order_item_meta( $order_id, '_lp_stripe_intent_id', $intent->id );

				$message = isset( $intent->last_payment_error->message ) ? $intent->last_payment_error->message : esc_html__( 'Unable to process this payment, please try again or use alternative method.', 'learnpress-stripe' );

				$result = array(
					'result'  => 'fail',
					'message' => $message,
				);
			}

			wp_send_json( $result );
		}

		public function confim_payment_stripe( $pi ) {
			$confim = $this->post_data(
				array(
					'source' => $this->form_data['source'],
				),
				'payment_intents/' . $pi . '/confirm'
			);

			return $confim;
		}

		public function customer_payment_stripe() {
			if ( $this->get_form_data() ) {
				$user_id        = get_current_user_id();
				$stripe_user_id = get_user_option( '_lp_stripe_customer_id', $user_id );

				if ( ! $stripe_user_id ) {
					$response = $this->post_data(
						array(
							'email'       => $this->form_data['customer_email'],
							'name'        => $this->form_data['customer_name'],
							'description' => $this->form_data['customer_name'],
						),
						'customers'
					);
				} else {
					$response = $this->post_data(
						array(
							'email'       => $this->form_data['customer_email'],
							'name'        => $this->form_data['customer_name'],
							'description' => $this->form_data['customer_name'],
						),
						'customers/' . $stripe_user_id
					);
				}

				return $response;
			}

			return false;
		}

		public function source_send_stripe() {
			if ( $this->get_form_data() ) {
				$sources = $this->post_data(
					array(
						'type'  => 'card',
						'owner' => array(
							'name'  => $this->form_data['customer_name'],
							'email' => $this->form_data['customer_email'],
						),
						'card'  => array(
							'number'    => $this->posted['card_number'],
							'exp_month' => $this->posted['expiry_month'],
							'exp_year'  => $this->posted['expiry_year'],
							'cvc'       => $this->posted['card_code'],
						),
						'key'   => $this->publish_key,
					),
					'sources'
				);

				return $sources;
			}

			return false;
		}

		/**
		 * Send to Stripe.
		 *
		 * @return bool|object
		 */
		public function send_to_stripe( $customer_id ) {
			if ( $this->get_form_data() ) {
				$stripe_charge_data['source']               = $this->form_data['source'];
				$stripe_charge_data['amount']               = $this->form_data['amount'];
				$stripe_charge_data['currency']             = $this->form_data['currency'];
				$stripe_charge_data['description']          = $this->form_data['description'];
				$stripe_charge_data['metadata']             = array(
					'customer_name'  => $this->form_data['customer_name'],
					'customer_email' => $this->form_data['customer_email'],
					'order_id'       => $this->form_data['order_id'],
					'site_url'       => $this->form_data['site_url'],
				);
				$stripe_charge_data['capture_method']       = 'automatic';
				$stripe_charge_data['payment_method_types'] = $this->form_data['payment_method_types'];
				$stripe_charge_data['customer']             = $customer_id;

				$charge       = $this->post_data( $stripe_charge_data, 'payment_intents' );
				$this->charge = $charge;

				return $charge;
			}

			return false;
		}

		/**
		 * Get form data.
		 *
		 * @return array
		 */
		public function get_form_data() {
			if ( $this->order ) {
				$user            = learn_press_get_current_user();
				$this->form_data = array(
					'amount'               => (float) $this->order->order_total * 100,
					'currency'             => strtolower( learn_press_get_currency() ),
					'source'               => $this->source,
					'description'          => sprintf( '%s - Order %s', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ), $this->order->id ),
					'customer_name'        => $this->order->get_customer_name(),
					'customer_email'       => ! empty( $this->order->get_user( 'email' ) ) ? $this->order->get_user( 'email' ) : $this->order->get_checkout_email(),
					'order_id'             => $this->order->id,
					'site_url'             => esc_url( get_site_url() ),

					'payment_method_types' => array(
						'card',
					),
					'errors'               => isset( $this->posted['form_errors'] ) ? $this->posted['form_errors'] : '',
				);
			}

			return $this->form_data;
		}

		/**
		 * Post data and get json.
		 *
		 * @param $post_data
		 * @param string    $post_location
		 *
		 * @return object
		 * @throws string
		 */
		public function post_data( $post_data, $post_location = 'charges', $method = 'POST' ) {
			$response = wp_remote_post(
				$this->api_endpoint . $post_location,
				array(
					'method'     => $method,
					'headers'    => array(
						'Authorization' => 'Basic ' . base64_encode( $this->secret_key . ':' ),
					),
					'body'       => $post_data,
					'timeout'    => 70,
					'sslverify'  => false,
					'user-agent' => 'LearnPress Stripe',
				)
			);

			return $this->parse_response( $response );
		}


		/**
		 * Parse response.
		 *
		 * @param $response
		 *
		 * @return array|mixed|object
		 * @throws Exception
		 */
		public function parse_response( $response ) {
			if ( is_wp_error( $response ) ) {

				throw new Exception( 'error' );
			}

			if ( empty( $response['body'] ) ) {
				throw new Exception( 'error' );
			}

			$parsed_response = json_decode( $response['body'] );

			return $parsed_response;
		}

		/**
		 * Validate form fields.
		 */
		public function validate_fields() {
			$posted        = learn_press_get_request( 'learn-press-stripe' );
			$card_number   = ! empty( $posted['card_number'] ) ? $posted['card_number'] : null;
			$expiry_month  = ! empty( $posted['expiry_month'] ) ? $posted['expiry_month'] : 1;
			$expiry_year   = ! empty( $posted['expiry_year'] ) ? $posted['expiry_year'] : ( (int) date( 'Y', time() ) ) + 1;
			$card_expiry   = $expiry_month . '/' . $expiry_year;
			$card_code     = ! empty( $posted['card_code'] ) ? $posted['card_code'] : null;
			$error_message = array();

			if ( empty( $card_number ) ) {
				$error_message[] = esc_html__( 'Card number is empty.', 'learnpress-stripe' );
			}

			if ( empty( $card_expiry ) ) {
				$error_message[] = esc_html__( 'Card expiry is empty.', 'learnpress-stripe' );
			}

			if ( empty( $card_code ) ) {
				$error_message[] = esc_html__( 'Card code is empty.', 'learnpress-stripe' );
			}

			if ( ! empty( $error_message ) ) {
				throw new Exception( sprintf( '<div>%s</div>', implode( '</div><div>', $error_message ) ), 8000 );
			}

			$this->posted = $posted;

			return ! empty( $error_message ) ? false : true;
		}

		/**
		 * Complete order.
		 */
		public function order_complete() {

			if ( $this->order->status === 'completed' ) {
				return;
			}

			$this->order->payment_complete();
			LP()->cart->empty_cart();

			// $this->order->add_note(
			// sprintf(
			// "%s payment completed with Transaction Id of '%s'",
			// $this->title,
			// $this->charge->id
			// )
			// );

			LP()->session->order_awaiting_payment = null;
		}
	}
}
