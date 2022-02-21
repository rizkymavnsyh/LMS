<?php
/**
 * Class LP_PMS_Order
 */

class LP_PMS_Order {
	public static $_instance;
	public static $_payment_method       = 'paid-memberships-pro';
	public static $_payment_method_title = '';
	public static $_key_lp_pmpro_level   = '_lp_pmpro_level'; // meta key for lp_order
	public static $_key_lp_pmpro_levels  = '_lp_pmpro_levels'; // meta key for lp_course
	public static $_loaded               = false;
	public static $_LIMIT_COURSES;
	public static $_LIMIT_ORDERS;
	public static $_CALL_CRON_JOB_AFTER_SECOND;
	public $_MBS_USER_OLD_LEVELS = array();

	public $redirect    = false;
	public $user_orders = array();

	public function __construct() {
		self::$_LIMIT_COURSES              = apply_filters( 'learn-press/pmspro/limit-courses', 10 );
		self::$_LIMIT_ORDERS               = apply_filters( 'learn-press/pmspro/limit-orders', 10 );
		self::$_CALL_CRON_JOB_AFTER_SECOND = apply_filters(
			'learn-press/pmspro/time-call-cron-job-after-second',
			5
		);

		add_filter( 'learn_press_display_payment_method_title', array( $this, 'display_payment_method_title' ), 10, 2 );

		// creat order membership success
		add_action(
			'pmpro_after_checkout',
			array( $this, 'create_order_membership_success' ),
			10,
			2
		);
		add_action(
			'pmpro_membership_post_membership_expiry',
			array( $this, 'cronjob_user_membership_expire' ),
			10,
			2
		);
		add_action(
			'pmpro_before_change_membership_level',
			array( $this, 'before_update_lp_orders_when_change_membership_level' ),
			11,
			4
		);
		add_action(
			'pmpro_after_change_membership_level',
			array( $this, 'update_lp_orders_when_change_membership_level' ),
			11,
			3
		);

		add_action(
			'hook_single_event_add_courses_to_lp_order',
			array( $this, 'handleAddItemsToLpOrderCronjob' ),
			10,
			1
		);
		add_action(
			'hook_single_event_add_courses_to_lp_orders_when_save_level',
			array( $this, 'handleAddItemsToLpOrdersCronjobWhenCoursesLevelChange' ),
			10,
			1
		);
		// add_action( 'hook_single_event_add_courses_to_lp_order_when_save_level', array( $this, 'handleAddItemsToLpOrderCronjobWhenCoursesLevelChange' ), 10, 1 );

		// pmprommpu_addMembershipLevel | case multiple level

		// Admin add order
		add_action( 'pmpro_add_order', array( $this, 'pms_added_order_will_add_lp_order' ) );

		// Admin change status order
		add_action( 'pmpro_update_order', array( $this, 'pms_updated_order_will_add_lp_order' ) );
	}

	public function display_payment_method_title( $title, $payment_method ) {
		if ( self::$_payment_method == $payment_method ) {
			return $this->get_payment_method_title();
		}

		return $title;
	}

	public function get_order_level( $lp_order_id ) {
		$level_id = get_post_meta( $lp_order_id, self::$_key_lp_pmpro_level, true );
		if ( ! $level_id || empty( $level_id ) ) {
			return false;
		}
		$all_levels = pmpro_getAllLevels();
		if ( ! $all_levels || empty( $all_levels ) ) {
			return array();
		}
		$all_levels_id = array_keys( $all_levels );
		if ( in_array( $level_id, $all_levels_id ) ) {
			return $level_id;
		}

		return false;
	}

	public function get_payment_method_title() {
		if ( ! self::$_payment_method_title ) {
			self::$_payment_method_title = __(
				'Pay via <strong>Paid Memberships Pro</strong>',
				'learnpress-paid-membership-pro'
			);
		}

		return self::$_payment_method_title;
	}

	/**
	 * Get all user's order created for memberships level
	 *
	 * @param int $user_id
	 * @param int $level_id
	 *
	 * @return array|mixed|object|NULL
	 */
	public function get_user_orders( $user_id = null, $level_id = null ) {
		global $wpdb;
		if ( ! $user_id ) {
			$user_id = learn_press_get_current_user_id();
		}

		if ( ! $this->user_orders ) {
			$args_meta_query = array(
				array(
					'key'   => '_user_id',
					'value' => $user_id,
				),
			);

			$args = array(
				'post_type'   => LP_ORDER_CPT,
				'post_status' => 'any',
				'meta_key'    => self::$_key_lp_pmpro_level,
				'meta_query'  => $args_meta_query,
			);

			if ( $level_id ) {
				$args['meta_value'] = $level_id;
			}

			$orders = get_posts( $args );

			if ( ! empty( $orders ) ) {
				foreach ( $orders as $order ) {
					$order_level = get_post_meta( $order->ID, '_lp_pmpro_level', true );
					if ( ! isset( $this->user_orders[ $order_level ] ) ) {
						$this->user_orders[ $order_level ] = array(
							$order->ID => $order,
						);
					} elseif ( ! isset( $this->user_orders[ $order_level ][ $order->ID ] ) ) {
						$this->user_orders[ $order_level ][ $order->ID ] = $order;
					}
				}
			}
		}

		return $this->user_orders;
	}

