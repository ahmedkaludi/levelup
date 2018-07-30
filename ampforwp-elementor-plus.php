<?php
/**
 * Plugin Name: Ampforwp Elementor Plus
 * Description: Elementor sample plugin.
 * Plugin URI:  https://elementor.com/
 * Version:     1.1.0
 * Author:      Author Name
 * Author URI:  https://elementor.com/
 * Text Domain: ampforwp-elementor-plus
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'ELEMENTOR_PLUS_DIR_PATH', plugin_dir_path(__FILE__) );
define( 'ELEMENTOR_AMPFORWP_ELEMENTOR_PLUS__FILE__', __FILE__ );

function ampforwp_elementor_plus_load() {
	// Load localization file
	load_plugin_textdomain( 'ampforwp-elementor-plus' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'ampforwp_elementor_plus_fail_load' );
		return;
	}

	// Check required version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'ampforwp_elementor_plus_fail_load_out_of_date' );
		return;
	}

	// Require the main plugin file
	require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'ampforwp_elementor_plus_load' );


function ampforwp_elementor_plus_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Elementor Hello World is not working because you are using an old version of Elementor.', 'ampforwp-elementor-plus' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'ampforwp-elementor-plus' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

function ampforwp_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'ampforwp',
		[
			'title' => __( 'Ampforwp Elementor Plus', 'ampforwp-elementor-plus' ),
			'icon' => 'fa fa-plug',
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'ampforwp_add_elementor_widget_categories' );


add_action( 'elementor/editor/before_enqueue_scripts', 'elementor_widget_enque_script' );
function elementor_widget_enque_script(){
	wp_register_script( 'ampforwp-call-to-action', plugins_url( 'widgets/assets/js/ampforwp-call-to-action.js', ELEMENTOR_AMPFORWP_ELEMENTOR_PLUS__FILE__ ), [ 'jquery' ], false, true );
	wp_enqueue_script( 'ampforwp-call-to-action' );
}