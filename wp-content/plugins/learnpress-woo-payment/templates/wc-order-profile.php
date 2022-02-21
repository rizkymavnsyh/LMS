<?php
if ( empty( $customer_orders ) ) {
	learn_press_display_message( __( 'No orders!', 'learnpress-woo-paymen' ) );
	return;
}

if ( ! isset( $output_format_text ) || ! isset( $total_pages ) || ! isset( $paged ) ) {
	return;
}

?>

<div>
	<h3 class="profile-heading" style="margin-bottom:30px"><?php esc_html_e( 'Orders Woocommerce', 'learnpress-woo-payment' ); ?></h3>
	<table class="lp-list-table profile-list-orders profile-list-table">
		<thead>
		<tr class="order-row">
			<th class="column-order-number"><?php esc_html_e( 'Order', 'learnpress-woo-payment' ); ?></th>
			<th class="column-order-total"><?php esc_html_e( 'Total', 'learnpress-woo-payment' ); ?></th>
			<th class="column-order-status"><?php esc_html_e( 'Status', 'learnpress-woo-payment' ); ?></th>
			<th class="column-order-date"><?php esc_html_e( 'Date', 'learnpress-woo-payment' ); ?></th>
			<th class="column-order-actions"><?php esc_html_e( 'Actions', 'learnpress-woo-payment' ); ?></th>
		</tr>
		</thead>

		<tbody>
		<?php
		foreach ( $customer_orders as $customer_order ) {
			$order      = wc_get_order( $customer_order->ID ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			$item_count = $order->get_item_count() - $order->get_item_count_refunded();
			?>

			<tr class="order-row">
				<td class="column-order-number">
					<a href="<?php echo esc_html( $order->get_view_order_url() ); ?>">
						<?php echo esc_html( _x( '#', 'hash before order number', 'learnpress-woo-payment' ) . $order->get_order_number() ); ?>
					</a>
				</td>
				<td class="column-order-total">
					<?php
					echo wp_kses_post(
						sprintf(
							_n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'learnpress-woo-payment' ),
							$order->get_formatted_order_total(),
							$item_count
						)
					);
					?>
				</td>
				<td class="column-order-status">
						<span class="lp-label label-<?php echo esc_attr( $order->get_status() ); ?>">
							<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
						</span>
				</td>
				<td class="column-order-date">
					<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>
				</td>
				<td class="column-order-actions">
					<?php
					$actions = wc_get_account_orders_actions( $order );
					if ( ! empty( $actions ) ) {
						foreach ( $actions as $key => $action ) {
							printf( '<a href="%s">%s</a>', esc_url( $action['url'] ), $action['name'] );
						}
					}
					?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
		<tr class="list-table-nav">
			<td colspan="2" class="nav-text"><?php echo $output_format_text; ?></td>
			<td colspan="2" class="nav-pages">
				<?php
				echo learn_press_paging_nav(
					array(
						'num_pages' => $total_pages,
						'base'      => learn_press_user_profile_link( get_current_user_id(), 'orders_woocommerce' ),
						'format'    => user_trailingslashit( '%#%', '' ),
						'echo'      => false,
						'paged'     => $paged,
					)
				);
				?>
			</td>
		</tr>
		</tfoot>
	</table>
</div>
