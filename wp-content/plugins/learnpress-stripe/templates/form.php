<?php
/**
 * Template for displaying Stripe payment form.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/stripe-payment/form.php.
 *
 * @author   ThimPress
 * @package  LearnPress/Stripe/Templates
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit();
?>

<?php $settings = LP()->settings(); ?>

<p><?php echo $this->get_description(); ?></p>

<div id="learn-press-stripe-form">
	<p class="learn-press-form-row">
		<label><?php echo wp_kses( __( 'Card Number <span class="required">*</span>', 'learnpress-stripe' ), array( 'span' => array() ) ); ?></label>
		<input type="text" name="learn-press-stripe[card_number]" id="learn-press-stripe-payment-card-number" maxlength="19" value="" autocomplete="cc-number" placeholder="•••• •••• •••• ••••"/>
	</p>

	<p class="learn-press-form-row">
		<label><?php echo wp_kses( __( 'Expiry (MM/YY) <span class="required">*</span>', 'learnpress-stripe' ), array( 'span' => array() ) ); ?></label>
		<select class="learn-press-stripe-expiry" name="learn-press-stripe[expiry_month]">
			<option value=01>01</option>
			<option value=02>02</option>
			<option value=03>03</option>
			<option value=04>04</option>
			<option value=05>05</option>
			<option value=06>06</option>
			<option value=07>07</option>
			<option value=08>08</option>
			<option value=09>09</option>
			<option value=10>10</option>
			<option value=11>11</option>
			<option value=12>12</option>
		</select>

		<select class="learn-press-stripe-expiry" name="learn-press-stripe[expiry_year]">
			<?php for ( $a = (int) gmdate( 'Y', time() ), $b = $a + 10, $i = $a; $i < $b; $i ++ ) { ?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php } ?>
		</select>
	</p>
	<p class="learn-press-form-row">
		<label><?php echo wp_kses( __( 'Card Code <span class="required">*</span>', 'learnpress-stripe' ), array( 'span' => array() ) ); ?></label>
		<input type="text" name="learn-press-stripe[card_code]" id="learn-press-stripe-payment-card-code" value="" placeholder="•••"/>
	</p>
</div>

<?php if ( $settings->get( 'stripe.test_mode' ) == 'yes' ) { ?>
	<?php learn_press_display_message( esc_html__( 'Test mode is enabled. You can use the card number 4242424242424242 with any CVC and a valid expiration date for testing purpose.', 'learnpress-stripe' ), 'error' ); ?>
<?php } ?>
