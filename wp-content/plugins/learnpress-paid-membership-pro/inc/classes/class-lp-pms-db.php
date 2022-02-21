<?php
/**
 * Class LP_PMS_DB
 *
 * @desription query database
 *
 * @version    1.0.0
 * @since      3.1.10
 * @author     tungnx
 */

class LP_PMS_DB {
	public static $_instance;
	public $wpdb;
	public $tb_lp_user_items;
	public $tb_lp_user_itemmeta;
	public $tb_lp_order_items;
	public $tb_postmeta;
	public $tb_posts;

	private function __construct() {
		/**
		 * @global wpdb
		 */
		global $wpdb;

		$this->wpdb                 = $wpdb;
		$this->tb_posts             = $this->wpdb->posts;
		$this->tb_postmeta          = $this->wpdb->postmeta;
		$this->tb_lp_user_items     = $this->wpdb->prefix . 'learnpress_user_items';
		$this->tb_lp_user_itemmeta  = $this->wpdb->prefix . 'learnpress_user_itemmeta';
		$this->tb_lp_order_items    = $this->wpdb->prefix . 'learnpress_order_items';
		$this->tb_lp_order_itemmeta = $this->wpdb->prefix . 'learnpress_order_itemmeta';
	}

	public static function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Get courses by MemberShip level
	 *
	 * @param int   $level_id
	 * @param int   $p
	 * @param array $cols # name columns want to get
	 * @param int   $limit
	 *
	 * @return array|object|null
	 * @since  3.1.10
	 * @author tungnx
	 */
	public function getCoursesByLevel( $level_id = 0, $p = 0, $limit = 0, $cols = array( 'ID', 'post_title' ) ) {
		$offset = $p * $limit;

		$nameCols = '';
		foreach ( $cols as $col ) {
			if ( empty( $nameCols ) ) {
				$nameCols = 'p.' . $col;
			} else {
				$nameCols .= ', p.' . $col;
			}
		}

		$sql = $this->wpdb->prepare(
			"SELECT $nameCols
					FROM $this->tb_posts AS p
					INNER JOIN $this->tb_postmeta AS pm
					ON p.ID = pm.post_id
					WHERE pm.meta_key = %s
					AND pm.meta_value = %s
					AND p.post_type = %s
					AND p.post_status = 'publish'
					ORDER BY p.post_date DESC
					LIMIT %d, %d",
			LP_PMS_Order::$_key_lp_pmpro_levels,
			$level_id,
			LP_COURSE_CPT,
			$offset,
			$limit
		);

		// var_dump( $sql );

		$rows = $this->wpdb->get_results( $sql, OBJECT_K );

		return $rows;
	}

	/**
	 * Get last order of user is membership
	 *
	 * @param int $user_id
	 * @param int $membership_id
	 *
	 * @return array|object|void|null
	 */
	public function getLastOrderMembershipOfUser( $user_id = 0, $membership_id = 0 ) {
		$query = $this->wpdb->prepare(
			"SELECT p_meta.post_id FROM $this->tb_postmeta as p_meta
					WHERE p_meta.meta_key = '_user_id'
					AND p_meta.meta_value = %d
					AND p_meta.post_id IN
					(SELECT p_meta.post_id
						FROM $this->tb_postmeta as p_meta
						WHERE p_meta.meta_key = '_lp_pmpro_level'
						AND p_meta.meta_value = %d)
						ORDER BY p_meta.post_id DESC
					LIMIT %d",
			$user_id,
			$membership_id,
			1
		);

		$result = $this->wpdb->get_row( $query );

		return $result;
	}

	/**
	 * Update status courses of Order in table learnpress_user_items
	 * Find courses by user and order then update status
	 *
	 * @param int    $user_id
	 * @param int    $order_id
	 * @param string $status
	 *
	 * @return bool|int
	 */
	public function updateStatusCoursesByOrderAndUser( $user_id = 0, $order_id = 0, $status = '' ) {
		$query = $this->wpdb->prepare(
			"UPdate $this->tb_lp_user_items as u_items
					SET u_items.status = %s
					WHERE user_id = %d
					AND u_items.ref_id = %d
					AND u_items.ref_type = %s;",
			$status,
			$user_id,
			$order_id,
			LP_ORDER_CPT
		);

		$result = $this->wpdb->query( $query );

		return $result;
	}

