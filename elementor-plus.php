<?php
/**
 * Plugin Name: Elementor Plus 
 * Description: Elementor Plus takes your Elementor to the next level.
 * Plugin URI: http://elementor-plus.com/
 * Version: 1.0
 * Author: mohammed_kaludi, ahmedkaludi, ampforwp
 * Author URI:  http://elementor-plus.com/
 * Text Domain: elementor-ampforwp
 */


if ( ! defined( 'ABSPATH' ) ) exit; 
define( 'ELEMENTOR_PLUS__FILE__', __FILE__ );
define( 'ELEMENTOR_PLUS__FILE__PATH', plugin_dir_path(__FILE__) );
define( 'ELEMENTOR_PLUS__FILE__URI', plugin_dir_url(__FILE__));
define( 'ELEMENTOR_PLUS__DIR__PATH', __DIR__ );
define( 'ELEMENTOR_PLUS_TEXT_DOMAIN', 'elementor-plus' );
define( 'ELEMENTOR_PLUS_ENVIRONEMT', 'production' );//development
/**
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 */
function elementor_plus_load() {
	// Load localization file
	load_plugin_textdomain( ELEMENTOR_PLUS_TEXT_DOMAIN );
	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'elementor_plus_fail_load' );
		return;
	}
	// Check required version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'elementor_plus_fail_load_out_of_date' );
		return;
	}
	// Require the main plugin file
	global $elementor_plus_ampCss;
	require( ELEMENTOR_PLUS__DIR__PATH . '/inc/designlib/sync_page.php' );
	require( ELEMENTOR_PLUS__DIR__PATH . '/inc/designlib/register-post.php' );
	require( ELEMENTOR_PLUS__DIR__PATH . '/inc/image-aqua.php' );
	require( ELEMENTOR_PLUS__DIR__PATH . '/elementor-plus-plugin.php' );
	require( ELEMENTOR_PLUS__DIR__PATH . '/inc/common-functions.php' );
	if(is_admin()){
		require( ELEMENTOR_PLUS__DIR__PATH . '/admin/admin-settings.php' );
	}
	register_activation_hook(__FILE__, 'elementore_plus_activation_hook');
}
add_action( 'plugins_loaded', 'elementor_plus_load' );


function elementore_plus_activation_hook(){
	if('development'!=ELEMENTOR_PLUS_ENVIRONEMT){ //on production 
		elementore_plus_activation();
	}
}


function elementor_plus_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}
	$file_path = 'elementor/elementor.php';
	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Elementor Plus is not working because you are using an old version of Elementor.', ELEMENTOR_PLUS_TEXT_DOMAIN ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', ELEMENTOR_PLUS_TEXT_DOMAIN ) ) . '</p>';
	echo '<div class="error">' . $message . '</div>';
}
function elementor_plus_fail_load() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}
	echo '<div class="error">' . esc_html(__( 'Elementor Not loaded', ELEMENTOR_PLUS_TEXT_DOMAIN ) ) . '</div>';
}