	private function hasMembershipLevel( $level_id, $user_id ) {
		return learn_press_pmpro_hasMembershipLevel( $level_id, $user_id );
	}

	private function set_order_completed( $order_id, $order_note = '' ) {
		$order = learn_press_get_order( $order_id );
		if ( 'completed' !== $order->get_status() ) {
			$order->set_status( 'completed', $order_note );
			$order->save();

			return true;
		}

		return false;
	}

	private function set_order_cancelled( $order_id, $order_note = '' ) {
		$order = learn_press_get_order( $order_id );
		if ( $order->has_status( 'completed' ) ) {
			$order->update_status( 'cancelled' );

			return true;
		}

		return false;
	}

	/**
	 * Get Order of user
	 *
	 * @param null     $user_id
	 * @param $level_id
	 *
	 * @return false|mixed
	 */
	public function get_user_order( $user_id = null, $level_id = 0 ) {
		global $wpdb;
		if ( ! $user_id ) {
			$user_id = learn_press_get_current_user_id();
		}
		if ( ! isset( $this->user_orders[ $level_id ] ) || empty( $this->user_orders[ $level_id ] ) ) {
			return false;
		}

		return $this->user_orders[ $level_id ];
	}

	public function update_lp_order( $lp_order_id ) {

		$update_access_course = LP()->settings()->get( 'pmpro_update_access_course', 'yes' );
		$level_id             = $this->get_order_level( $lp_order_id );
		if ( $level_id ) {
			$meta_key       = '_payment_method';
			$meta_value     = 'paid-memberships-pro';
			$payment_method = get_post_meta( $lp_order_id, $meta_key );
			if ( $meta_value !== $payment_method ) {
				update_post_meta( $lp_order_id, $meta_key, $meta_value );
			}
		}

		if ( $update_access_course == 'no' ) {
			return false;
		}

		$lp_order      = learn_press_get_order( $lp_order_id );
		$order_courses = ( $lp_order->get_item_ids() );
		if ( ! $order_courses ) {
			$order_courses = array();
		}

		$level_courses = array_keys( $this->get_courses_by_level( $level_id ) );

		$add_courses = array_diff( $level_courses, $order_courses );
		$rem_courses = array_diff( $order_courses, $level_courses );
		if ( empty( $add_courses ) && empty( $rem_courses ) ) {
			return false;
		}

		$change = false;
		if ( ! empty( $add_courses ) ) {
			foreach ( $add_courses as $cid ) {
				$lp_order->add_item( intval( $cid ) );
			}
			$change         = true;
			$this->redirect = true;
		}

		if ( ! empty( $rem_courses ) ) {
			foreach ( $rem_courses as $item_id => $cid ) {
				$lp_order->remove_item( intval( $item_id ) );
			}
			$change = true;
		}

		if ( $change ) {
			$lp_order->save();
			$this->redirect = true;
		}

		return $change;
	}

