<?php
class LP_Template_Certificate extends LP_Abstract_Template {
	public function __construct() {
		parent::__construct();
	}

	public function button_certificate() {
		$user   = LP_Global::user();
		$course = LP_Global::course();

		$cert_id = get_post_meta( $course->get_id(), '_lp_cert', true );
		$cert    = get_post( $cert_id );

		if ( empty( $cert ) || $cert->post_type != 'lp_cert' || $cert->post_status != 'publish' ) {
			return;
		}

		$certificate = new LP_User_Certificate( $user->get_id(), $course->get_id(), $cert_id );

		$can_get_cert = LP_Certificate::can_get_certificate( $course->get_id(), $user->get_id() );

		if ( $can_get_cert['flag'] ) {
			learn_press_certificate_get_template( 'view-button.php', array( 'certificate' => $certificate ) );
		} elseif ( ! $can_get_cert['flag'] && $can_get_cert['reason'] == 'not_buy' ) {
			learn_press_certificate_buy_button( $course );
		}
	}
}
return new LP_Template_Certificate();
