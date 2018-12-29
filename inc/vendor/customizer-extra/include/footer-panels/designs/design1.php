<?php
class footer_design1{
	public $config = array();
	public $panelId = 'footer-design1';
	public $previewImg = "http://localhost/magzine/wp/wp-content/uploads/2018/11/cropped-coffee-432-300x202.jpg";
	function config_deisgn(){
		$this->config = array(
			array(
				'api_type'		=> 'hf_panel',
				'id' 			=> $this->panelId,//change unique
				'panel'    		=> 'footer_panel',
				'title'         => __('1st Footer Design', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
		        'description'   => "<img src='".$this->previewImg."'>".__("This is the description which doesn't want to show up", HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
		        'previewImg'	=> $this->previewImg,
		        'capability'    => 'edit_theme_options',
		        'class'			=> 'design-panels',
		        'priority'      => 2
			),



			//Option to save 
			array(
				'api_type'			=> 'wp_section',
				'id' 				=> 'footer_setting_config_'.$this->panelId,
		        'panel'    			=> $this->panelId,
				'title'    			=> 'Footer section config',
		        'description' 		=> '',
		        'exclude_section'	=> true,
			),

			//settings
			array(
				'api_type'			=> 'wp_settings',
				'id'				=> 'config-settings-'.$this->panelId,
				'capability'        => 'edit_theme_options',
				"default"			=> '{"desktop":{"top-footer-design":[{"x":"0","y":"1","width":"6","height":"1","id":"social-icon-footer-design1"},{"x":"6","y":"1","width":"6","height":"1","id":"copyright-footer-design1"}]},"selected_design":"footer-design1"}',
				"preset_default"	=> True,
		        'sanitize_callback' => 'header_footer_santizer',
		        'transport'			=> 'postMessage'
		    ),
		    //control
		    array(
		    	'api_type'			=> 'wp_control',
		    	'id'				=> 'config-settings-'.$this->panelId,
		        'section' 			=> 'footer_setting_config_'.$this->panelId,
		        'label'   			=> esc_html__('Enter Design1 config', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
		        'type'    			=> 'js_raw'
		    ),
		);
		

	}//function config_deisgn closed

	function get_panel_config(){
		$this->config_deisgn();
		return $this->config;
	}

	function get_builder_config(){
		$this->config_deisgn();
		$sections = array();

		foreach ($this->config as $key => $value) {
			if($value['api_type']=='wp_section'){
				$id = $value['id'];
				$title = $value['title'];
				$sections[$id] = array(
									"name"	=> $title,
									"id"	=> $id,
									"width" => "4",
									"section" => "footer_html",
								);
			}
		}

		return $sections;
	}

	function render_css(){
		$css = '


				';
		return $css;
	}
}