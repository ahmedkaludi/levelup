<?php
/**
 * Plugin Name: LevelUP 
 * Description: LevelUP takes your Elementor to the next level.
 * Plugin URI: http://levelup.magazine3.company/
 * Version: 1.0.1
 * Author: mohammed_kaludi, ahmedkaludi, ampforwp
 * Author URI: http://magazine3.company/
 * Text Domain: levelup
 * Domain Path: /languages/
 */


if ( ! defined( 'ABSPATH' ) ) exit; 
define( 'LEVELUP__FILE__', __FILE__ );
define( 'LEVELUP__FILE__PATH', plugin_dir_path(__FILE__) );
define( 'LEVELUP__FILE__URI', plugin_dir_url(__FILE__));
define( 'LEVELUP__DIR__PATH', __DIR__ );
define( 'LEVELUP_TEXT_DOMAIN', 'levelup' );
define( 'LEVELUP_ENVIRONEMT', 'production' );//development
/**
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 */
require( LEVELUP__DIR__PATH . '/inc/common-functions.php' );
require( LEVELUP__DIR__PATH . '/inc/designlib/register-post.php' );
require( LEVELUP__DIR__PATH . '/inc/designlib/sync_page.php' );
function levelup_load() {
	// Load localization file
	load_plugin_textdomain( LEVELUP_ENVIRONEMT, false, trailingslashit(LEVELUP__FILE__PATH) . 'languages' );
	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'levelup_fail_load' );
		return;
	}
	// Check required version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'levelup_fail_load_out_of_date' );
		return;
	}
	// Require the main plugin file
	global $levelup_ampCss;
	require( LEVELUP__DIR__PATH . '/inc/image-aqua.php' );
	require( LEVELUP__DIR__PATH . '/levelup-widgets.php' );
	if(is_admin()){
		require( LEVELUP__DIR__PATH . '/admin/admin-settings.php' );
	}
}
add_action( 'plugins_loaded', 'levelup_load' );

function levelup_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}
	$file_path = 'elementor/elementor.php';
	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . esc_html__( 'LevelUp is not working because you are using an old version of Elementor.', LEVELUP_TEXT_DOMAIN ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', LEVELUP_TEXT_DOMAIN ) ) . '</p>';
	echo '<div class="error">' . wp_kses_post($message) . '</div>';
}
function levelup_fail_load() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}
	echo '<div class="error">' . esc_html__( 'This plugin requires Elementor, please Activate Elementor plugin', LEVELUP_TEXT_DOMAIN )  . '</div>';
}