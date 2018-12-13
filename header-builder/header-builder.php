<?php

define('HEADER_FOOTER_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('HEADER_FOOTER_PLUGIN_DIR_URI', plugin_dir_url(__FILE__));
define('HEADER_FOOTER_PLUGIN_PATH_INCLUDE', HEADER_FOOTER_PLUGIN_PATH.'/include/');
define('HEADER_FOOTER_PLUGIN_TEXT_DOMAIN', 'header-builder');
$levelup_head_started = $levelup_foot_started = false;
$levelupDefaultOptions = array();




require_once(HEADER_FOOTER_PLUGIN_PATH_INCLUDE.'/frontend/class-customize-layout-builder-frontend.php');
require_once(HEADER_FOOTER_PLUGIN_PATH_INCLUDE.'/frontend/class-customize-layout-builder.php');
require_once(HEADER_FOOTER_PLUGIN_PATH_INCLUDE.'/builder.php');
require_once(HEADER_FOOTER_PLUGIN_PATH_INCLUDE.'/utill-functions.php');

function HeaderFooter_Customize_Layout_Builder_Frontend() {
    return HeaderFooter_Customize_Layout_Builder_Frontend::get_instance();
}
function HeaderFooter_Customize_Layout_Builder() {
    return HeaderFooter_Customize_Layout_Builder::get_instance();
}

add_action('after_setup_theme', function(){
 add_action("levelup_head", "render_header_option_html");
 add_action("levelup_foot", "render_footer_option_html");

});

function render_footer_option_html(){
    global $levelup_foot_started;
    $levelup_foot_started = true;
    echo '<footer class="site-footer" id="site-footer">';
    HeaderFooter_Customize_Layout_Builder_Frontend()->set_id( 'footer' );
    HeaderFooter_Customize_Layout_Builder_Frontend()->set_control_id( 'footer_panel_settings' );
    $list_items = HeaderFooter_Customize_Layout_Builder()->get_builder_items( 'footer' );
    HeaderFooter_Customize_Layout_Builder_Frontend()->set_config_items( $list_items );
    HeaderFooter_Customize_Layout_Builder_Frontend()->render();


    echo '</footer>';
}

 function render_header_option_html(){
    global $levelup_head_started;
    $levelup_head_started = true;
   echo HeaderFooter_Customize_Layout_Builder_Frontend()->close_icon( ' close-panel close-sidebar-panel' );
    /**
     * Hook before header
     * @since 0.2.2
     */
    do_action( 'customizer/before-header' );
    echo '<header id="headerfooter-masthead" class="headerfooter-site-header">';
        echo '<div id="headerfooter-masthead-inner" class="headerfooter-site-header-inner">';
            $list_items = HeaderFooter_Customize_Layout_Builder()->get_builder_items( 'header' );
            HeaderFooter_Customize_Layout_Builder_Frontend()->set_config_items( $list_items );
            HeaderFooter_Customize_Layout_Builder_Frontend()->render();
            HeaderFooter_Customize_Layout_Builder_Frontend()->render_mobile_sidebar();
        echo '</div>';
    echo '</header>';
 }

 function levelup_check_hf_builder($type="head"){
    global $levelup_head_started, $levelup_foot_started;
    switch($type){
        case 'head':
            return $levelup_head_started;
        break;
        case 'foot':
            return $levelup_foot_started;
        break;
    }
    return false;
 }

function initiateHeaderBuilder(){
	$object = \HeaderBuilder\HeaderBuild::get_instance();
	$object->init();
}

initiateHeaderBuilder();


