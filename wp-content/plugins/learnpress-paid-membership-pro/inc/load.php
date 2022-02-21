<?php
defined( 'ABSPATH' ) || exit;

/**
 * Class LP_Addon_Paid_Memberships_Pro
 */
class LP_Addon_Paid_Memberships_Pro extends LP_Addon {
	public $settings = array();

	/**
	 * page id of the Membership Levels page
	 *
	 * @var int
	 */
	public $pmpro_levels_page_id = null;

	/**
	 * @var string
	 */
	public $version = LP_ADDON_PMPRO_VER;

	/**
	 * @var string
	 */
	public $require_version = LP_ADDON_PMPRO_REQUIRE_VER;

	/**
	 * Path file addon
	 *
	 * @var string
	 */
	public $plugin_file = LP_ADDON_PMPRO_FILE;

	/**
	 * @var
	 */
	public $pmpro_levels;

	/**
	 * @var
	 */
	protected $user;

	/**
	 * @var
	 */
	protected $user_level;

	/**
	 * @var bool
	 */
	private $_meta_box = false;

	/**
	 * LP_Addon_Paid_Memberships_Pro constructor.
	 */
	function __construct() {
		if ( ! self::pmpro_is_active() ) {
			add_action( 'admin_notices', array( $this, 'admin_notices' ) );

			deactivate_plugins( LP_ADDON_PMPRO_BASE_NAME );

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			return;
		}

		$this->text_domain = 'learnpress-paid-membership-pro'; // pre-set text domain

		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
		parent::__construct();
	}

	protected function _includes() {
		require_once LP_ADDON_PMPRO_PATH . '/inc/functions.php';
	}

	public function plugins_loaded() {
		include 'classes/class-lp-pms-order.php';
		include 'user-hooks.php';

		$this->user = learn_press_get_current_user();

		if ( $this->user ) {
			$this->user_level = learn_press_get_membership_level_for_user( $this->user->get_id() );
		}

		if ( is_admin() ) {
			$this->admin_require();
		}
	}

	protected function _define_contants() {
		define( 'LP_PMPRO_FILE', __FILE__ );
		define( 'LP_PMPRO_URI', plugins_url( '/', LP_PMPRO_FILE ) );
		define( 'LP_PMPRO_VER', $this->version );
		define( 'LP_PMPRO_REQUIRE_VER', $this->require_version );
	}

	public function admin_require() {
		require_once __DIR__ . DIRECTORY_SEPARATOR . 'pmpro-admin' . DIRECTORY_SEPARATOR . 'pmpro-admin.php';
	}


	public function admin_notices() {
		?>
		<div class="notice notice-error">
			<p>
			<?php
				echo wp_kses(
					sprintf(
						'<strong>Paid Membership Pro</strong> addon for <strong>LearnPress</strong> requires %s plugin is <strong>installed</strong> and <strong>activated</strong>.',
						sprintf(
							'<a href="%s" target="_blank">Paid Membership Pro</a>',
							admin_url( 'plugin-install.php?tab=search&type=term&s=paid memberships pro' )
						)
					),
					array(
						'a'      => array(
							'href'   => array(),
							'target' => array(),
						),
						'strong' => array(),
					)
				);
			?>
				</p>
		</div>
		<?php
	}

	function get_pmpro_levels_page_id() {
		if ( null === $this->pmpro_levels_page_id ) {
			$this->pmpro_levels_page_id = pmpro_getOption( 'levels_page_id' );
		}

		return $this->pmpro_levels_page_id;
	}

	/*
	function pmpro_can_enroll( $course_id ) {
		$course_levels = $this->get_course_levels( $course_id );
		$has_access	= $this->checkUserHasLevel( $course_levels );

		return $has_access;
	}*/

