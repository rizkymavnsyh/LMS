<?php
/**
 * LP_Email_Enrolled_Course for Co-instructor Class.
 *
 * @author   ThimPress
 * @package  LearnPress/Co-Instructor/Classes
 * @version  3.0.1
 * @editor tungnx
 * @modify 4.0.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Email_Type_Enrolled_Course' ) ) {
	return;
}

if ( ! class_exists( 'LP_Email_Enrolled_Course_Co_Instructor' ) ) {
	class LP_Email_Enrolled_Course_Co_Instructor extends LP_Email_Type_Enrolled_Course {

		/**
		 * LP_Email_Enrolled_Course_Instructor constructor.
		 */
		public function __construct() {
			$this->id          = 'enrolled-course-co-instructor';
			$this->title       = __( 'Co-instructor', 'learnpress-co-instructor' );
			$this->description = __( 'Send this email to co-instructor when they have enrolled course.', 'learnpress-co-instructor' );

			$this->template_html  = 'emails/enrolled-course-instructor.php';
			$this->template_plain = 'emails/plain/enrolled-course-instructor.php';

			$this->default_subject = __( '{{user_display_name}} has enrolled course', 'learnpress-co-instructor' );
			$this->default_heading = __( 'Enrolled course', 'learnpress-co-instructor' );

			parent::__construct();
		}

		/**
		 * Hanle send email
		 *
		 * @param array $params
		 */
		public function handle( array $params ) {
			if ( ! $this->check_and_set( $params ) ) {
				return;
			}

			$this->set_data_content();

			$co_instructor_ids = get_post_meta( $this->_course->get_id(), '_lp_co_teacher' );

			foreach ( $co_instructor_ids as $co_instructor_id ) {
				$co_instructor = learn_press_get_user( $co_instructor_id );
				$this->set_receive( $co_instructor->get_email() );
				$this->send_email();
			}
		}


	}

	return new LP_Email_Enrolled_Course_Co_Instructor();
}
