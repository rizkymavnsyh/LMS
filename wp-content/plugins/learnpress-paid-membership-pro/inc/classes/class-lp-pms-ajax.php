<?php

/**
 * Class LP_PMS_Ajax
 *
 * @description handle ajax
 * @version     1.0.0
 * @since       3.1.10
 * @author      tungnx
 */
class LP_PMS_Ajax {
	protected static $_ajax_request = array(
		'addItemToLpOrder',
		'updateStatusUserCoursesByLevel',
	);

	public static function __init() {
		foreach ( self::$_ajax_request as $request ) {
			add_action( 'wp_ajax_' . $request, array( __CLASS__, $request ) );
			add_action( 'wp_ajax_nopriv_' . $request, array( __CLASS__, $request ) );
		}

		// add_action( 'wp_ajax_addItemToLpOrder', array( __CLASS__, 'addItemToLpOrder' ) );
		// add_action( 'wp_ajax_nopriv_addItemToLpOrder', array( __CLASS__, 'addItemToLpOrder' ) );
	}

	public static function addItemToLpOrder() {
		$result = array(
			'code'    => 0,
			'message' => '',
			'errors'  => array(),
		);

		if ( isset( $_POST['order_id'] ) && isset( $_POST['course_id'] )
			&& isset( $_POST['user_id'] ) ) {
			$order_id  = absint( $_POST['order_id'] );
			$course_id = absint( $_POST['course_id'] );
			$user_id   = absint( $_POST['user_id'] );

			// get_current_user_id() can't get user current on here if is curl

			// Check user, if Admin or User same is valid
			/*
			if ( current_user_can( 'administrator' ) ) {
				# Check user exists
				if ( ! get_user_by( 'id', $user_id ) ) {
					return false;
				}
			} elseif ( get_current_user_id() != $user_id ) {
				return false;
			}*/

			$user = get_user_by( 'id', $user_id );

			if ( ! $user ) {
				$result['message'] = 'User invalid';
				wp_send_json( $result );
			}

			$lp_order = learn_press_get_order( $order_id );

			// Add item to order
			$order_item_id = $lp_order->add_item( $course_id );

			// Update user item
			if ( LP()->settings()->get( 'auto_enroll' ) == 'yes' ) {
				$status = 'enrolled';
			} else {
				$status = 'purchased';
			}

			learn_press_update_user_item_field(
				array(
					'user_id'    => $user_id,
					'item_id'    => $course_id,
					'start_time' => current_time( 'mysql' ),
					'status'     => $status,
					'end_time'   => '',
					'ref_id'     => $order_id,
					'item_type'  => LP_COURSE_CPT,
					'ref_type'   => LP_ORDER_CPT,
					'parent_id'  => $user->get_course_history_id( $course_id ),
				// 'parent_id'  => 0
				)
			);

			// $lp_order->save();

			if ( $order_item_id ) {
				$result['code']    = 1;
				$result['item_id'] = $order_item_id;
			}
		} else {
			$result['message'] = 'Request invalid';
		}

		wp_send_json( $result );
	}

	public static function updateStatusUserCoursesByLevel() {
		$result = array(
			'code'    => 0,
			'message' => '',
			'errors'  => array(),
		);

		if ( ! isset( $_POST['user_id'] ) || ! isset( $_POST['course_id'] )
		|| ! isset( $_POST['status'] ) || ! isset( $_POST['order_id'] ) ) {
			$result['message'] = 'Request invalid';
			wp_send_json( $result );
		}

		$order_id  = absint( $_POST['order_id'] );
		$user_id   = absint( $_POST['user_id'] );
		$course_id = absint( $_POST['course_id'] );
		$status    = sanitize_text_field( $_POST['status'] );

		learn_press_update_user_item_field(
			array(
				'user_id'   => $user_id,
				'item_id'   => $course_id,
				'status'    => $status,
				'ref_id'    => $order_id,
				'item_type' => LP_COURSE_CPT,
				'ref_type'  => LP_ORDER_CPT,

			// 'parent_id'  => 0
			)
		);

		wp_send_json( $result );
	}

}

LP_PMS_Ajax::__init();
