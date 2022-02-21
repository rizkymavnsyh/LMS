<?php
/**
 * Template for displaying answer of fill-in-blank question.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/fill-in-blank/content-question/answer.php.
 *
 * @author   ThimPress
 * @package  LearnPress/Fill-In-Blank/Templates
 * @version  3.0.1
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

isset( $question ) or die( __( 'Invalid question!', 'learnpress-fill-in-blank' ) );

$quiz = LP_Global::course_item_quiz();

if ( ! $answers = $question->get_answers() ) {
	return;
}

$question->setup_data( $quiz->get_id() );
?>

<div class="question-type-fill_in_blank">
    <div class="question-options-<?php echo $question->get_id(); ?> question-passage">
		<?php foreach ( $answers as $k => $answer ) {
			echo $answer->get_title( 'display' );
			do_action( 'learn_press_after_question_answer_text', $answer, $question );
		} ?>
    </div>
</div>
