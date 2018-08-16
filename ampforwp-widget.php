<?php
/**
 * Plugin Name: AMPforWP Elementor plus 
 * Description: AMPforWp Elementor plugin.
 * Plugin URI:  
 * Version:     1.1.0
 * Author:      AMPforWP
 * Author URI:  
 * Text Domain: elementor-ampforwp
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
define( 'ELEMENTOR_AMPFORWP__FILE__', __FILE__ );
define( 'ELEMENTOR_AMPFORWP__FILE__PATH', plugin_dir_path(__FILE__) );
define('ELEMENTOR_AMPFORWP__FILE__URI', plugin_dir_url(__FILE__));
define( 'ELEMENTOR_AMPFORWP__DIR__PATH', __DIR__ );
define( 'ELEMENTOR_AMPFORWP_TEXT_DOMAIN', 'elementor-ampforwp' );
/**
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 */
function ampforwp_elementor_load() {
	// Load localization file
	load_plugin_textdomain( ELEMENTOR_AMPFORWP_TEXT_DOMAIN );
	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'hello_world_fail_load' );
		return;
	}
	// Check required version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'hello_world_fail_load_out_of_date' );
		return;
	}
	// Require the main plugin file
	require( ELEMENTOR_AMPFORWP__DIR__PATH . '/inc/designlib/sync_page.php' );
	require( ELEMENTOR_AMPFORWP__DIR__PATH . '/inc/designlib/ampforwp-register-post.php' );
	require( ELEMENTOR_AMPFORWP__DIR__PATH . '/plugin.php' );
	require( ELEMENTOR_AMPFORWP__DIR__PATH . '/inc/common-functions.php' );
}
add_action( 'plugins_loaded', 'ampforwp_elementor_load' );



function hello_world_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}
	$file_path = 'elementor/elementor.php';
	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Elementor Hello World is not working because you are using an old version of Elementor.', 'hello-world' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'hello-world' ) ) . '</p>';
	echo '<div class="error">' . $message . '</div>';
}