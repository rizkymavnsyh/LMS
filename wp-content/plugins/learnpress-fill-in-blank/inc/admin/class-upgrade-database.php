<?php

/**
 * Class LP_FIB_Upgrade
 */
class LP_FIB_Upgrade {
	/**
	 * LP_FIB_Upgrade constructor.
	 */
	public function __construct() {
		add_filter( 'learn-press/admin/tools-tabs', array( $this, 'admin_tab' ) );
		add_action( 'learn-press/admin/page-content-tools/fib', array( $this, 'admin_tab_content' ) );


		LP_Request::register_ajax( 'fib-upgrade', array( $this, 'do_upgrade' ) );
	}

	public function admin_tab( $tabs ) {
		$tabs['fib'] = __( 'Fill in blank', 'learnpress-fill-in-blank' );

		return $tabs;
	}

	public function admin_tab_content() {
		learn_press_fib_admin_view( 'tool-upgrade' );
	}

	public function upgrade_question( $question_id ) {
		global $wpdb;

		if ( ! $answer = $this->get_question_answers( $question_id ) ) {
			return false;
		}

		if ( empty( $answer->answer_data ) ) {
			return false;
		}


		if ( empty( $answer->answer_data['text'] ) ) {
			return false;
		}

		$update_blanks = array();

		if ( $blanks = $this->parse_blanks( $answer->answer_data['text'] ) ) {
			$pattern                     = $this->get_wp_shortcode_regex();
			$answer->answer_data['text'] = preg_replace_callback( $pattern, array(
				$this,
				'_add_shortcode_id_callback'
			), $answer->answer_data['text'] );

			$wpdb->update(
				$wpdb->learnpress_question_answers,
				array( 'answer_data' => serialize( $answer->answer_data ) ),
				array( 'question_answer_id' => $answer->question_answer_id )
			);
		}

		$old_blanks = learn_press_get_question_answer_meta(
			$answer->question_answer_id,
			'_blanks',
			true
		);

		if ( $blanks = $this->parse_blanks( $answer->answer_data['text'] ) ) {

			foreach ( $blanks as $blank ) {
				if ( ! empty( $blank['atts']['id'] ) ) {
					$blank_id = $blank['atts']['id'];

					if ( $old_blanks && ! empty( $old_blanks[ $blank_id ] ) ) {
						$update_blanks[ $blank_id ] = $old_blanks[ $blank_id ];
					}

					if ( $blank['atts'] ) {
						foreach ( $blank['atts'] as $k => $v ) {
							$update_blanks[ $blank_id ][ $k ] = $v;
						}
					}
				}
			}
		}

		learn_press_update_question_answer_meta(
			$answer->question_answer_id,
			'_blanks',
			$update_blanks
		);

		return $update_blanks;
	}

	public function do_upgrade() {
		global $wpdb;
		if ( ! $question_ids = $this->get_questions() ) {
			return;
		}

		foreach ( $question_ids as $question_id ) {
			$this->upgrade_question($question_id);
		}

		die();
	}

	public function _add_shortcode_id_callback( $a ) {
		if ( ! preg_match_all( '~id=".*"~iSU', $a[0] ) ) {
			return "[fib " . $a[3] . ' id="' . learn_press_uniqid() . '"]';
		}

		return $a[0];
	}

	public function parse_blanks( $content ) {
		$pattern = $this->get_wp_shortcode_regex();
		$blanks  = array();
		if ( preg_match_all( $pattern, $content, $matches ) ) {

			foreach ( $matches[3] as $k => $v ) {
				$blanks[] = array(
					'atts'      => shortcode_parse_atts( $v ),
					'shortcode' => $matches[0][ $k ]
				);
			}
		}

		return $blanks;
	}

	/**
	 * Get Wordpress shortcode regex.
	 *
	 * @return string
	 */
	public function get_wp_shortcode_regex() {
		return '/' . get_shortcode_regex( array( 'fib' ) ) . '/';
	}

	public function get_question_answers( $question_id ) {
		global $wpdb;
		$query = $wpdb->prepare( "
			SELECT *
			FROM {$wpdb->learnpress_question_answers}
			WHERE question_id = %d
		", $question_id );

		if ( $row = $wpdb->get_row( $query ) ) {

			if ( $row->answer_data = maybe_unserialize( stripslashes( $row->answer_data ) ) ) {
				$answer_data         = (array) $row->answer_data;
				$answer_data['text'] = preg_replace( '~id=".*"~iSU', '', $row->answer_data['text'] );
			}

		}

		return $row;
	}

	public function get_questions() {
		global $wpdb;
		echo $query = $wpdb->prepare( "
			SELECT ID 
			FROM {$wpdb->posts} p 
			INNER JOIN {$wpdb->postmeta} pm ON pm.post_id = p.ID AND pm.meta_key = %s AND pm.meta_value = %s
			WHERE post_type = %s
		", '_lp_type', 'fill_in_blank', LP_QUESTION_CPT );

		return $wpdb->get_col( $query );
	}
}

return new LP_FIB_Upgrade();