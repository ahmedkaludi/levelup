<?php
namespace HeaderBuilder\footerPanels\sections;
class BottomFooterDesign{
	public $name = 'Footer bottom row settings';
	public $api_type = 'wp_section';
	public $panel = '';
	public $id = 'bottom-footer-design';
	public $panelName = '';
	function __construct($panel,$panelName){
		$this->panel = $panel; 
		$this->panelName = $panelName; 
	}
	function getFields(){
		return array(
				array(
					'api_type'			=> 'wp_section',
					'id' 				=> $this->id. $this->panel,
			        'panel'    			=> $this->panel,
			        'panel_name'    	=> $this->panelName,
					'title'    			=> esc_html__($this->name, HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'description' 		=> esc_html__($this->name.' description get footer options', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN)
				),

				
				//settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'height-'.$this->panel. $this->id,
					'capability'        => 'edit_theme_options',
					"default"			=> "85px",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'height-'.$this->panel. $this->id,
			        'section' 			=> $this->id. $this->panel,
			        'label'   			=> esc_html__('Height', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),

			);
	}

	function options(){

	}
	function render_css(){
		$height = headerfooter_get_setting('height-'.$this->panel. $this->id);
		return '.header-top {
				    min-height: '.$height.'px;
				}';
	}
}