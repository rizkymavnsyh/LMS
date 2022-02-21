<?php
defined( 'ABSPATH' ) || exit;
class LearnPress_PMPro_Admin {

	public static $instance = null;

	public static function getInstance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'pmpro_membership_level_after_other_settings', array( $this, 'pmpro_membership_level_after_other_settings' ) );
		add_action( 'pmpro_save_membership_level', array( $this, 'pmpro_save_membership_level' ), 10, 1 );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_ajax_learn_press_pmpro_search_courses_action', array( $this, 'ajax_search_courses' ) );

	}


	/**
	 * Add script
	 */
	public function admin_enqueue_scripts() {
		wp_register_style( 'lp_pmpro_admin_select2', LP_ADDON_PMPRO_URL . 'assets/css/select2.min.css' );
		wp_register_script( 'lp_pmpro_admin_select2', LP_ADDON_PMPRO_URL . 'assets/js/select2.min.js', array( 'jquery' ) );
		wp_enqueue_style( 'lp_pmpro_admin_select2' );
		wp_enqueue_script( 'lp_pmpro_admin_select2' );
	}


	/**
	 * Save added/removed course to membership level
	 * Update orders of users not expire
	 *
	 * @param int $level_id
	 *
	 * @editor: tungnx
	 */
	public function pmpro_save_membership_level( $level_id = 0 ) {
		$level_course_ids = ! empty( $_POST['_lp_pmpro_courses'] ) ? $_POST['_lp_pmpro_courses'] : array();

		/***** Save courses on level */
		$courses        = LP_PMS_DB::getInstance()->getCoursesOnLevel( $level_id );
		$old_course_ids = array_keys( $courses );
		$del_course_ids = array_diff( $old_course_ids, $level_course_ids );
		$new_course_ids = array_diff( $level_course_ids, $old_course_ids );

		// Delete level on course meta
		foreach ( $del_course_ids as $course_id ) {
			delete_post_meta( $course_id, '_lp_pmpro_levels', $level_id );
		}

		// Add level on course meta
		foreach ( $new_course_ids as $course_id ) {
			add_post_meta( $course_id, '_lp_pmpro_levels', $level_id, false );
		}
		/***** End check update courses on level */

		/***** Update orders */
		$auto_update_courses_on_level = LP()->settings()->get( 'pmpro_update_access_course', 'yes' );

		if ( $auto_update_courses_on_level != 'yes' ) {
			return;
		}

		$lp_orders = LP_PMS_DB::getInstance()->getLastOrderOfUsersHasLevel( $level_id );

		if ( is_array( $lp_orders ) && count( $lp_orders ) > 0 ) {
			LP_PMS_Order::getInstance()->process_update_courses_on_lp_orders_when_save_level( $lp_orders, $level_course_ids, $level_id );
		}
		/***** End update orders */
	}


	/**
	 * Search Courses
	 *
	 * @global type $wpdb
	 */
	function ajax_search_courses() {
		global $wpdb; // this is how you get access to the database
		$page = isset( $_POST['page'] ) ? $_POST['page'] : 1;

		$q          = isset( $_POST['q'] ) ? $_POST['q'] : '';
		$sql_search = $q ? "\n" . ' AND p.post_title LIKE "%' . sanitize_text_field( $q ) . '%"' : '';

		$ex     = isset( $_POST['ex'] ) ? $_POST['ex'] : array();
		$sql_ex = '';
		if ( is_array( $ex ) && ! empty( $ex ) ) {
			$sql_ex = "\n" . ' AND p.ID NOT IN(' . implode( ',', $ex ) . ') ';
		}

		$limit       = isset( $_POST['limit'] ) ? $_POST['limit'] : 30;
		$limit_start = ( $page - 1 ) * $limit;
		$sql_limit   = "\n" . ' LIMIT ' . ( ( $limit_start ) ? $limit_start . ', ' : '' ) . $limit;

		$sql_select = 'SELECT p.id, p.post_title as "name", p.* ';
		$sql_count  = 'SELECT count(*) ';
		$sql_from   = '
			FROM
				' . $wpdb->posts . ' AS p
			WHERE
				1 = 1 ' . $sql_search . $sql_ex . '
				AND p.post_type = "lp_course"
				AND ((p.post_status = "publish"))
			ORDER BY p.post_date DESC
			' . $sql_limit;

		$total_count = $wpdb->get_results( $sql_count . $sql_from );
		$items       = $wpdb->get_results( $sql_select . $sql_from );

		$data = array(
			'items'       => $items,
			'page'        => $page,
			'total_count' => $total_count,
		);

		wp_send_json( $data );
	}


	/**
	 * Add courses selelct box in to membership level edit pages
	 */
	public function pmpro_membership_level_after_other_settings() {
		// require template file
		require_once __DIR__ . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'edit.php';
	}

}
LearnPress_PMPro_Admin::getInstance();