	/**
	 * @param int $user_id
	 *
	 * @return array|object|void|null
	 */
	public function checkStatusMembershipLevelLast( $user_id = 0 ) {
		$tb_pmpro_memberships_users = $this->wpdb->pmpro_memberships_users;

		$sql = $this->wpdb->prepare(
			"SELECT `status`, `membership_id`
				FROM $tb_pmpro_memberships_users
				WHERE user_id = %d
				ORDER BY id DESC
				LIMIT 0, 1",
			$user_id
		);

		$result = $this->wpdb->get_row( $sql );

		return $result;
	}

	/**
	 * Get last order of users status is completed
	 *
	 * @param int $level_id
	 *
	 * @return array|object|null
	 */
	public function getLastOrderOfUsersHasLevel( $level_id = 0 ) {

		$sql = $this->wpdb->prepare(
			"SELECT pmeta.meta_value as user_id, ID as order_id
					FROM $this->tb_posts
					INNER JOIN $this->tb_postmeta pmeta
    					ON ID = pmeta.post_id
    				WHERE post_status = 'lp-completed'
						AND ID in
						  (Select DISTINCT post_id
						   FROM $this->tb_postmeta
						   WHERE meta_key = %s
							AND meta_value = %d)
					AND pmeta.meta_key = '_user_id'
					GROUP BY ID DESC",
			LP_PMS_Order::$_key_lp_pmpro_level,
			$level_id
		);

		$result = $this->wpdb->get_results( $sql, OBJECT_K ); // key array is user_id

		return $result;
	}

	/**
	 * Get user item ids
	 *
	 * @param array $order_ids  | data example: array(1, 2, 3)
	 * @param array $course_ids | data example: array(1, 2, 3)
	 *
	 * @return array|object|null
	 */
	public function getUserItemIds( $order_ids = array(), $course_ids = array() ) {
		$order_ids_str  = implode( "','", $order_ids );
		$course_ids_str = implode( "','", $course_ids );

		$sql = $this->wpdb->prepare(
			"SELECT user_item_id FROM $this->tb_lp_user_items
					WHERE ref_id IN (%s)
					AND ref_type = 'lp_order'
					AND item_id IN (%s)
					AND item_type = 'lp_course'",
			$order_ids_str,
			$course_ids_str
		);

		$sql = str_replace( '\\', '', $sql );

		$result = $this->wpdb->get_results( $sql, OBJECT_K );

		return $result;
	}

	/**
	 * Get order item ids
	 *
	 * @param array $order_ids  | data example: array(1, 2, 3)
	 * @param array $course_ids | data example: array(1, 2, 3)
	 *
	 * @return array|object|null
	 */
	public function getOrderItemIds( $order_ids = array(), $course_ids = array() ) {
		$order_ids_str  = implode( "','", $order_ids );
		$course_ids_str = implode( "','", $course_ids );

		$sql = $this->wpdb->prepare(
			"SELECT order_item_id
					FROM $this->tb_lp_order_items
					WHERE order_item_id IN
						(SELECT learnpress_order_item_id
						FROM $this->tb_lp_order_itemmeta
						WHERE meta_value IN (%s)
						AND meta_key = '_course_id')
					AND order_id IN (%s)",
			$course_ids_str,
			$order_ids_str
		);

		$sql = str_replace( '\\', '', $sql );

		$result = $this->wpdb->get_results( $sql, OBJECT_K );

		return $result;
	}

	/**
	 * Delete user item meta
	 *
	 * @param array $user_item_ids | data example: array(1, 2, 3)
	 *
	 * @return bool|int
	 */
	public function deleteUserItemmeta( $user_item_ids = array() ) {
		$user_item_ids_str = implode( "','", $user_item_ids );

		if ( empty( $user_item_ids_str ) ) {
			return false;
		}

		$sql = $this->wpdb->prepare(
			"DELETE FROM $this->tb_lp_user_itemmeta
				WHERE learnpress_user_item_id IN (%s)",
			$user_item_ids_str
		);

		$sql = str_replace( '\\', '', $sql );

		$result = $this->wpdb->query( $sql );

		return $result;
	}