	/**
	 * Create Lp order
	 *
	 * @param int $user_id
	 * @param int $level_id
	 *
	 * @return bool|int|WP_Error
	 */
	public function create_lp_order( $user_id = 0, $level_id = 0 ) {
		global $action;

		$action = 'no_editpost'; // learnpress\inc\custom-post-types\order.php search editpost

		// Check user, if Admin or User same is valid
		if ( current_user_can( 'administrator' ) ) {
			// Check user exists
			if ( ! get_user_by( 'id', $user_id ) ) {
				return new WP_Error( 'lp_pms_create_order', 'User not exists' );
			}
		} //Todo: Check why something didn't get current user_id
		elseif ( get_current_user_id() != $user_id ) { // Temporary not check
			return new WP_Error( 'lp_pms_create_order', 'Invalid User! You can\'t create LP Order' );
		}

		// get total courses by level
		$totalCourses = $this->get_total_courses_by_level( $level_id );

		if ( empty( $totalCourses ) || ! isset( $totalCourses->total ) || $totalCourses->total == 0 ) {
			return new WP_Error( 'lp_pms_create_order', 'Don\'t have any courses on level PMS' );
		}

		$totalPage = ceil( $totalCourses->total / self::$_LIMIT_COURSES );

		// create order
		$level      = pmpro_getLevel( $level_id );
		$level_cost = learn_press_pmpro_getLevelCost( $level, $user_id );
		$order_data = array(
			'post_author' => $user_id,
			'post_parent' => '0',
			'post_type'   => LP_ORDER_CPT,
			'post_status' => 'lp-completed',
			'ping_status' => 'closed',
			'post_title'  => __(
				'Order on',
				'learnpress-paid-membership-pro'
			) . ' ' . current_time( 'l jS F Y h:i:s A' ),
			'meta_input'  => array(
				'_user_id'                 => $user_id,
				'_created_via'             => 'lp_pms',
				'_payment_method'          => self::$_payment_method,
				'_payment_method_title'    => __( 'Memberships', 'learnpress-paid-membership-pro' ),
				'_order_total'             => $level_cost,
				self::$_key_lp_pmpro_level => $level_id,
			),
		);

		if ( isset( $_SESSION['wc_order_change_completed'] ) ) {
			/**
			 * @var WC_Order $_wc_order
			 */
			$_wc_order = $_SESSION['wc_order_change_completed'];

			$order_data['meta_input']['_woo_order_id']         = $_wc_order->get_id();
			$order_data['meta_input']['_payment_method']       = $_wc_order->get_payment_method();
			$order_data['meta_input']['_payment_method_title'] = 'Woocommerce: ' . $_wc_order->get_payment_method_title();

			unset( $_SESSION['wc_order_change_completed'] );
		}

		$order_id = wp_insert_post( $order_data );
		// End create order

		if ( $order_id instanceof WP_Error ) {
			return $order_id;
		}

		// Todo: Optimize ##############
		// step 1 - insert learnpress_order_items
		// step 2 - insert learnpress_order_itemmeta
		// step 3 - insert/update user_item_field
		// End Optimize ###############

		$run_mode_setting       = LP()->settings()->get( 'pmpro_run_mode', 'auto' );
		$run_mode               = 'normal';
		$max_time_execute_limit = ini_get( 'max_execution_time' );

		if ( $run_mode_setting == 'auto' ) {
			if ( $totalCourses->total > 10 && LP_Addon_Paid_Memberships_Pro_Preload::$_WP_CRON_STATUS ) {
				$run_mode = 'background';
			} else {
				$run_mode = 'normal';
			}
		} else {
			$run_mode = $run_mode_setting;
		}

		switch ( $run_mode ) {
			case 'background':
				/*** Handle via Cronjob */
				// $this->handleAddItemsToLpOrderCronjob( $params );
				$paramsCronjob = array(
					'params' => array(
						'lp_order_id' => $order_id,
						'level_id'    => $level_id,
						'total_page'  => $totalPage,
						'p'           => 0,
						'user_id'     => $user_id,
						'limit'       => self::$_LIMIT_COURSES,
					),
				);
				wp_schedule_single_event(
					current_time( 'timestamp' ),
					'hook_single_event_add_courses_to_lp_order',
					$paramsCronjob
				);
				/*** End handle via Cronjob */
				break;
			case 'normal':
			default:
				$params = array(
					'lp_order_id' => $order_id,
					'level_id'    => $level_id,
					'total_page'  => $totalPage,
					'p'           => 0,
					'user_id'     => $user_id,
					'limit'       => $totalCourses->total,
				);
				$this->getCoursesByLevelAddToLpOrder( $params );
				break;
		}

		/*
		$params = array(
			'order_id'   => $order_id,
			'level_id'   => $level_id,
			'total_page' => $totalPage,
			'p'          => 0,
			'user_id'    => $user_id,
			'limit'      => LP_PMS_Order::$_LIMIT_COURSES,
		);

		$this->handleAddItemToLpOrderCurl( $params ); */

		// die;

		return $order_id;
	}

	/**
	 * Get total courses by MemberShip level
	 *
	 * @param int $level_id
	 *
	 * @return array|object|null
	 */
	public function get_total_courses_by_level( $level_id = 0 ) {
		global $wpdb;
		$tabel_post     = $wpdb->posts;
		$tabel_postmeta = $wpdb->postmeta;

		$sql = $wpdb->prepare(
			"SELECT COUNT(p.ID) as total
					FROM $tabel_post AS p
					INNER JOIN $tabel_postmeta AS pm
					ON p.ID = pm.post_id
					WHERE pm.meta_key = %s
					AND pm.meta_value = %s
					AND p.post_type = %s
					AND p.post_status = 'publish'",
			self::$_key_lp_pmpro_levels,
			$level_id,
			LP_COURSE_CPT
		);

		$result = $wpdb->get_row( $sql );

		return $result;
	}

	/**
	 * Create lp order when checkout membership success
	 *
	 * @param int         $user_id
	 * @param MemberOrder $morder
	 *
	 * @throws Exception
	 */
	public function create_order_membership_success( $user_id, $morder ) {
		// var_dump( $user_id, $morder );

		if ( ! empty( $morder ) && $morder instanceof MemberOrder ) {
			if ( isset( $morder->status ) && $morder->status == 'success'
				 && isset( $morder->membership_id ) ) {
				// $this->create_lp_order( $user_id, $morder->membership_id );
			}
		}
	}

