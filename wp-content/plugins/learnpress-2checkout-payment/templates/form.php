<?php
/**
 * Template for displaying 2Checkout payment form.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/2checkout-payment/form.php.
 *
 * @author   ThimPress
 * @package  Learnpress-2Checkout/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$settings  = LP()->settings->get( 'learn_press_2checkout' );
$items     = $order->get_items();
$total     = $order->order_total;
$item_name = apply_filters( 'learn_press_2checkout_item_name', $order->id );
$sitename  = get_bloginfo( 'name', 'display' );
if ( $item_name == $order->id ) {
	$item_name = sprintf( __( 'Order %s on', 'learnpress-2checkout-payment' ), $order->order_key, $sitename );
}
$current_user = wp_get_current_user();

$action = 'https://2checkout.com/checkout/purchase';
if ( $settings['test_mode'] == 'yes' ) {
	$action = 'https://sandbox.2checkout.com/checkout/purchase';
}
$url               = get_site_url() . '/?' . learn_press_get_web_hook( '2checkout' ) . '=1';
$merchant_order_id = $order->id . '-' . $order->order_key;
$currency          = learn_press_get_currency();
?>

    <html>
    <head>
        <script>
            function onload_2checkout() {
                document.checkout_payment_form.submit();
            }
        </script>
    </head>
    <body onload="onload_2checkout();">
    <div>
        <form name="checkout_payment_form" id="learn-press-2checkout-payment-form"
              action='<?php esc_attr_e( $action ); ?>' method='post'>
            <input type='hidden' name='sid' value='<?php esc_attr_e( $settings['sid'] ); ?>'>
            <input type='hidden' name='mode' value='2CO'>

            <input type='hidden' name='li_0_type' value='product'>
            <input type='hidden' name='li_0_name' value='<?php esc_attr_e( $item_name ); ?>'>
            <input type='hidden' name='li_0_product_id' value='<?php esc_attr_e( $merchant_order_id ); ?>'>
            <input type='hidden' name='li_0__description' value=''>
            <input type='hidden' name='li_0_price' value='<?php echo esc_attr( $total ) ?>'>
            <input type='hidden' name='li_0_quantity' value='1'>
            <input type='hidden' name='li_0_tangible' value='N'>

            <input type='hidden' name='card_holder_name' value='<?php echo esc_attr( $current_user->display_name ); ?>'>
            <input type='hidden' name='merchant_order_id' value='<?php echo esc_attr( $merchant_order_id ); ?>'>
            <input type='hidden' name='x_receipt_link_url' value='<?php echo esc_attr( $return_url ); ?>'>
            <input type='hidden' name='currency_code' value='<?php echo esc_attr( $currency ); ?>'>
        </form>
    </div>
    </body>
    </html>
<?php exit(); ?>