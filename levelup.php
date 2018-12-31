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
define( 'LEVELUP_ENVIRONEMT', 'development' );//production
define( 'LEVELUP_VERSION', '0.0.1' );//development


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
	//importer
	require_once( LEVELUP__DIR__PATH . '/inc/vendor/importer/levelup_importer.php' );

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
	if($screen->id=='plugin-install'){ return ; }

	if(!current_user_can('install_plugins')){
		return false;
	}
    $plugin_base_name = 'elementor/elementor.php';
    $plugin_slug      = 'elementor';
    $plugin_filename  = 'elementor.php';
    $plugin_title     = __('Levelup', LEVELUP_TEXT_DOMAIN);

    $links_attrs = array(
        'class'                 => array( 'button', 'button-primary', 'elementor-install-now', 'elementor-not-installed' ),
        'data-plugin-slug'      => $plugin_slug,

        'data-activating-label' => __('Activating ..', LEVELUP_TEXT_DOMAIN),
        'data-activate-url'     => levelup_dependencies_get_plugin_activation_link( $plugin_base_name, $plugin_slug, $plugin_filename ),
        'data-activate-label'   => sprintf( __('Activate %s', LEVELUP_TEXT_DOMAIN), $plugin_title ),

        'data-install-url'      => levelup_dependencies_get_plugin_install_link( $plugin_slug ),
        'data-install-label'    => sprintf( __('Install %s', LEVELUP_TEXT_DOMAIN ), $plugin_title ),

        'data-redirect-url'     => self_admin_url( 'admin.php?page=levelup' )
    );

    $installed_plugins  = get_plugins();

    if( ! isset( $installed_plugins[ $plugin_base_name ] ) ){
        $links_attrs['data-action'] = 'install';
        $links_attrs['href'] = $links_attrs['data-install-url'];
        $button_label = sprintf( esc_html__( 'Install %s', LEVELUP_TEXT_DOMAIN ), $plugin_title );
    } elseif( ! levelup_is_plugin_active( $plugin_base_name ) ) {
        $links_attrs['data-action'] = 'activate';
        $links_attrs['href'] = $links_attrs['data-activate-url'];
        $button_label = sprintf( esc_html__( 'Activate %s Plugin', LEVELUP_TEXT_DOMAIN), $plugin_title );
    } else {
        return;
    }


	echo '<div class="notice notice-error">
	        <p>!'.esc_html__('Ohh, This plugin requires ',LEVELUP_TEXT_DOMAIN).' <br/><strong>'.esc_html__('Elementor',LEVELUP_TEXT_DOMAIN).'</strong> '.(', please Inatall & Acvtivate Elementor plugin ').' <a '. levelup_dependencies_make_html_attributes( $links_attrs ) .' class="button button-primary">'.esc_html__($button_label,LEVELUP_TEXT_DOMAIN).'</a></p>
	        </div>';
}
function levelup_dependencies_get_plugin_install_link( $plugin_slug ){

    // sanitize the plugin slug
    $plugin_slug = esc_attr( $plugin_slug );

    $install_link  = wp_nonce_url(
        add_query_arg(
            array(
                'action' => 'install-plugin',
                'plugin' => $plugin_slug,
            ),
            network_admin_url( 'update.php' )
        ),
        'install-plugin_' . $plugin_slug
    );

    return $install_link;
}
function levelup_dependencies_get_plugin_activation_link( $plugin_base_name, $slug, $plugin_filename ) {
    $activate_nonce = wp_create_nonce( 'activate-plugin_' . $slug .'/'. $plugin_filename );
    return self_admin_url( 'plugins.php?_wpnonce=' . $activate_nonce . '&action=activate&plugin='. str_replace( '/', '%2F', $plugin_base_name ) );
}

function levelup_dependencies_make_html_attributes( $attrs = array() ){
    if( ! is_array( $attrs ) ){
        return '';
    }
    $attributes_string = '';
    foreach ( $attrs as $attr => $value ) {
        $value = is_array( $value ) ? join( ' ', array_unique( $value ) ) : $value;
        $attributes_string .= sprintf( '%s="%s" ', $attr, esc_attr( trim( $value ) ) );
    }
    return $attributes_string;
}

function levelup_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=levelup&type=dashboard' ) ) );
    }
}
add_action( 'activated_plugin', 'levelup_activation_redirect' );


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

 