	/**
	 * @param array $params
	 */
	public function handleAddItemToLpOrderCurl( $params ) {
		$total_item_success = 0;
		$courses            = LP_PMS_DB::getInstance()->getCoursesByLevel(
			$params['level_id'],
			$params['p'],
			$params['limit']
		);

		$curlMultiProcess = curl_multi_init();
		$curlArr          = array();

		foreach ( array_keys( $courses ) as $course_id ) {
			$params_send              = $params;
			$params_send['action']    = 'addItemToLpOrder';
			$params_send['course_id'] = $course_id;

			$headers     = array();
			$params_send = http_build_query( $params_send );
			$curl        = LP_PMS_Handle_Curl::curl( 'POST', $params_send, $headers );

			array_push( $curlArr, $curl );
			curl_multi_add_handle( $curlMultiProcess, $curl );
		}

		LP_PMS_Handle_Curl::curlMultipleExec(
			$curlMultiProcess,
			$curlArr,
			function ( $response ) use ( &$total_item_success ) {
				if ( isset( $response ) && $response->code == 1 ) {
					$total_item_success ++;
				}
			}
		);

		++ $params['p'];

		/*
		$path_file = GMC_PHYS_PATH . 'test.log';
		$file      = fopen( $path_file, 'a+' );
		fwrite( $file, 'P: ' . $params['p'] . PHP_EOL );
		fwrite( $file, 'Total success : ' . $total_item_success . PHP_EOL );
		fclose( $file );
		*/

		if ( $params['p'] < $params['total_page'] ) {
			$this->handleAddItemToLpOrderCurl( $params );
		}
	}

	/**
	 * Run cron-job add courses to lp order
	 *
	 * @param array $params
	 */
	public function handleAddItemsToLpOrderCronjob( $params = array() ) {
		$params_rs = $this->getCoursesByLevelAddToLpOrder( $params );

		if ( isset( $params_rs['code'] ) && $params_rs['code'] == 1 ) {
			++ $params_rs['p'];

			if ( $params_rs['p'] < $params_rs['total_page'] ) {
				$paramsCronjob = array(
					'params' => $params_rs,
				);

				wp_schedule_single_event(
					current_time( 'timestamp' ),
					'hook_single_event_add_courses_to_lp_order',
					$paramsCronjob
				);
			}
		}
	}

	private function getCoursesByLevelAddToLpOrder( $params = array() ) {
		if ( ! isset( $params['level_id'] ) || ! isset( $params['p'] )
			 || ! isset( $params['limit'] ) ) {
			debugLogLpPms( 'getCoursesByLevelAddToLpOrder: Params is invalid!' );
			$params['code'] = 0;

			return $params;
		}

		$params_rs = array();

		$courses = LP_PMS_DB::getInstance()->getCoursesByLevel( $params['level_id'], $params['p'], $params['limit'] );

		if ( is_array( $courses ) && count( $courses ) > 0 ) {
			$course_ids = array_keys( $courses );
			$params_rs  = $this->addItemsToLpOrder( $params, $course_ids );
		} else {
			debugLogLpPms( 'getCoursesByLevelAddToLpOrder: Don\'t have any courses' );
		}

		return $params_rs;
	}

	/**
	 * Add courses to Lp order
	 *
	 * @param array $params | data example array('lp_order_id' => 1, 'level_id' => 2, 'total_page' => 2, 'p', 'user_id' => 2, 'limit' => 1)
	 * @param array $new_course_ids | data example array(1, 2, 3)
	 *
	 * @return array
	 */
	private function addItemsToLpOrder( $params = array(), $new_course_ids = array() ) {
		if ( ! isset( $params['lp_order_id'] ) || ! isset( $params['user_id'] ) ) {

			debugLogLpPms( 'addItemsToLpOrder: Params is invalid!' );
			$params['code'] = 0;

			return $params;
		}

		$lp_order_id = $params['lp_order_id'];
		$lp_order    = learn_press_get_order( $lp_order_id );
		$user_id     = $params['user_id'];

		// set status user item
		if ( LP()->settings()->get( 'auto_enroll' ) == 'yes' ) {
			$status = 'enrolled';
		} else {
			$status = 'purchased';
		}

		foreach ( $new_course_ids as $course_id ) {

			// Add item to order
			$result_add_course = $lp_order->add_item( $course_id );

			if ( ! $result_add_course ) {
				debugLogLpPms( 'Errors add course ' . $course_id . ' to order' );
				$params['code'] = 0;

				return $params;
			}

			// Update user item
			$result_update_user_item_field = learn_press_update_user_item_field(
				array(
					'user_id'    => $user_id,
					'item_id'    => $course_id,
					'start_time' => current_time( 'mysql' ),
					'status'     => $status,
					'end_time'   => '',
					'ref_id'     => $lp_order->get_id(),
					'item_type'  => LP_COURSE_CPT,
					'ref_type'   => LP_ORDER_CPT,
					'parent_id'  => 0,
				)
			);

			if ( ! $result_update_user_item_field ) {
				debugLogLpPms( 'Errors update user item field with course id: ' . $course_id );
				$params['code'] = 0;

				return $params;
			}

			$params['code'] = 1;
		}

		return $params;
	}

