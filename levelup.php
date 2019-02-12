<?php
/**
 * Plugin Name: AMP Designs for Elementor by LevelUP  
 * Description: Pre-Built Designs for Elementor & Gutenberg with full AMP Compatiblity
 * Plugin URI: http://wplevelup.com
 * Version: 1.1
 * Author: Ahmed Kaludi, Mohammed Kaludi
 * Author URI: http://wplevelup.com
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
define( 'LEVELUP_VERSION', '1.1' );


/**
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 */

//Elementor
require_once( LEVELUP__DIR__PATH . '/inc/common-functions.php' );
require_once( LEVELUP__DIR__PATH . '/inc/designlib/register-post.php' );
require_once( LEVELUP__DIR__PATH . '/inc/designlib/sync_page.php' );
function levelup_load() {
	//Header Footer builder
	require_once( LEVELUP__DIR__PATH . '/inc/vendor/customizer-extra/header-builder.php' );

	if(is_admin()){
		require_once LEVELUP__FILE__PATH.'inc/composite-menu.php';
		require_once( LEVELUP__DIR__PATH . '/admin/admin-settings.php' );
	}
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
	require_once( LEVELUP__DIR__PATH . '/inc/image-aqua.php' );
	require_once( LEVELUP__DIR__PATH . '/levelup-widgets.php' );
	
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
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	$screen = get_current_screen();
	if($screen->id=='plugin-install' || ($screen->id=='toplevel_page_levelup' && isset($_GET['type']) && $_GET['type']=='dashboard' )){ return ; }

	if(!current_user_can('install_plugins')){
		return false;
	}
	/*	echo '<div class="notice notice-error">
	        <p>'.esc_html__('This plugin recommends ',LEVELUP_TEXT_DOMAIN).' <strong>'.esc_html__('Elementor plugin',LEVELUP_TEXT_DOMAIN).'</strong> 
            <a href="'.admin_url('admin.php?page=levelup').'" class="button button-primary">'.esc_html__('Click here to complete setup',LEVELUP_TEXT_DOMAIN).'</a></p>
	        </div>';*/
}

function levelup_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=levelup&type=dashboard' ) ) );
    }
}
add_action( 'activated_plugin', 'levelup_activation_redirect' );

register_activation_hook( __FILE__, 'levelup_activation_hook'); 
function levelup_activation_hook(){
	// Disable Elementor default settings
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );
}

function levelup_modify_main_query( $query ) {
	if ( (function_exists('ampforwp_is_front_page') && ampforwp_is_front_page()) 
		&& (function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint())
		&& $query->is_main_query()) { 
	 	$query-> set('post_type' ,'page');
		$query->set( 'page_id', ampforwp_get_frontpage_id() );
	}
}
function levelup_after_elementor_init(){
	add_action( 'pre_get_posts', 'levelup_modify_main_query');
}
add_action( 'elementor/init',  'levelup_after_elementor_init');