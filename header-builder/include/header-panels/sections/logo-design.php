<?php
namespace HeaderBuilder\headerPanels\sections;
class LogoDesign{
	public $name = 'Logo Design';
	public $id   = 'mysection';
	public $api_type = 'wp_section';
	public $panel = '';
	public $panelName = '';
	function __construct($panel,$panelName){
		$this->panel = $panel; 
		$this->panelName = $panelName; 
	}
	function getFields(){
		return array(
				array(
					'api_type'			=> 'wp_section',
					'id' 				=> 'mysection'. $this->panel,
			        'panel'    			=> $this->panel,
			        'panel_name'    	=> $this->panelName,
					'title'    			=> __($this->name, 'domain'),
			        'description' 		=> __('Section description which does show up', 'domain')
				),

				
				//settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'mysetting'. $this->panel,
					'capability'        => 'edit_theme_options',
					"default"			=> "Black",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'mysetting'. $this->panel,
			        'section' 			=> 'mysection'. $this->panel,
			        'label'   			=> __('Enter COlor', 'domain'),
			        'type'    			=> 'text'
			    ),

			);
	}

	function options(){

	}
}