	/**
	 * @param array $user_item_ids | data example: array(1, 2, 3)
	 *
	 * @return bool|int
	 */
	public function deleteUserItems( $user_item_ids = array() ) {
		$user_item_ids_str = implode( "','", $user_item_ids );

		if ( empty( $user_item_ids_str ) ) {
			return false;
		}

		$sql = $this->wpdb->prepare(
			"DELETE FROM $this->tb_lp_user_items
				WHERE user_item_id IN (%s)",
			$user_item_ids_str
		);

		$sql = str_replace( '\\', '', $sql );

		$result = $this->wpdb->query( $sql );

		return $result;
	}

	/**
	 * Delete order item meta
	 *
	 * @param array $order_item_ids | data example: array(1, 2, 3)
	 *
	 * @return bool|int
	 */
	public function deleteOrderItemmeta( $order_item_ids = array() ) {
		$order_item_ids_str = implode( "','", $order_item_ids );

		if ( empty( $order_item_ids_str ) ) {
			return false;
		}

		$sql = $this->wpdb->prepare(
			"DELETE FROM $this->tb_lp_order_itemmeta
				WHERE learnpress_order_item_id IN (%s)",
			$order_item_ids_str
		);

		$sql = str_replace( '\\', '', $sql );

		$result = $this->wpdb->query( $sql );

		return $result;
	}

	/**
	 * Delete order items
	 *
	 * @param array $order_item_ids | data example: array(1, 2, 3)
	 *
	 * @return bool|int
	 */
	public function deleteOrderItems( $order_item_ids = array() ) {
		$order_item_ids_str = implode( "','", $order_item_ids );

		if ( empty( $order_item_ids_str ) ) {
			return false;
		}

		$sql = $this->wpdb->prepare(
			"DELETE FROM $this->tb_lp_order_items
				WHERE order_item_id IN (%s)",
			$order_item_ids_str
		);

		$sql = str_replace( '\\', '', $sql );

		$result = $this->wpdb->query( $sql );

		return $result;
	}

	/**
	 * @param int $id
	 *
	 * @return bool|int
	 */
	public function getPmsOrderById( $id = 0 ) {
		$tb_pms_order = $this->wpdb->pmpro_membership_orders;

		$sql = $this->wpdb->prepare(
			"SELECT * FROM $tb_pms_order
					WHERE id = %d",
			$id
		);

		$result = $this->wpdb->get_row( $sql );

		return $result;
	}

	/**
	 * Get course ids on LP order
	 *
	 * @param int $lp_order_id
	 *
	 * @return array|object|null
	 */
	public function getCourseIdsOnLpOrder( $lp_order_id = 0 ) {
		$sql = $this->wpdb->prepare(
			"SELECT meta_value
					FROM $this->tb_lp_order_itemmeta
					WHERE learnpress_order_item_id IN (
						SELECT order_item_id
						FROM $this->tb_lp_order_items
						WHERE order_id = %d
					)
					AND meta_key = '_course_id'",
			$lp_order_id
		);

		$result = $this->wpdb->get_results( $sql, OBJECT_K );

		return $result;
	}

	/**
	 * Get list courses on level
	 *
	 * @param int $level_id
	 *
	 * @return array|object|null
	 */
	public function getCoursesOnLevel( $level_id = 0 ) {
		$sql = $this->wpdb->prepare(
			"SELECT p.ID, CONCAT(p.ID,' - ', p.post_title) AS `title`
					FROM $this->tb_posts AS p
						INNER JOIN $this->tb_postmeta AS pm ON p.ID = pm.post_id
					WHERE pm.meta_key = '_lp_pmpro_levels'
						AND pm.meta_value = %d
						AND p.post_type = 'lp_course'
						AND p.post_status = 'publish'
					GROUP BY p.ID
					ORDER BY p.post_date DESC",
			$level_id
		);

		$result = $this->wpdb->get_results( $sql, OBJECT_K );

		return $result;
	}
}

LP_PMS_DB::getInstance();
