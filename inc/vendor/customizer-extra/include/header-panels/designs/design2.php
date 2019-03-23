<?php
class header_footer_design2{
	public $config = array();
	public $panelId = 'header-design2';
	public $previewImg = "/assets/img/d1.jpg";
	function config_deisgn(){
		$this->previewImg  = HEADER_FOOTER_PLUGIN_DIR_URI. $this->previewImg;
		$this->config = array(
			array(
				'api_type'		=> 'hf_panel',
				'id' 			=> $this->panelId,//change unique
				'panel'    		=> 'header_panel',
				'title'         => esc_html__('Second Design', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
		        'description'   => "<img src='".esc_url($this->previewImg)."'>".esc_html__("This is the description which doesn't want to show up", HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
		         'previewImg'	=> $this->previewImg,
		        'capability'    => 'edit_theme_options',
		        'priority'      => 2
			),




			//Option to save 
			array(
				'api_type'			=> 'wp_section',
				'id' 				=> 'header_setting_config_'.$this->panelId,
		        'panel'    			=> $this->panelId,
				'title'    			=> 'header section config',
		        'description' 		=> '',
		        'exclude_section'	=> true,
 		        'display'			=> false
			),

			//settings
			array(
				'api_type'			=> 'wp_settings',
				'id'				=> 'config-settings-'.$this->panelId,
				'capability'        => 'edit_theme_options',
				"default"			=> '{"desktop":{"top":[{"x":0,"y":1,"width":12,"height":1,"id":"html-header-design2"}],"main":[{"x":1,"y":1,"width":3,"height":1,"id":"logo-header-design2"},{"x":8,"y":1,"width":4,"height":1,"id":"menu-icon-header-design2"}],"bottom":[]},"mobile":{"top":[{"x":0,"y":1,"width":12,"height":1,"id":"html-header-design2"}],"main":[{"x":6,"y":1,"width":4,"height":1,"id":"social-icon-header-design2"},{"x":0,"y":1,"width":3,"height":1,"id":"logo-header-design2"},{"x":10,"y":1,"width":2,"height":1,"id":"menu-icon-header-design2"}],"bottom":[],"sidebar":[]},"selected_design":"header-design2"}',
		        'sanitize_callback' => 'header_footer_santizer',
		        'transport'			=> 'postMessage'
		    ),
		    //control
		    array(
		    	'api_type'			=> 'wp_control',
		    	'id'				=> 'config-settings-'.$this->panelId,
		        'section' 			=> 'header_setting_config_'.$this->panelId,
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
				$panel = $value['panel'];
				$sections[$id] = array(
									"name"	=> $title,
									"id"	=> $id,
									"width" => "4",
									"section" => "section".$panel,
								);
			}
		}

		return $sections;
	}

	function default_data(){
		$jsonArray = '';
		return json_decode($jsonArray,true);
	}
	function render_css(){
		$amp_css = '';
		$non_amp_css = '';
		$css = '';

		$allcss['global_design_css'] = $css;
		$allcss['amp_css'] = $amp_css;
		$allcss['non_amp_css'] = $non_amp_css;
		return $allcss;
	}
}