	/**
	 * Handle when membership expire
	 *
	 * @param int $user_id
	 * @param int $membership_id
	 *
	 * @since
	 * @author tungnx
	 */
	public function cronjob_user_membership_expire( $user_id, $membership_id ) {
		// Get last order of user has level
		$result = LP_PMS_DB::getInstance()->getLastOrderMembershipOfUser( $user_id, $membership_id );

		/*
		$path_file = GMC_PHYS_PATH . 'test.log';
		$file      = fopen( $path_file, 'a+' );
		fwrite( $file, 'P: ' . json_encode( $result ) . PHP_EOL );
		fclose( $file );
		*/

		if ( $result ) {
			$order_id = $result->post_id;

			$args = array(
				'ID'          => $order_id,
				'post_status' => 'lp-cancelled',
			);

			wp_update_post( $args );

			// Update status cancelled of each course item
			$course_item_status = 'cancelled';
			LP_PMS_DB::getInstance()->updateStatusCoursesByOrderAndUser( $user_id, $order_id, $course_item_status );
		}
	}

	public function before_update_lp_orders_when_change_membership_level(
		$level_id = 0,
		$user_id = 0,
		$old_levels = array(),
		$cancel_level = 0
	) {
		if ( ! empty( $old_levels ) ) {
			$this->_MBS_USER_OLD_LEVELS = $old_levels;
		}
	}

	/**
	 * 1. Create LP order when subscription level membership (or via Woo) and delete old level if exits
	 * 2. Cancel level will delete LP order
	 *
	 * @param int $level_id
	 * @param int $user_id
	 * @param int $cancel_level
	 */
	public function update_lp_orders_when_change_membership_level( $level_id = 0, $user_id = 0, $cancel_level = 0 ) {

		// var_dump( $level_id, $user_id, $cancel_level );

		if ( ! empty( $cancel_level ) ) { // Cancel level
			$this->LpOrderCancel( $user_id, $cancel_level );
			// $this->LpOrderDelete( $user_id, $cancel_level );
		} elseif ( ! empty( $level_id ) && ! empty( $this->_MBS_USER_OLD_LEVELS ) && ! empty( $user_id ) ) {
			// Cancel orders old
			foreach ( $this->_MBS_USER_OLD_LEVELS as $membership_user_level ) {
				if ( isset( $membership_user_level->ID ) ) {
					$this->LpOrderCancel( $user_id, $membership_user_level->ID );
					// $this->LpOrderDelete( $user_id, $membership_user_level->ID );
				}
			}

			// Create LP order and add items
			$order_id = $this->create_lp_order( $user_id, $level_id );

			if ( $order_id instanceof WP_Error ) {
				debugLogLpPms( $order_id->get_error_message() );
			}
		} elseif ( ! empty( $level_id ) && ! empty( $user_id ) ) { // Create LP order and add items
			$order_id = $this->create_lp_order( $user_id, $level_id );

			if ( $order_id instanceof WP_Error ) {
				debugLogLpPms( $order_id->get_error_message() );
			}
		} elseif ( ! empty( $user_id ) && ! empty( $this->_MBS_USER_OLD_LEVELS ) ) {

			// Admin cancel level of user
			if ( $_REQUEST['membership_level'] === 0 || $_REQUEST['membership_level'] === '0' || $_REQUEST['membership_level'] == '' ) {
				foreach ( $this->_MBS_USER_OLD_LEVELS as $membership_user_level ) {
					if ( isset( $membership_user_level->ID ) ) {
						$this->LpOrderCancel( $user_id, $membership_user_level->ID );
						// $this->LpOrderDelete( $user_id, $membership_user_level->ID );
					}
				}
			}
		}

		// die;
	}

