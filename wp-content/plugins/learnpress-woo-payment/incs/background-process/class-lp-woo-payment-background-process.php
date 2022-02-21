<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Woo_Payment_Background_Process' ) ) {
	/**
	 * Class LP_Background_Single_Course
	 *
	 * Single to run not schedule, run one time and done when be call
	 *
	 * @since 4.1.1
	 * @author tungnx
	 */
	class LP_Woo_Payment_Background_Process extends WP_Async_Request {
		protected $prefix = 'lp_woo_payment';
		protected $action = 'create_lp_order_when_payment_woocommerce';
		protected static $instance;

		/**
		 * @throws Exception
		 */
		protected function handle() {
			$params = array(
				'lp_order_id'    => intval( $_POST['lp_order_id'] ) ?? 0,
				'lp_order_items' => LP_Helper::sanitize_params_submitted( $_POST['lp_order_items'] ?? 0 ),
				'lp_status'      => $_POST['lp_status'] ?? '',
			);

			$this->handleAddItemsToLpOrderBackground( $params );
		}

		/**
		 * handle add course to lp_order
		 *
		 * @param array $params
		 *
		 * @throws Exception
		 */
		protected function handleAddItemsToLpOrderBackground( array $params ) {
			$order_id  = $params['lp_order_id'] ?? 0;
			$lp_status = $params['lp_status'] ?? '';

			$lp_order = learn_press_get_order( $order_id );

			if ( ! $lp_order ) {
				error_log( __FUNCTION__ . ': lp order is invalid!' );
			}

			$lp_order_items = (array) $params['lp_order_items'] ?? array();

			foreach ( $lp_order_items as $course ) {
				$item_id        = $course['item_id'] ?? 0;
				$order_total    = $course['order_total'] ?? 0;
				$order_subtotal = $course['order_subtotal'] ?? 0;

				$item = array(
					'item_id'         => $item_id,
					'order_item_name' => get_the_title( $item_id ),
					'subtotal'        => $order_subtotal,
					'total'           => $order_total,
				);

				$lp_order->add_item( $item );
			}

			$lp_order->set_status( $lp_status );
			$lp_order->save();
		}

		/**
		 * @return LP_Woo_Payment_Background_Process
		 */
		public static function instance(): self {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}

	// Must run instance to register ajax.
	LP_Woo_Payment_Background_Process::instance();
}
