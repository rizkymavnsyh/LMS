<?php
/**
 * Template for display a placeholder blank
 *
 * @author  ThimPress
 * @package LearnPress/FIB/Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) or die();

$user = LP_Global::user();
$quiz = LP_Global::course_item_quiz();

$class = array( 'blank' );
if('yes' === $question->show_correct_answers()){
	if ( $blank['correct'] ) {
		$class[] = 'correct';
	} else {
		$class[] = 'wrong';
	}
}
if ( ! empty( $blank['comparison'] ) ) {
	$class[] = 'blank-type-' . $blank['comparison'];
}
?>
<div class="fib-blank<?php echo( ! empty( $class ) ? ' ' . join( ' ', $class ) : '' ) ?>"
     data-index="<?php echo $blank['index']; ?>">
	<?php if ( $user->has_completed_quiz( $quiz->get_id() ) || $user->has_checked_question( $question->get_id(), $quiz->get_id() ) ) { ?>

        <span class="blank-fill"><?php echo esc_html( $blank['user_fill'] ); ?></span>

	<?php } else { ?>

        <input type="text" name="learn-press-question-<?php echo $question->get_id(); ?>[<?php echo $blank['id']; ?>]"
               value="<?php echo esc_attr( $blank['user_fill'] ); ?>"
               class="answer-options"/>

	<?php } ?>

	<?php if ( 'yes' === $question->show_correct_answers() ) { ?>
        <span class="blank-status">(<?php echo $blank['fill']; ?>)</span>
	<?php } ?>
</div>