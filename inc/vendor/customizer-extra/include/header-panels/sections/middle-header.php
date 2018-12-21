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
		add_filter('header_footer/builder/inner-row-classes', array($this, 'printAddedClass'),10, 3);
	}
	function printAddedClass($inner_class, $row_id, $thisobj){
		$class = headerfooter_get_setting( 'id-'.$this->panel. $this->id);
		if($inner_class){
			$inner_class[] = $class;
		}
		return $inner_class;
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
					'id'				=> 'height-'.$this->panel. $this->id,
					'capability'        => 'edit_theme_options',
					"default"			=> "60px",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'height-'.$this->panel. $this->id,
			        'section' 			=> $this->id. $this->panel,
			        'label'   			=> __('Height', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),
			    //settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'backgroundcolor-'.$this->panel. $this->id,
					'capability'        => 'edit_theme_options',
					"default"			=> "gray",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'backgroundcolor-'.$this->panel. $this->id,
			        'section' 			=> $this->id. $this->panel,
			        'label'   			=> __('Enter Color', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),

			);
	}

	function options(){

	}
}