	public function LpOrderCancel( $user_id, $cancel_level_id ) {
		global $action;

		$action = 'no_editpost'; // learnpress\inc\custom-post-types\order.php search editpost

		if ( empty( $user_id ) || empty( $cancel_level_id ) ) {
			return;
		}

		$lpOrder = LP_PMS_DB::getInstance()->getLastOrderMembershipOfUser( $user_id, $cancel_level_id );

		if ( $lpOrder && isset( $lpOrder->post_id ) ) {
			$args = array(
				'ID'          => $lpOrder->post_id,
				'post_status' => 'lp-cancelled',
			);

			$resultStatusLpOrder = wp_update_post( $args );

			if ( $resultStatusLpOrder instanceof WP_Error ) {
				return;
			}

			$resultStatusLpOrderItems = LP_PMS_DB::getInstance()->updateStatusCoursesByOrderAndUser(
				$user_id,
				$lpOrder->post_id,
				'cancelled'
			);

			/*
			$path_file = GMC_PHYS_PATH . 'test.log';
			$file      = fopen( $path_file, 'a+' );
			fwrite( $file, PHP_EOL . 'Time: ' . date( 'Y-m-d H:i:s' ) . PHP_EOL );
			fwrite( $file, PHP_EOL . 'Cancelled status lp order: ' . json_encode( $resultStatusLpOrder ) . PHP_EOL );
			fclose( $file );*/
		}
	}

	public function LpOrderDelete( $user_id = 0, $cancel_level_id = 0 ) {
		global $action;
		$result = false;

		$action = 'no_editpost'; // learnpress\inc\custom-post-types\order.php search editpost

		if ( empty( $user_id ) || empty( $cancel_level_id ) ) {
			return false;
		}

		$lpOrder = LP_PMS_DB::getInstance()->getLastOrderMembershipOfUser( $user_id, $cancel_level_id );

		if ( $lpOrder && isset( $lpOrder->post_id ) ) {
			$result = wp_delete_post( $lpOrder->post_id, true );

			if ( $result instanceof WP_Post ) {
				$result = true;
			}

			// Delete in lp_order_items
			// Delete in lp_order_itemmeta
			// Delete in lp_user_items
			// Delete in lp_user_itemmeta
		}

		return $result;
	}

	/**
	 * Delete courses in lp orders
	 *
	 * @param array $order_ids | data example array(1 ,2, 3)
	 * @param array $del_course_ids
	 */
	public function deleteCoursesOnOrders( $order_ids = array(), $del_course_ids = array() ) {
		// get user_item_ids
		$user_item_ids = LP_PMS_DB::getInstance()->getUserItemIds( $order_ids, $del_course_ids );

		// get user item ids
		if ( is_array( $user_item_ids ) && count( $user_item_ids ) > 0 ) {
			$user_item_ids = array_keys( $user_item_ids );

			$rsDeleteUserItemmeta = LP_PMS_DB::getInstance()->deleteUserItemmeta( $user_item_ids );
			$rsDeleteUserItems    = LP_PMS_DB::getInstance()->deleteUserItems( $user_item_ids );
		}

		// get order item ids
		$order_item_ids = LP_PMS_DB::getInstance()->getOrderItemIds( $order_ids, $del_course_ids );

		if ( is_array( $order_item_ids ) && count( $order_item_ids ) > 0 ) {
			$order_item_ids = array_keys( $order_item_ids );

			$rsDeleteOrderItemmeta = LP_PMS_DB::getInstance()->deleteOrderItemmeta( $order_item_ids );
			$rsDeleteOrderItems    = LP_PMS_DB::getInstance()->deleteOrderItems( $order_item_ids );
		}
	}

	/**
	 * Delete courses in lp order
	 *
	 * @param int   $order_id
	 * @param array $del_course_ids
	 */
	public function deleteCoursesOnOrder( $order_id = 0, $del_course_ids = array() ) {
		// get user item ids
		$user_item_ids = LP_PMS_DB::getInstance()->getUserItemIds( array( $order_id ), $del_course_ids );

		// get user item ids
		if ( is_array( $user_item_ids ) && count( $user_item_ids ) > 0 ) {
			$user_item_ids = array_keys( $user_item_ids );

			$rsDeleteUserItemmeta = LP_PMS_DB::getInstance()->deleteUserItemmeta( $user_item_ids );
			$rsDeleteUserItems    = LP_PMS_DB::getInstance()->deleteUserItems( $user_item_ids );
		}

		// get order item ids
		$order_item_ids = LP_PMS_DB::getInstance()->getOrderItemIds( array( $order_id ), $del_course_ids );

		if ( is_array( $order_item_ids ) && count( $order_item_ids ) > 0 ) {
			$order_item_ids = array_keys( $order_item_ids );

			$rsDeleteOrderItemmeta = LP_PMS_DB::getInstance()->deleteOrderItemmeta( $order_item_ids );
			$rsDeleteOrderItems    = LP_PMS_DB::getInstance()->deleteOrderItems( $order_item_ids );
		}
	}

	// Find orders of users has level and add courses

