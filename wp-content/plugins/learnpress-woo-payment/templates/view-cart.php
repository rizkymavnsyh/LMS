<?php
/**
 * Template button view cart woo
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 2.3
 */

defined( 'ABSPATH' ) || exit();

if ( ! isset( $course ) ) {
	return;
}
?>

<a class="btn-lp-course-view-cart" href="<?php echo esc_attr( wc_get_cart_url() ); ?>">
	<span class="lp-button"><?php _e( 'View cart', 'learnpress-woo-payment' ); ?></span>
</a>


