<?php
class footer_design1{
	public $config = array();
	public $panelId = 'footer-design1';
	public $previewImg = "/assets/img/footer-1.png";
	function config_deisgn(){
		$this->previewImg  = HEADER_FOOTER_PLUGIN_DIR_URI. $this->previewImg;
		$this->config = array(
			array(
				'api_type'		=> 'hf_panel',
				'id' 			=> $this->panelId,//change unique
				'panel'    		=> 'footer_panel',
				'title'         => esc_html__('Footer 1', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
		        'description'   => "<img src='".esc_url($this->previewImg)."'>".esc_html__("This is the description which doesn't want to show up", HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
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
				"default"			=> urldecode('%7B%22desktop%22:%7B%22top-footer-design%22:%5B%7B%22x%22:0,%22y%22:1,%22width%22:6,%22height%22:1,%22id%22:%22social-icon-footer-design1%22%7D,%7B%22x%22:6,%22y%22:1,%22width%22:6,%22height%22:1,%22id%22:%22copyright-footer-design1%22%7D%5D%7D,%22selected_design%22:%22footer-design1%22%7D'),
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