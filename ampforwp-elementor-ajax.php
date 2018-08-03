<?php
//Ajax call
namespace AmpforwpElementorPlus;
class AmpforwpElementorPlusAjax{
	public function __construct(){

	}

	public $design_layout_markup;
	function init(){
		add_action( 'wp_ajax_elementor_plus_insert_data', [ $this, 'elementor_plus_insert_data'] );
		add_action( 'wp_ajax_nopriv_elementor_plus_insert_data', [ $this, 'elementor_plus_insert_data'] );
	}

	public function elementor_plus_insert_data(){
		$dir = ELEMENTOR_PLUS_DIR_PATH.'/layouts/design1-layout/';
		$responseData = array();
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {

		        while (($file = readdir($dh)) !== false) {
		        	
		        	if(is_file($dir.$file) && strpos($file, '-layout.php') == true){
		        		$responseData[str_replace("-layout.php", "", $file)] = include $dir.$file;
		        	}
		        }
		        closedir($dh);
		    }
		}

		





		$design_controls = 
									array(
										'id' => "1def",
										'elType'=> "widget",
										"settings" => array(
								                  "title" => "Our company is a collective of amazing people striving to build delightful products.",
								                  "align" => "center",
								                  "title_color"=> "#000000",
								                  "typography_typography"=> "custom",
								                  "typography_font_size"=> array(
											                    "unit"=> "px",
											                    "size"=> 45
											                 	),
								                  "typography_font_weight" => "600",
								                  "typography_line_height" => array(
								                    "unit"=> "em",
								                    "size"=> 1.4
								                  ),
								                  "typography_font_size_mobile" => array(
								                    "unit"=> "px",
								                    "size"=> 30
								                  ),
								                  "header_size"=> "h4",
								                  "_background_image"=> array(
								                    "url"=> "",
								                    "id"=> ""
								                  ),
								                  "_background_video_fallback"=> array(
								                    "url"=> "",
								                    "id"=> ""
								                  ),
								                  "_background_hover_image"=> array(
								                    "url"=> "",
								                    "id"=> ""
								                  ),
								                  "_background_hover_video_fallback"=> array(
								                    "url"=> "",
								                    "id"=> ""
								                  )
								                ),
										"elements"=> array(),
    									"widgetType" => "heading",
    									"htmlCache" => "\t\t<div class=\"elementor-element-overlay\">\n\t\t\t<ul class=\"elementor-editor-element-settings elementor-editor-widget-settings\">\n\t\t\t\t\t\t\t\t\t<li class=\"elementor-editor-element-setting elementor-editor-element-edit\" title=\"Edit\">\n\t\t\t\t\t\t<i class=\"eicon-edit\" aria-hidden=\"true\"><\/i>\n\t\t\t\t\t\t<span class=\"elementor-screen-only\">Edit<\/span>\n\t\t\t\t\t<\/li>\n\t\t\t\t\t\t\t<\/ul>\n\t\t<\/div>\n\t\t\t\t<div class=\"elementor-widget-container\">\n\t\t\t<h4 class=\"elementor-heading-title elementor-size-default elementor-inline-editing\" data-elementor-setting-key=\"title\">Our company is a collective of amazing people striving to build delightful products.<\/h4>\t\t<\/div>\n\t\t"
  						
						);

























		$responseData = array('content' => $design_controls);//$responseData['settings']);




























		$this->design_layout_markup = apply_filters("ampforwp_pagebuilder_modules_filter", $responseData);

		echo json_encode(array("status"=>200,'data'=>$this->design_layout_markup));
		wp_die();
	} 

}