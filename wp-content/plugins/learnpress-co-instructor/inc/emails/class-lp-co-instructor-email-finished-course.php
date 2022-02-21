<?php
/**
 * LP_Email_Finished_Course for Co-instructor Class.
 *
 * @author   ThimPress
 * @package  LearnPress/Co-Instructor/Classes
 * @version  3.0.1
 * @editor tungnx
 * @modify 4.0.1
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Email_Type_Finished_Course' ) ) {
	return;
}

if ( ! class_exists( 'LP_Email_Finished_Course_Co_Instructor' ) ) {
	class LP_Email_Finished_Course_Co_Instructor extends LP_Email_Type_Finished_Course {

		/**
		 * LP_Email_Finished_Course_Co_Instructor constructor.
		 */
		public function __construct() {
			$this->id          = 'finished-course-co-instructor';
			$this->title       = __( 'Co-Instructor', 'learnpress-co-instructor' );
			$this->description = __( 'Send this email to co-instructor of course when a user finished the course', 'learnpress-co-instructor' );

			$this->template_html  = 'emails/finished-course-instructor.php';
			$this->template_plain = 'emails/plain/finished-course-instructor.php';

			$this->default_subject = __( '{{user_display_name}} has finished course', 'learnpress-co-instructor' );
			$this->default_heading = __( 'Finished course', 'learnpress-co-instructor' );

			parent::__construct();
		}

		/**
		 * Trigger email.
		 * Receive 3 params: $course_id, $user_id, $user_item_id
		 *
		 * @param array $params
		 * @throws Exception
		 * @since 4.1.1
		 * @author tungnx
		 */
		public function handle( array $params ) {
			if ( ! $this->check_and_set( $params ) ) {
				return;
			}

			$this->set_data_content();
			$co_instructor_ids = get_post_meta( $this->course_id, '_lp_co_teacher' );

			foreach ( $co_instructor_ids as $co_instructor_id ) {
				$co_instructor = learn_press_get_user( $co_instructor_id );
				$this->set_receive( $co_instructor->get_email() );
				$this->send_email();
			}
		}
	}

	return new LP_Email_Finished_Course_Co_Instructor();
}