	/**
	 * @param array $levels array level_id
	 *
	 * @return bool
	 */
	private function checkUserHasLevel( $levels ) {
		$levels = (array) $levels;

		if ( ! $this->user_level ) {
			return false;
		}

		foreach ( $levels as $l ) {
			if ( $l == $this->user_level->ID ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Init hooks
	 */
	protected function _init_hooks() {
		// get all memberships
		add_action( 'learn-press/content-single', array( $this, 'get_pmpro_get_all_levels' ), - 1 );

		// Add the Memberships tab in LearnPress Settings page
		add_filter( 'learn-press/admin/settings-tabs-array', array( $this, 'admin_settings' ) );

		// build externaml link buy course
		add_filter( 'learn-press/course-external-link', array( $this, 'external_link_buy_course' ), 10, 2 );

		add_action( 'learn-press/course-buttons', array( $this, 'add_buy_membership_button' ), 10 );

		add_filter( 'learn-press/retake-course-button-text', array( $this, 'retake_course_text_calback' ), 10 );

		// add scripts to frontend
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue_scripts' ) );

		// add scripts to admin
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		/* Override page list levels Templates */
		add_filter( 'pmpro_pages_custom_template_path', array( $this, 'learn_press_pmpro_pages_custom_template_path' ), 10, 5 );
		add_action( 'pmpro_checkout_after_pricing_fields', array( $this, 'learn_press_pmpro_checkout_after_pricing_fields' ) );

		add_filter( 'pmpro_email_data', array( $this, 'learn_press_pmpro_email_data' ), 10, 2 );

		add_filter( 'learn-press/purchase-course-button-text', array( $this, 'learn_press_pmpro_purchase_button_text' ), 10 );

		add_shortcode( 'lp_pmpro_courses', array( $this, 'learn_press_page_levels_short_code' ) );

		add_action( 'pmpro_before_change_membership_level', array( $this, 'learn_press_pmpro_after_change_membership_level' ), 10, 4 );

		// Add the Memberships tab to Course settings in edit Course page

		add_filter(
			'lp_course_data_settings_tabs',
			function( $data ) {
				$data['paid-memberships-pro'] = array(
					'label'    => esc_html__( 'Course Memberships', 'learnpress-paid-membership-pro' ),
					'target'   => 'lp-course-membership-pro',
					'icon'     => 'dashicons-groups',
					'priority' => 90,
				);

				return $data;
			}
		);

		add_action(
			'lp_course_data_setting_tab_content',
			function() {
				global $thepostid;

				$options_levels = array();
				$pmpro_levels   = lp_pmpro_get_all_levels();

				foreach ( $pmpro_levels as $pmpro_level ) {
					$options_levels[ $pmpro_level->id ] = $pmpro_level->name;
				}

				$values = get_post_meta( $thepostid, '_lp_pmpro_levels', false ) ?? array();
				?>

				<div id="lp-course-membership-pro" class="lp-meta-box-course-panels">
						<?php
						do_action( 'learnpress/course-settings/before-membership' );

						lp_meta_box_select_field(
							array(
								'id'            => '_lp_pmpro_levels',
								'label'         => esc_html__( 'Select membership levels', 'learnpress-paid-membership-pro' ),
								'options'       => $options_levels,
								'value'         => $values,
								'multiple'      => true,
								'style'         => 'min-width:200px',
								'wrapper_class' => 'lp-select-2',
								'description'   => esc_html__( 'Select membership levels', 'learnpress-paid-membership-pro' ),
							)
						);

						do_action( 'learnpress/course-settings/after-membership' );
						?>
				</div>
				<?php
			}
		);

		add_action(
			'learnpress_save_lp_course_metabox',
			function( $post_id = 0 ) {
				$values       = get_post_meta( $post_id, '_lp_pmpro_levels', false ) ?? array();
				$pmpro_levels = isset( $_POST['_lp_pmpro_levels'] ) ? (array) wp_unslash( $_POST['_lp_pmpro_levels'] ) : array();

				$array_values = ! empty( $values ) ? array_values( $values ) : array();
				$level_values = ! empty( $pmpro_levels ) ? array_values( $pmpro_levels ) : array();

				$del_course_ids = array_diff( $array_values, $level_values );
				$new_course_ids = array_diff( $level_values, $array_values );

				foreach ( $del_course_ids as $level_id ) {
					delete_post_meta( $post_id, '_lp_pmpro_levels', $level_id );
				}

				foreach ( $new_course_ids as $level_id ) {
					add_post_meta( $post_id, '_lp_pmpro_levels', $level_id, false );
				}
			}
		);

	}

	public function get_pmpro_get_all_levels() {
		$this->pmpro_levels = lp_pmpro_get_all_levels();
	}

	/**
	 * callback function for hook 'learn-press/admin/settings-tabs-array'.
	 * it add new tab in LearnPress Settings page.
	 *
	 * @param array $tabs
	 *
	 * @return array
	 */
	public function admin_settings( $tabs ) {
		$tabs['membership'] = include_once LP_ADDON_PMPRO_PATH . '/inc/classes/class-lp-pms-setting.php';

		return $tabs;
	}

	/**
	 * build content of settings tab for Paid Memberships Pro in edit course page
	 * NOT USE IN LP4
	 *
	 * @return mixed
	 */
	function meta_box() {
		$prefix         = '_lp_pmpro_';
		$options_levels = array();
		$pmpro_levels   = lp_pmpro_get_all_levels();

		foreach ( $pmpro_levels as $pmpro_level ) {
			$options_levels[ $pmpro_level->id ] = $pmpro_level->name;
		}

		$meta_box = array(
			'id'     => 'course_pmpro',
			'title'  => __( 'Course Memberships', 'learnpress-paid-membership-pro' ),
			'icon'   => 'dashicons-groups',
			'pages'  => array( LP_COURSE_CPT ),
			'fields' => array(
				array(
					'name'        => __( 'Select Membership Levels', 'learnpress-paid-membership-pro' ),
					'id'          => "{$prefix}levels",
					'type'        => 'select_advanced',
					'options'     => $options_levels,
					'multiple'    => true,
					'placeholder' => __( 'Select membership levels', 'learnpress-paid-membership-pro' ),
				),
			),
		);

		/*** Check if on frontend editor set type is select */
		$current_url = LP_Helper::getUrlCurrent();

		preg_match( '/wp-admin/', $current_url, $match );

		if ( count( $match ) == 0 ) {
			$meta_box = array(
				'id'     => 'course_pmpro',
				'title'  => __( 'Course Memberships', 'learnpress-paid-membership-pro' ),
				'icon'   => 'dashicons-groups',
				'pages'  => array( LP_COURSE_CPT ),
				'fields' => array(
					array(
						'name'        => __( 'Select Membership Levels', 'learnpress-paid-membership-pro' ),
						'id'          => "{$prefix}levels",
						'type'        => 'select',
						'options'     => $options_levels,
						'multiple'    => true,
						'placeholder' => __( 'Select membership levels', 'learnpress-paid-membership-pro' ),
					),
				),
			);
		}

		/*** End */

		return apply_filters( 'learn_press_pmpro_meta_box_args', $meta_box );
	}

	/*
	public function get_course_levels( $course_id ) {
		return learn_press_pmpro_get_course_levels( $course_id );
	}*/

	/**
	 * add the "Buy Membership" button in to single course page
	 * To do: need check again @tungnx
	 */
	public function add_buy_membership_button() {
		global $post;
		// get course levels
		$course_id = learn_press_get_course_id();

		if ( ! $course_id ) {
			$course_id = $post->ID;
		}

		$course_levels = learn_press_pmpro_get_course_levels( $course_id );

		if ( ! $course_levels || empty( $course_levels ) ) {
			return;
		}

		// get user levels
		$current_user = learn_press_get_current_user();
		$course       = learn_press_get_course( $course_id );

		if ( ! $course ) {
			return;
		}

		if ( ! $current_user || $current_user instanceof LP_User_Guest ) {
			$pmpro_levels_page_id        = $this->get_pmpro_levels_page_id();
			$redirect                    = add_query_arg(
				'course_id',
				$course_id,
				get_the_permalink( $pmpro_levels_page_id )
			);
			$redirect                    = apply_filters(
				'learn_press_pmpro_redirect_levels_page',
				$redirect,
				$course,
				$pmpro_levels_page_id,
				$current_user
			);
			$buy_through_membership_text = LP()->settings()->get( 'button_buy_membership' );

			if ( empty( $buy_through_membership_text ) ) {
				$buy_through_membership_text = esc_html__( 'Buy Membership', 'learnpress-paid-membership-pro' );
			}

			$buy_through_membership_text = apply_filters(
				'learn_press_buy_through_membership_text',
				$buy_through_membership_text,
				$redirect,
				$course,
				$pmpro_levels_page_id,
				$current_user
			);

			$args = array(
				'buy_through_membership_text' => $buy_through_membership_text,
				'redirect'                    => $redirect,
				'course'                      => $course,
				'levels_page_id'              => $pmpro_levels_page_id,
				'current_user'                => $current_user,
			);

			learn_press_get_template(
				'button-buy-membership.php',
				$args,
				learn_press_template_path() . '/addons/paid-membership-pro/',
				LP_ADDON_PMPRO_TEMP
			);

			return;
		}

		$course_status = $current_user->get_course_status( $course_id );
		$has_purchased = $current_user->has_purchased_course( $course_id );

		$can_retake = $current_user->can_retry_course( $course_id );
		// $can_enroll   = $current_user->can_enroll_course( $course_id );
		// $can_purchase = $current_user->can_purchase_course( $course_id );
		// $current_user->has_purchased_course( $course_id );

		if ( is_user_logged_in() && $can_retake && $has_purchased ) {
			return;
		}

		if ( ! $this->hasMembershipLevel( $course_levels ) && ( empty( $course_status ) || in_array( $course_status, array( 'finished', 'cancelled' ) ) ) ) {
			$pmpro_levels_page_id   = $this->get_pmpro_levels_page_id();
			$redirect               = add_query_arg(
				'course_id',
				$course_id,
				get_the_permalink( $pmpro_levels_page_id )
			);
			$redirect               = apply_filters(
				'learn_press_pmpro_redirect_levels_page',
				$redirect,
				$course,
				$pmpro_levels_page_id,
				$current_user
			);
			$buy_through_membership = LP()->settings()->get( 'buy_through_membership' );

			$buy_through_membership_text = LP()->settings()->get( 'button_buy_membership' );

			if ( empty( $buy_through_membership_text ) ) {
				$buy_through_membership_text = esc_html__( 'Buy Membership', 'learnpress-paid-membership-pro' );
			}

			$buy_through_membership_text = apply_filters(
				'learn_press_buy_through_membership_text',
				$buy_through_membership_text,
				$redirect,
				$course,
				$pmpro_levels_page_id,
				$current_user
			);

			$args = array(
				'buy_through_membership_text' => $buy_through_membership_text,
				'redirect'                    => $redirect,
				'course'                      => $course,
				'levels_page_id'              => $pmpro_levels_page_id,
				'current_user'                => $current_user,
			);

			learn_press_get_template(
				'button-buy-membership.php',
				$args,
				learn_press_template_path() . '/addons/paid-membership-pro/',
				LP_ADDON_PMPRO_TEMP
			);
		}
	}


	public function retake_course_text_calback( $text ) {
		global $post;
		// get course levels
		$course_id = learn_press_get_course_id();

		if ( ! $course_id ) {
			$course_id = $post->ID;
		}

		$course_levels = learn_press_pmpro_get_course_levels( $course_id );

		if ( ! empty( $course_levels ) && $this->hasMembershipLevel( $course_levels ) ) {
			$text = esc_html__( 'Retake course', 'learnpress-paid-membership-pro' );
		}

		return $text;
	}


	private function hasMembershipLevel( $levels = array() ) {
		return learn_press_pmpro_hasMembershipLevel( $levels );
	}


	public function frontend_enqueue_scripts() {
		$v_rand = uniqid();

		if ( LP_Debug::is_debug() ) {
			wp_register_style(
				'learn-press-pmpro-style',
				LP_ADDON_PMPRO_URL . 'assets/lp-pms-style.css',
				array(),
				$v_rand
			);
		} else {
			wp_register_style(
				'learn-press-pmpro-style',
				LP_ADDON_PMPRO_URL . 'assets/lp-pms-style.min.css',
				array(),
				LP_ADDON_PMPRO_VER
			);
		}

		if ( is_archive() || learn_press_is_course() ) {
			wp_enqueue_style( 'learn-press-pmpro-style' );
		}
	}

	public function admin_enqueue_scripts() {
		$v_rand = uniqid();
		$screen = get_current_screen();

		if ( LP_Debug::is_debug() ) {
			wp_register_script(
				'learn-press-pms-script',
				LP_ADDON_PMPRO_URL . 'assets/admin-lp-pms.js',
				array(),
				$v_rand,
				true
			);
		} else {
			wp_register_script(
				'learn-press-pms-script',
				LP_ADDON_PMPRO_URL . 'assets/admin-lp-pms.min.js',
				array(),
				LP_ADDON_PMPRO_VER,
				true
			);
		}

		if ( $screen ) {
			$check_valid = strpos( $screen->id, 'page_pmpro-membershiplevels' );

			if ( $check_valid ) {
				wp_enqueue_script( 'learn-press-pms-script' );
			}
		}
	}

	public function learn_press_pmpro_pages_custom_template_path( $default_templates, $page_name, $type, $where, $ext ) {
		$template = learn_press_pmpro_locate_template( "{$type}/{$page_name}.{$ext}" );

		if ( file_exists( $template ) ) {
			$default_templates[] = $template;
		}

		return $default_templates;
	}

	public function learn_press_pmpro_email_data( $data, $email ) {
		$path_email = LP_ADDON_PMPRO_PATH . '/templates/email/';
		$path_email = apply_filters( 'learn_press_pmpro_email_custom_template_path', $path_email, $data, $email );

		if ( ! empty( $email->body ) && ! empty( $email->template ) && file_exists( $path_email . $email->template . '.html' ) ) {
			$email->body = file_get_contents( $path_email . $email->template . '.html' );
		}

		return $data;
	}

	public function learn_press_pmpro_checkout_after_pricing_fields() {
		$content = pmpro_loadTemplate( 'checkout-custom-pricing', 'local', 'pages' );

		echo $content;
	}

	/**
	 * @param int $course_id
	 *
	 * @todo: remove this function in next version
	 */
	public function learn_press_before_course_buttons( $course_id ) {
		$this->add_buy_membership_button();
	}

	public function external_link_buy_course( $external_link_buy_course, $course = null ) {
		$buy_through_membership = LP()->settings()->get( 'buy_through_membership' );
		$is_required            = learn_press_pmpro_check_require_template();

		if ( ! empty( $buy_through_membership ) && $buy_through_membership === 'yes' && $is_required ) {
			return '';
		}

		return $external_link_buy_course;
	}

	public function learn_press_pmpro_purchase_button_text( $purchase_text ) {
		$is_required            = learn_press_pmpro_check_require_template();
		$buy_through_membership = LP()->settings()->get( 'buy_through_membership' );
		$new_text               = LP()->settings()->get( 'button_buy_course' );

		if ( ! empty( $buy_through_membership ) && $buy_through_membership == 'no' && ! empty( $new_text ) && $is_required ) {
			return $new_text;
		}

		return $purchase_text;
	}

	public function learn_press_page_levels_short_code() {
		echo do_shortcode( '[pmpro_levels]' );
	}

	public function learn_press_pmpro_after_change_membership_level( $level_id, $user_id, $old_levels, $cancel_level ) {

	}

	/**
	 * Return TRUE if Paid Membership PRO plugin is installed and active
	 *
	 * @return bool
	 */
	static function pmpro_is_active() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		return is_plugin_active( 'paid-memberships-pro/paid-memberships-pro.php' );
	}

	/**
	 * Return TRUE if Paid Membership PRO plugin is installed and active
	 *
	 * @return bool
	 */
	static function learnpress_is_active() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		return is_plugin_active( 'learnpress/learnpress.php' ) || is_plugin_active( 'LearnPress/learnpress.php' );
	}
}
