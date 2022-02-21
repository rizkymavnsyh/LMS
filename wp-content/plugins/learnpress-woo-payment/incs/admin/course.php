<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Class LP_Woo_Payment_Admin_Course
 */
class LP_Woo_Payment_Admin_Course {

	/**
	 * Constructor
	 */
	public function __construct() {
		# Add the Memberships tab to Course settings in edit Course page
		$this->init_hooks();
	}

	public function init_hooks() {
		add_filter( 'learn-press/admin-course-tabs', array( $this, 'admin_course_tabs' ) );
//		add_filter( 'learn-press/payment-settings/general', array( $this, 'payment_setting' ) );
	}

	public function admin_course_tabs( $tabs ) {
		$this->_meta_box         = new RW_Meta_Box( $this->meta_box() );
		$tabs['woo-payment-tax'] = $this->_meta_box;

		return $tabs;
	}

	/**
	 * Setting for Payment LP Woo
	 *
	 * @param array $settings
	 *
	 * @return array
	 */
	public function payment_setting( $settings = array() ) {
		if ( 'guest_checkout' == $settings[2]['id'] ) {
			$desc                = sprintf(
				'<br><strong><i style="color: red">If you use Woo for checkout, please go to <a href="%s">Woo Settings</a> then enable 2 option "Allow customers to place orders without an account" and "Allow customers to create an account during checkout"</i></strong>',
				home_url( 'wp-admin/admin.php?page=wc-settings&tab=account' ) );
			$settings[2]['desc'] = $settings[2]['desc'] . $desc;
		}

		return $settings;
	}

	/**
	 * build content of settings tab for Paid Memberships Pro in edit course page
	 * @return mixed
	 */
	function meta_box() {
		$prefix            = '_lp_woo_payment_';
		$options           = array();
		$options['global'] = __( 'Global', 'learnpress-woo-payment' );
		$options['yes']    = __( 'Yes', 'learnpress-woo-payment' );
		$options['no']     = __( 'No', 'learnpress-woo-payment' );

		$meta_box = array(
			'id'     => 'woo-payment',
			'title'  => __( 'Tax', 'learnpress-woo-payment' ),
			'icon'   => 'dashicons-chart-pie',
			'pages'  => array( LP_COURSE_CPT ),
			'fields' => array(
				array(
					'name'     => __( 'Enable taxes', 'learnpress-woo-payment' ),
					'id'       => "{$prefix}enable_tax",
					'type'     => 'radio',
					'options'  => $options,
					'multiple' => false,
// 								'placeholder' => __( 'Select membership levels', 'learnpress-pmpro' ),
				),
			)
		);

		return apply_filters( 'learn_press_woo_payment_meta_box_args', $meta_box );
	}
}

return new LP_Woo_Payment_Admin_Course();