	/**
	 * Add courses to lp orders
	 *
	 * @param array $lp_orders
	 * @param array $new_course_ids
	 *
	 * @format object $lp_orders user_id, user_id
	 */
	public function addCoursesToOrders( $lp_orders, $new_course_ids = array() ) {
		$run_mode_setting = LP()->settings()->get( 'pmpro_run_mode', 'auto' );
		$run_mode         = 'normal';

		$total_orders  = count( $lp_orders );
		$total_courses = count( $new_course_ids );

		if ( $run_mode_setting == 'auto' ) {
			if ( ( $total_orders > 10 || $total_courses > 10 ) && LP_Addon_Paid_Memberships_Pro_Preload::$_WP_CRON_STATUS ) {
				$run_mode = 'background';
			} else {
				$run_mode = 'normal';
			}
		} else {
			$run_mode = $run_mode_setting;
		}

		switch ( $run_mode ) {
			case 'background':
				$totalPageOrder = ceil( $total_orders / self::$_LIMIT_ORDERS );

				$paramsCronjob = array(
					'params' => array(
						'lp_orders'        => array_values( $lp_orders ),
						'course_ids'       => $new_course_ids,
						'total_page_order' => $totalPageOrder,
						'p_order'          => 0,
						'limit'            => self::$_LIMIT_ORDERS,
					),
				);

				wp_schedule_single_event(
					current_time( 'timestamp' ),
					'hook_single_event_add_courses_to_lp_orders_when_save_level',
					$paramsCronjob
				);

				break;
			case 'normal':
			default:
				foreach ( $lp_orders as $lp_order ) {
					// Add courses to order
					$params = array(
						'lp_order_id' => $lp_order->order_id,
						'user_id'     => $lp_order->user_id,
						'total_page'  => 1,
					);

					$params_rs = $this->addItemsToLpOrder( $params, $new_course_ids );
				}
				break;
		}
	}

	/**
	 * Cron-job add courses to Lp orders when change courses on level
	 *
	 * @param array $params
	 */
	public function handleAddItemsToLpOrdersCronjobWhenCoursesLevelChange( $params = array() ) {
		if ( ! isset( $params['course_ids'] ) && ! isset( $params['level_course_ids'] ) ) {
			debugLogLpPms( 'handleAddItemsToLpOrdersCronjobWhenCoursesLevelChange: invalid params' );

			return;
		}

		$end              = $params['p_order'] * self::$_LIMIT_ORDERS + self::$_LIMIT_ORDERS;
		$i                = $params['p_order'];
		$lp_orders        = $params['lp_orders'];
		$level_id         = $params['level_id'];
		$level_course_ids = $params['level_course_ids'];

		// debugLogLpPms( $lp_orders );

		$lp_orders_limit = array_slice( $lp_orders, $i, $end );

		$this->update_courses_on_lp_orders_when_save_level( $lp_orders_limit, $level_course_ids );

		++ $params['p_order'];

		// debugLogLpPms($params);

		if ( $params['p_order'] < $params['total_page_order'] ) {

			// debugLogLpPms( 'Param to courses to orders ' . json_encode( $params_rs ) );

			$paramsCronjob = array(
				'params' => $params,
			);

			wp_schedule_single_event(
				current_time( 'timestamp' ),
				'hook_single_event_add_courses_to_lp_orders_when_save_level',
				$paramsCronjob
			);
		}
	}

	/**
	 * Cron-job: add courses to LP order when change courses on level
	 *
	 * @param array $params
	 */
	/*
	public function handleAddItemsToLpOrderCronjobWhenCoursesLevelChange( $params = array() ) {
		$end              = $params['p_course'] * LP_PMS_Order::$_LIMIT_COURSES + LP_PMS_Order::$_LIMIT_COURSES;
		$i                = $params['p_course'];
		$course_ids_limit = array();

		//debugLogLpPms( 'Courses ids ' . json_encode( $params['course_ids'] ) );

		for ( ; $i < $end; $i ++ ) {
			if ( isset( $params['course_ids'][ $i ] ) ) {
				$course_ids_limit[] = $params['course_ids'][ $i ];
			} else {
				break;
			}
		}

		//debugLogLpPms( 'Courses limit ' . json_encode( $course_ids_limit ) );

		$params_rs = $this->addItemsToLpOrder( $params, $course_ids_limit );

		if ( isset( $params_rs['code'] ) && $params_rs['code'] == 1 ) {
			++ $params_rs['p_course'];

			$paramsCronjob = array(
				'params' => $params_rs
			);

			if ( $params_rs['p_course'] < $params_rs['total_page_course'] ) {
				wp_schedule_single_event(  current_time('timestamp'), 'hook_single_event_add_courses_to_lp_order_when_save_level', $paramsCronjob );
			} else {
				++ $params_rs['p_order'];
				$params_rs['p_course'] = 0;

				if ( $params_rs['p_order'] < $params_rs['total_page_order'] ) {

					//debugLogLpPms( 'Param to courses to orders ' . json_encode( $params_rs ) );

					$paramsCronjob = array(
						'params' => $params_rs
					);

					wp_schedule_single_event(  current_time('timestamp'), 'hook_single_event_add_courses_to_lp_orders_when_save_level', $paramsCronjob );
				}

			}
		}
	}*/

