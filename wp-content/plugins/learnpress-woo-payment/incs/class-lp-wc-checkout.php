<?php

defined( 'ABSPATH' ) || exit();

class LP_WC_Checkout {
	public function __construct() {
		$this->init_hooks();
	}

	public function init_hooks() {
		/**
		 * LearnPress hooks
		 */
		add_filter( 'learn_press_get_checkout_url', array( $this, 'checkout_url' ) );
		add_filter( 'learn_press_get_page_id', array( $this, 'cart_page_id' ), 10, 2 );
	}

	/**
	 * Checkout URL
	 * @param string $url
	 * @return string $url
	 */
	public function checkout_url( string $url ): string {
		$url = wc_get_checkout_url();
		return $url;
	}

	/**
	 * Cart Page ID
	 *
	 * @param $page_id
	 * @param string $name
	 * @return mixed
	 */
	public function cart_page_id( $page_id, string $name ) {
		if ( $name === 'cart' ) {
			$page_id = wc_get_page_id( $name );
		}

		return $page_id;
	}
}

new LP_WC_Checkout();
