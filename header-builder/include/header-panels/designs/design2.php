<?php
class header_footer_design2{
	public $config = array();
	public $panelId = 'header-design2';
	public $previewImg = "http://localhost/magzine/wp/wp-content/uploads/2018/11/cropped-coffee-432-300x202.jpg";
	function config_deisgn(){
		$this->config = array(
			array(
				'api_type'		=> 'hf_panel',
				'id' 			=> $this->panelId,//change unique
				'panel'    		=> 'header_panel',
				'title'         => __('Second Design', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
		        'description'   => "<img src='".$this->previewImg."'>".__("This is the description which doesn't want to show up", HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
		         'previewImg'	=> $this->previewImg,
		        'capability'    => 'edit_theme_options',
		        'priority'      => 2
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

	function render(){

	}
}