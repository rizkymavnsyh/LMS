<?php
/**
 * Plugin load class.
 *
 * @author   ThimPress
 * @package  LearnPress/Fill-In-Blank/Classes
 * @version  3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LP_Addon_Fill_In_Blank' ) ) {

	/**
	 * Class LP_Addon_Fill_In_Blank
	 */
	class LP_Addon_Fill_In_Blank extends LP_Addon {

		/**
		 * @var string
		 */
		public $version = LP_ADDON_FILL_IN_BLANK_VER;

		/**
		 * @var string
		 */
		public $require_version = LP_ADDON_FILL_IN_BLANK_REQUIRE_VER;

		/**
		 * @var LP_FIB_Upgrade
		 */
		public $upgrader = null;

		/**
		 * LP_Addon_Fill_In_Blank constructor.
		 */
		public function __construct() {
			parent::__construct();



			$this->_maybe_upgrade_data();

			$tool_path = dirname( LP_ADDON_FILL_IN_BLANK_FILE ) . "/inc/admin/class-upgrade-database.php";
			if ( file_exists( $tool_path ) ) {
				$this->upgrader = include_once( $tool_path );
			}
			// update question answer meta
			add_action( 'learn-press/question/updated-answer-data', array(
				$this,
				'update_question_answer_meta'
			), 10, 3 );

			// delete answer meta before delete question.
			add_action( 'learn-press/before-clear-question', array( $this, 'clear_question_answer_meta' ) );
		}


		/**
		 * Update needed answer meta.
		 *
		 * @param int   $question_id
		 * @param int   $answer_id
		 * @param mixed $answer_data
		 */
		public function update_question_answer_meta( $question_id, $answer_id, $answer_data ) {
			if ( ! empty( $answer_data['blanks'] ) ) {
				$blanks = $answer_data['blanks'];
			} else {
				$blanks = '';
			}

			if ( is_array( $blanks ) ) {
				/**
				 * @var $question LP_Question_Fill_In_Blank
				 */
				$question = LP_Question::get_question( $question_id );
				foreach ( $blanks as $id => $blank ) {
					$question->_blanks[ $blank['id'] ] = $blank;
				}

			}

			learn_press_update_question_answer_meta( $answer_id, '_blanks', $blanks );


//			echo '<pre>';
//			var_dump($question);
//			echo '</pre>';
//			echo '<pre>';
//			var_dump($question->_blanks);
//			echo '</pre>';
//			die();

		}

		/**
		 * Delete answer meta before delete FIB question.
		 *
		 * @param $question_id
		 */
		public function clear_question_answer_meta( $question_id ) {
			$question = LP_Question::get_question( $question_id );
			$answers  = $question->get_answers();

			foreach ( $answers as $answer_id ) {
				learn_press_delete_question_answer_meta( $answer_id, '_blanks', '', true );
			}
		}

		protected function _get_questions() {
			global $wpdb;

			$query = $wpdb->prepare( "
		        SELECT p.ID
                FROM {$wpdb->posts} p
                INNER JOIN {$wpdb->postmeta} pm  ON p.ID = pm.post_id AND pm.meta_key = %s AND pm.meta_value = %s
                LEFT JOIN {$wpdb->postmeta} pm2 ON p.ID = pm2.post_id AND pm2.meta_key = %s
                WHERE pm2.meta_value IS NULL OR pm2.meta_value <> %s
		    ", '_lp_type', 'fill_in_blank', '_db_version', '3.0.0' );

			return $wpdb->get_col( $query );

		}

		protected function _maybe_upgrade_data() {

			if ( version_compare( LP_ADDON_FILL_IN_BLANK_VER, '3.0.0', '=' ) && version_compare( get_option( 'learnpress_fib_db_version' ), '3.0.0', '<' ) ) {

				global $wpdb;

				if ( ! $question_ids = $this->_get_questions() ) {
					return;
				}

				$format = array_fill( 0, sizeof( $question_ids ), '%d' );
				$args   = array_merge( array(
					'_lp_type',
					'fill_in_blank',
				), $question_ids );


				$query = $wpdb->prepare( "
                    SELECT qa.*
                    FROM {$wpdb->learnpress_question_answers} qa
                    INNER JOIN {$wpdb->learnpress_quiz_questions} qq ON qq.question_id = qa.question_id
                    INNER JOIN {$wpdb->postmeta} pm ON pm.meta_key = %s AND pm.meta_value = %s AND pm.post_id = qq.question_id
                    AND qq.question_id IN(" . join( ',', $format ) . ")
                    LIMIT 0, 100
                ", $args );

				if ( ! $answers = $wpdb->get_results( $query ) ) {
					return;
				}

				$queue_items = array();
				foreach ( $answers as $answer ) {
					$answer_data = maybe_unserialize( $answer->answer_data );

					if ( array_key_exists( 'text', $answer_data ) ) {
						continue;
					}

					$answer_text = reset( $answer_data );

					$answer_data = array(
						'text'    => $answer_text,
						'value'   => learn_press_uniqid(),
						'is_true' => ''
					);

					if ( empty( $queue_items[ $answer->question_id ] ) ) {
						$queue_items[ $answer->question_id ] = array();
					}

					$queue_items[ $answer->question_id ][] = array(
						'question_answer_id' => $answer->question_answer_id,
						'answer_data'        => $answer_data
					);
				}

				if ( $queue_items ) {
					LP_Background_Global::add( 'update-fib-answers', array( 'questions' => $queue_items ), array(
						$this,
						'upgrade_db'
					) );
				}
			}
		}

		/**
		 * Upgrade database
		 *
		 * @param array $questions
		 */
		public function upgrade_db( $questions ) {
			global $wpdb;

			if ( ! $questions ) {
				return;
			}

			foreach ( $questions as $question_id => $answers ) {
				$updated = 0;
				foreach ( $answers as $answer ) {
					if ( $wpdb->update(
						$wpdb->learnpress_question_answers,
						array(
							'answer_data' => maybe_serialize( $answer['answer_data'] )
						),
						array(
							'question_answer_id' => $answer['question_answer_id'],
							'question_id'        => $question_id
						),
						array( '%s' ),
						array( '%d', '%d' )
					)
					) {
						$updated ++;
					}
				}

				if ( $updated ) {
					update_post_meta( $question_id, '_db_version', LP_ADDON_FILL_IN_BLANK_VER );
				}
			}
		}

		/**
		 * Define Learnpress Fill In Blank constants.
		 *
		 * @since 3.0.0
		 */
		protected function _define_constants() {
			if ( ! defined( 'LP_ADDON_FILL_IN_BLANK_PATH' ) ) {
				define( 'LP_ADDON_FILL_IN_BLANK_PATH', dirname( LP_ADDON_FILL_IN_BLANK_FILE ) );
				define( 'LP_ADDON_FILL_IN_BLANK_ASSETS', LP_ADDON_FILL_IN_BLANK_PATH . '/assets/' );
				define( 'LP_ADDON_FILL_IN_BLANK_INC', LP_ADDON_FILL_IN_BLANK_PATH . '/inc/' );
				define( 'LP_ADDON_FILL_IN_BLANK_TEMPLATE', LP_ADDON_FILL_IN_BLANK_PATH . '/templates/' );
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 */
		protected function _includes() {
			include_once LP_ADDON_FILL_IN_BLANK_INC . 'class-lp-question-fill-in-blank.php';
			include_once LP_ADDON_FILL_IN_BLANK_INC . 'functions.php';
		}

		/**
		 * Hook into actions and filters.
		 *
		 * @since 3.0.0
		 */
		protected function _init_hooks() {
			add_filter( 'learn_press_question_types', array( __CLASS__, 'register_question' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

			add_filter( 'learn-press/admin/external-js-component', array( $this, 'add_external_component_type' ) );

			// js template for admin editor
			add_action( 'edit_form_after_editor', array( $this, 'js_template' ) );
			// add vue component tag to quiz, question editor
			add_action( 'learn-press/question-editor/question-js-component', array( $this, 'question_component' ) );
			add_action( 'learn-press/quiz-editor/question-js-component', array( $this, 'quiz_question_component' ) );
		}

		/**
		 * Enqueue assets.
		 *
		 * @since 3.0.0
		 */
		public function enqueue_scripts() {
			if ( is_admin() ) {
				$assets = learn_press_admin_assets();
				$assets->enqueue_style( 'lp-fib-question-admin-css', $this->get_plugin_url( 'assets/css/admin.fib.css' ) );
				$assets->enqueue_script( 'fib-js', $this->get_plugin_url( 'assets/js/admin.fib.js' ), array( 'jquery' ) );
			} else {
				$assets = learn_press_assets();
				$assets->enqueue_script( 'lp-fib-question-js', $this->get_plugin_url( 'assets/js/fib.js' ), array( 'jquery' ) );
				$assets->enqueue_style( 'lp-fib-question-css', $this->get_plugin_url( 'assets/css/fib.css' ) );
			}
		}

		/**
		 * Register question to Learnpress list question types.
		 *
		 * @since 3.0.0
		 *
		 * @param $types
		 *
		 * @return mixed
		 */
		public static function register_question( $types ) {
			$types['fill_in_blank'] = __( 'Fill In Blank', 'learnpress-fill-in-blank' );

			return $types;
		}

		/**
		 * Fill in blank question JS Template for admin quiz and question.
		 */
		public function js_template() {
			if ( get_post_type() == LP_QUESTION_CPT ) {
				learn_press_fib_admin_view( 'answer-question-editor' );
			} else if ( get_post_type() == LP_QUIZ_CPT ) {
				learn_press_fib_admin_view( 'answer-quiz-editor' );
			}
		}

		/**
		 * Add questions type has js external component.
		 *
		 * @param $types
		 *
		 * @return array
		 */
		public function add_external_component_type( $types ) {
			$types[] = 'fill_in_blank';

			return $types;
		}

		/**
		 * Add Vue component to admin question editor.
		 */
		public function question_component() { ?>
            <lp-fib-question-answer v-if="type=='fill_in_blank'" :type="type"
                                    :answers="answers"></lp-fib-question-answer>
		<?php }

		/**
		 * Add Vue component to admin quiz editor.
		 */
		public function quiz_question_component() { ?>
            <lp-quiz-fib-question-answer v-if="question.type.key == 'fill_in_blank'"
                                         :question="question"></lp-quiz-fib-question-answer>
		<?php }
	}
}

add_action( 'plugins_loaded', array( 'LP_Addon_Fill_In_Blank', 'instance' ) );