<?php
/*
Plugin Name: Header Builder
Plugin URI: https://wordpress.org/plugins/accelerated-mobile-pages/
Description: AMP for WP - Accelerated Mobile Pages for WordPress
Version: 0.1
Author: Ahmed Kaludi, Mohammed Kaludi
Author URI: https://ampforwp.com/
Donate link: https://www.paypal.me/Kaludi/25
License: GPL2+
Text Domain: header-builder
Domain Path: /languages/
*/


define('HEADER_FOOTER_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('HEADER_FOOTER_PLUGIN_DIR_URI', plugin_dir_url(__FILE__));
define('HEADER_FOOTER_PLUGIN_PATH_INCLUDE', HEADER_FOOTER_PLUGIN_PATH.'/include/');
define('HEADER_FOOTER_PLUGIN_VERSION', '1.0');
define('HEADER_FOOTER_PLUGIN_TEXT_DOMAIN', 'header-builder');

require_once(HEADER_FOOTER_PLUGIN_PATH_INCLUDE.'/builder.php');

function initiateHeaderBuilder(){
	$object = \HeaderBuilder\HeaderBuild::get_instance();
	$object->init();
}

initiateHeaderBuilder();