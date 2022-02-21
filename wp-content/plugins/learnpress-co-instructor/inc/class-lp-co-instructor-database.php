<?php
/**
 * Class LP_CO_Instructor_DB
 *
 * @since 3.0.8
 * @version 1.0.1
 * @author tungnx
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class LP_CO_Instructor_DB extends LP_Database {
	public static $_instance;

	protected function __construct() {
		parent::__construct();
	}

	public static function getInstance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Get list course of instructor and co-instructor
	 *
	 * @param int $user_id
	 *
	 * @return array
	 */
	public function get_post_of_instructor( int $user_id = 0 ): array {
		$query = $this->wpdb->prepare(
			"SELECT DISTINCT p.ID FROM $this->tb_posts AS p
	                INNER JOIN $this->tb_postmeta AS pm ON p.ID = pm.post_id
	                WHERE ( p.post_author = %d AND p.post_type = %s  )
		            OR ( ( pm.meta_key = %s AND pm.meta_value= %d
		            AND p.post_type = %s ))",
			$user_id,
			LP_COURSE_CPT,
			'_lp_co_teacher',
			$user_id,
			LP_COURSE_CPT
		);

		$result = $this->wpdb->get_col( $query );

		return $result;
	}

	/**
	 * Get count list course of instructor or co-instructor
	 *
	 * @param int $user_id
	 *
	 * @return array
	 * @since 3.0.9
	 */
	public function get_count_post_of_instructor( $user_id = 0 ) {
		$query = $this->wpdb->prepare(
			'
				SELECT M.post_status, count(M.post_status) as num_posts
				FROM (SELECT post_status
				      FROM wp_posts AS p
				               INNER JOIN wp_postmeta AS pm ON p.ID = pm.post_id
				      WHERE (p.post_author = %d AND p.post_type = %s) OR
				          (pm.meta_key = %s AND pm.meta_value = %d AND p.post_type = %s)
				      GROUP BY p.ID) as M
				GROUP BY M.post_status
		        ',
			$user_id,
			LP_COURSE_CPT,
			'_lp_co_teacher',
			$user_id,
			LP_COURSE_CPT
		);

		$result = $this->wpdb->get_results( $query, ARRAY_A );

		return $result;
	}
}

LP_CO_Instructor_DB::getInstance();

