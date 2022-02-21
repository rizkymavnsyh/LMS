<?php

/**
 * @class WC_Order_Item_LP_Course
 */

defined( 'ABSPATH' ) || exit();

class WC_Order_Item_LP_Course extends WC_Order_Item_Product {
	/**
	 * @throws Exception
	 */
	public function set_product_id( $value ) {
		if ( $value > 0 && LP_COURSE_CPT !== get_post_type( absint( $value ) ) ) {
			$this->error( 'order_item_product_invalid_product_id', __( 'Invalid product ID', 'woocommerce' ) );
		}

		$course_id = wc_get_order_item_meta( $this->get_id(), '_course_id' );
		if ( LP_COURSE_CPT == get_post_type( absint( $course_id ) ) ) {
			$value = $course_id;
		}

		$this->set_prop( 'product_id', absint( $value ) );
	}
}
