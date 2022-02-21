<?php
/*
Plugin Name: LearnPress - Fill In Blank Question
Plugin URI: http://thimpress.com/learnpress
Description: Supports type of question Fill In Blank lets user fill out the text into one ( or more than one ) space.
Author: ThimPress
Version: 3.1.0
Author URI: http://thimpress.com
Tags: learnpress, lms, add-on, fill-in-blank
Text Domain: learnpress-fill-in-blank
Domain Path: /languages/
*/

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

define( 'LP_ADDON_FILL_IN_BLANK_FILE', __FILE__ );
define( 'LP_ADDON_FILL_IN_BLANK_VER', '3.1.0' );
define( 'LP_ADDON_FILL_IN_BLANK_REQUIRE_VER', '3.0.0' );
define( 'LP_QUESTION_FILL_IN_BLANK_VER', '3.1.0' );

/**
 * Class LP_Addon_Fill_In_Blank_Preload
 */
class LP_Addon_Fill_In_Blank_Preload {

	/**
	 * LP_Addon_Fill_In_Blank_Preload constructor.
	 */
	public function __construct() {
		add_action( 'learn-press/ready', array( $this, 'load' ) );
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
	}

	/**
	 * Load addon
	 */
	public function load() {
		LP_Addon::load( 'LP_Addon_Fill_In_Blank', 'inc/load.php', __FILE__ );
		remove_action( 'admin_notices', array( $this, 'admin_notices' ) );
	}

	/**
	 * Admin notice
	 */
	public function admin_notices() {
		?>
        <div class="error">
            <p><?php echo wp_kses(
					sprintf(
						__( '<strong>%s</strong> addon version %s requires %s version %s or higher is <strong>installed</strong> and <strong>activated</strong>.', 'learnpress-fill-in-blank' ),
						__( 'LearnPress Fill In Blank', 'learnpress-fill-in-blank' ),
						LP_ADDON_FILL_IN_BLANK_VER,
						sprintf( '<a href="%s" target="_blank"><strong>%s</strong></a>', admin_url( 'plugin-install.php?tab=search&type=term&s=learnpress' ), __( 'LearnPress', 'learnpress-fill-in-blank' ) ),
						LP_ADDON_FILL_IN_BLANK_REQUIRE_VER
					),
					array(
						'a'      => array(
							'href'  => array(),
							'blank' => array()
						),
						'strong' => array()
					)
				); ?>
            </p>
        </div>
		<?php
	}
}

new LP_Addon_Fill_In_Blank_Preload();