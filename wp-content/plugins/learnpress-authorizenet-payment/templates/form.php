<?php
/**
 * Template for displaying Authorize.Net payment form.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/authorizenet-payment/form.php.
 *
 * @author   ThimPress
 * @package  Learnpress-Authorizenet/Templates
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit();
?>

<div id="learn-press-authorizenet-payment-form">
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label for="" class="control-label"><?php esc_html_e( 'Credit card type', 'learnpress-authorizenet-payment' ); ?>
					<span style="color:#ff0000;">*</span>
				</label>
				<div class="controls" style="margin-left:5px;">
					<select id="learn-press-authorizenet-payment-activated" name="learn-press-authorizenet-payment[activated]" disabled="disabled">
						<option value="Visa"><?php esc_html_e( 'Visa', 'learnpress-authorizenet-payment' ); ?></option>
						<option value="Mastercard"><?php esc_html_e( 'Mastercard', 'learnpress-authorizenet-payment' ); ?></option>
						<option value="AmericanExpress"><?php esc_html_e( 'American express', 'learnpress-authorizenet-payment' ); ?></option>
						<option value="Discover"><?php esc_html_e( 'Discover', 'learnpress-authorizenet-payment' ); ?></option>
						<option value="DinersClub"><?php esc_html_e( 'Diners club', 'learnpress-authorizenet-payment' ); ?></option>
						<option value="JCB"><?php esc_html_e( 'Aut jcb', 'learnpress-authorizenet-payment' ); ?></option>
					</select>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label for="cardexp" class="control-label">
					<?php esc_html_e( 'Expiration date (MM/YY)', 'learnpress-authorizenet-payment' ); ?>
					<span style="color:#ff0000;">*</span>
				</label>
				<div class="controls" style="margin-left:5px;">
					<select id="learn-press-authorizenet-payment-expmonth" name="learn-press-authorizenet-payment[expmonth]" class="inputbox required" tabindex="2" disabled="disabled">
						<option value=""><?php esc_html_e( 'Month', 'learnpress-authorizenet-payment' ); ?></option>
						<option value="01"><?php esc_html_e( 'January', 'learnpress-authorizenet-payment' ); ?> (01)</option>
						<option value="02"><?php esc_html_e( 'February', 'learnpress-authorizenet-payment' ); ?> (02)</option>
						<option value="03"><?php esc_html_e( 'March', 'learnpress-authorizenet-payment' ); ?> (03)</option>
						<option value="04"><?php esc_html_e( 'April', 'learnpress-authorizenet-payment' ); ?> (04)</option>
						<option value="05"><?php esc_html_e( 'May', 'learnpress-authorizenet-payment' ); ?> (05)</option>
						<option value="06"><?php esc_html_e( 'June', 'learnpress-authorizenet-payment' ); ?> (06)</option>
						<option value="07"><?php esc_html_e( 'July', 'learnpress-authorizenet-payment' ); ?> (07)</option>
						<option value="08"><?php esc_html_e( 'August', 'learnpress-authorizenet-payment' ); ?> (08)</option>
						<option value="09"><?php esc_html_e( 'September', 'learnpress-authorizenet-payment' ); ?> (09)</option>
						<option value="10"><?php esc_html_e( 'October', 'learnpress-authorizenet-payment' ); ?> (10)</option>
						<option value="11"><?php esc_html_e( 'November', 'learnpress-authorizenet-payment' ); ?> (11)</option>
						<option value="12"><?php esc_html_e( 'December', 'learnpress-authorizenet-payment' ); ?> (12)</option>
					</select>&nbsp;
					<select id="learn-press-authorizenet-payment-expyear" name="learn-press-authorizenet-payment[expyear]" style="width:100px;" class="inputbox required" tabindex="3" disabled="disabled">
						<option value=""><?php esc_html_e( 'Year', 'learnpress-authorizenet-payment' ); ?></option>
						<?php
						$expyear = gmdate( 'Y' );
						for ( $i = gmdate( 'Y' ); $i < ( gmdate( 'Y' ) + 10 ); $i ++ ) :
							?>
							<option value="<?php esc_attr_e( $i ); ?>" <?php echo ( $expyear == $i ? 'selected' : '' ); ?>><?php esc_html_e( $i ); ?></option>
							<?php
						endfor;
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<label for="cardnum" class="control-label">
					<?php esc_html_e( 'Card number', 'learnpress-authorizenet-payment' ); ?>
					<span style="color:#ff0000;">*</span>
				</label>
				<div class="controls" style="margin-left:5px;">
					<input class="inputbox required" id="learn-press-authorizenet-payment-cardnum" type="text" name="learn-press-authorizenet-payment[cardnum]" tabindex="4" size="35" value="" disabled="disabled"/>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group">
				<label for="cardcvv" class="control-label">
					<?php esc_html_e( 'Card CVV number', 'learnpress-authorizenet-payment' ); ?>
					<span style="color:#ff0000;">*</span>
				</label>
				<div class="controls" style="margin-left:5px;">
					<input class="inputbox required" id="learn-press-authorizenet-payment-cardcvv" type="text" name="learn-press-authorizenet-payment[cardcvv]" tabindex="5" maxlength="5" size="10" style="width:100px;" value="" disabled="disabled"/>
				</div>
			</div>
		</div>
	</div>
</div>
