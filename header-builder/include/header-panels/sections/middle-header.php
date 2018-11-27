<?php
namespace HeaderBuilder\headerPanels\sections;
class MiddleDesign{
	public $name = 'Middle header settings';
	public $api_type = 'wp_section';
	public $panel = '';
	public $id = 'middle-header-design';
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
					'title'    			=> __($this->name, HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'description' 		=> __($this->name.' description which does show up', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN)
				),

				
				//settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'color-'.$this->panel. $this->id,
					'capability'        => 'edit_theme_options',
					"default"			=> "Black",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'color-'.$this->panel. $this->id,
			        'section' 			=> $this->id. $this->panel,
			        'label'   			=> __('Enter COlor', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),

			);
	}

	function options(){

	}
}