	/**
	 * Admin update status PMS
	 *
	 * @param MemberOrder $pms_order
	 */
	public function pms_updated_order_will_add_lp_order( $pms_order ) {
		if ( ! isset( $pms_order->id ) || empty( $_REQUEST['save'] ) || ! current_user_can( 'pmpro_orders' ) ) {
			return;
		}

		$pmsOrder = LP_PMS_DB::getInstance()->getPmsOrderById( $pms_order->id );

		if ( is_object( $pmsOrder ) ) {
			if ( isset( $pms_order->user_id ) && isset( $pms_order->membership_id ) && isset( $pms_order->status ) ) {

				if ( $pmsOrder->status == $pms_order->status ) {
					return;
				}

				if ( $pms_order->status == 'success' || $pms_order->status == 'completed' ) {
					// Create LP order and add items
					$order_id = $this->create_lp_order( $pms_order->user_id, $pms_order->membership_id );
				} else {
					$this->update_lp_orders_when_change_membership_level(
						$pms_order->membership_id,
						$pms_order->user_id,
						$pms_order->membership_id
					);
				}
			}
		}
	}

	/**
	 * Admin create new order PMS
	 *
	 * @param MemberOrder $pms_order
	 */
	public function pms_added_order_will_add_lp_order( $pms_order ) {
		if ( empty( $_REQUEST['save'] ) || ! current_user_can( 'pmpro_orders' ) ) {
			return;
		}

		if ( $pms_order->status == 'success' || $pms_order->status == 'completed' ) {
			// Create LP order and add items
			$order_id = $this->create_lp_order( $pms_order->user_id, $pms_order->membership_id );
		}
	}

	/**
	 * Update list courses on Orders has level when save level
	 *
	 * @param array $lp_orders
	 * @param array $level_course_ids | get value from $_POST['_lp_pmpro_courses']
	 * @param int   $level_id
	 */
	public function process_update_courses_on_lp_orders_when_save_level(
		$lp_orders = array(),
		$level_course_ids = array(),
		$level_id = 0
	) {
		$run_mode_setting = LP()->settings()->get( 'pmpro_run_mode', 'auto' );
		$total_orders     = count( $lp_orders );

		if ( $run_mode_setting == 'auto' ) {
			if ( $total_orders > 10 && LP_Addon_Paid_Memberships_Pro_Preload::$_WP_CRON_STATUS ) {
				$run_mode = 'background';
			} else {
				$run_mode = 'normal';
			}
		} else {
			$run_mode = $run_mode_setting;
		}

		switch ( $run_mode ) {
			case 'background':
				$totalPageOrder = ceil( $total_orders / self::$_LIMIT_ORDERS );

				$paramsCronjob = array(
					'params' => array(
						'level_id'         => $level_id,
						'level_course_ids' => $level_course_ids,
						'lp_orders'        => array_values( $lp_orders ),
						'total_page_order' => $totalPageOrder,
						'p_order'          => 0,
						'limit'            => self::$_LIMIT_ORDERS,
					),
				);

				wp_schedule_single_event(
					current_time( 'timestamp' ),
					'hook_single_event_add_courses_to_lp_orders_when_save_level',
					$paramsCronjob
				);

				break;
			case 'normal':
			default:
				$this->update_courses_on_lp_orders_when_save_level( $lp_orders, $level_course_ids, $level_id );
				break;
		}
	}

	/**
	 * @param array $lp_orders
	 * @param array $level_course_ids
	 * @param int   $level_id
	 */
	public function update_courses_on_lp_orders_when_save_level(
		$lp_orders = array(),
		$level_course_ids = array(),
		$level_id = 0
	) {
		foreach ( $lp_orders as $lp_order ) {
			// Get course ids on Lp order
			$order_course_ids = LP_PMS_DB::getInstance()->getCourseIdsOnLpOrder( $lp_order->order_id );

			$order_course_ids = array_keys( $order_course_ids );

			$remove_course_ids = array_diff( $order_course_ids, $level_course_ids );
			$add_course_ids    = array_diff( $level_course_ids, $order_course_ids );

			// Delete courses on Order
			if ( count( $remove_course_ids ) > 0 ) {
				self::getInstance()->deleteCoursesOnOrder( $lp_order->order_id, $remove_course_ids );
			}

			// Add courses to Order
			if ( count( $add_course_ids ) > 0 ) {
				$params = array(
					'lp_order_id' => $lp_order->order_id,
					'user_id'     => $lp_order->user_id,
				);

				$param_results = self::getInstance()->addItemsToLpOrder( $params, $add_course_ids );
			}
		}
	}

	public static function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
}

LP_PMS_Order::getInstance();
