<?php
/**
 * LearnPress Fill In Blank Functions
 *
 * Define common functions for both front-end and back-end
 *
 * @author   ThimPress
 * @package  LearnPress/Fill-In-Blank/Functions
 * @version  3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'learn_press_fib_admin_view' ) ) {

	/**
	 * Get admin view file.
	 *
	 * @param        $view
	 * @param string $args
	 */
	function learn_press_fib_admin_view( $view, $args = '' ) {
		learn_press_admin_view( $view, wp_parse_args( $args, array( 'plugin_file' => LP_ADDON_FILL_IN_BLANK_FILE ) ) );
	}
}

if ( ! function_exists( 'learn_press_fib_get_template' ) ) {
	/**
	 * Get template.
	 *
	 * @param       $template_name
	 * @param array $args
	 */
	function learn_press_fib_get_template( $template_name, $args = array() ) {
		learn_press_get_template( $template_name, $args, learn_press_template_path() . '/addons/fill-in-blank/', LP_ADDON_FILL_IN_BLANK_PATH . '/templates/' );
	}
}

/**
 * Filter to admin editor of quiz/question to add new data.
 *
 * @param array $answers
 * @param int   $question_id
 * @param int   $quiz_id
 *
 * @return mixed
 */
function learn_press_fib_admin_editor_question_answers( $answers, $question_id, $quiz_id ) {

	if ( ! $question = learn_press_get_question( $question_id ) ) {
		return $answers;
	}

	if ( 'fill_in_blank' !== $question->get_type() ) {
		return $answers;
	}

	if ( $answers ) {
		foreach ( $answers as $k => $answer ) {
			$blanks                  = learn_press_get_question_answer_meta( $answer['question_answer_id'], '_blanks', true );
			$answers[ $k ]['blanks'] = $blanks ? array_values( $blanks ) : array();
		}
	}

	return $answers;
}

add_filter( 'learn-press/quiz-editor/question-answers-data', 'learn_press_fib_admin_editor_question_answers', 10, 3 );
add_filter( 'learn-press/question-editor/question-answers-data', 'learn_press_fib_admin_editor_question_answers', 10, 3 );

/**
 * Add new translating
 *
 * @param array $i18n
 *
 * @return mixed
 */
function learn_press_fib_admin_editor_i18n( $i18n ) {
	$i18n['confirm_remove_blanks'] = __( 'Are you sure to remove all blanks?', 'learnpress-fill-in-blank' );

	return $i18n;
}

add_filter( 'learn-press/question-editor/i18n', 'learn_press_fib_admin_editor_i18n' );
add_filter( 'learn-press/quiz-editor/i18n', 'learn_press_fib_admin_editor_i18n' );

/**
 * Backward compatibility. Will remove in learnpress 3.0.9
 */
function learn_press_fib_admin_editor_data_backward( $data ) {
	if ( current_filter() === 'learn-press/admin-localize-quiz-editor' ) {
		if ( ! empty( $data['listQuestions'] ) ) {
			if ( ! empty( $data['listQuestions']['questions'] ) ) {
				foreach ( $data['listQuestions']['questions'] as $k => $question ) {
					if ( $answers = $data['listQuestions']['questions'][ $k ]['answers'] ) {
						$data['listQuestions']['questions'][ $k ]['answers'] = learn_press_fib_admin_editor_question_answers( $answers, $question['id'], 0 );
					}
				}
			}
		}
	} elseif ( current_filter() === 'learn-press/question-editor/localize-script' ) {
		if ( $answers = $data['root']['answers'] ) {
			$data['root']['answers'] = learn_press_fib_admin_editor_question_answers( $answers, $data['root']['id'], 0 );
		}
	}
	$data['i18n'] = learn_press_fib_admin_editor_i18n( $data['i18n'] );

	return $data;
}

add_filter( 'learn-press/question-editor/localize-script', 'learn_press_fib_admin_editor_data_backward' );
add_filter( 'learn-press/admin-localize-quiz-editor', 'learn_press_fib_admin_editor_data_backward' );


