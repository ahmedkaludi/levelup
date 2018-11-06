<?php
namespace HeaderBuilder\headerPanels;

class headerPanels{
	public $configs = array();
	public $configs_builder = array();
	public $sectionsLoader = array('logo-design',);
	public $designs = 	array(
						'design1',
						'design2',
					);
	function include_files(){
		if(!empty($this->configs)){return ; }
		foreach ($this->sectionsLoader as $key => $designSettings) {
			$path = HEADER_FOOTER_PLUGIN_PATH.'/include/header-panels/sections/'.$designSettings.'.php';
			if(file_exists($path)){
				include_once $path;
			}
		}
		
		foreach ($this->designs as $key => $designSettings) {
			$path = HEADER_FOOTER_PLUGIN_PATH.'/include/header-panels/designs/'.$designSettings.'.php';
			if(file_exists($path)){
				include_once $path;
				$className = '\header_footer_'.$designSettings;
				$designObject = new $className();
				$designPanel = $designObject->get_panel_config();

				$logoObj = new \HeaderBuilder\headerPanels\sections\LogoDesign($designObject->panelId, $designPanel[0]['title']);
				$this->configs = array_merge($this->configs, $logoObj->getFields());


				$this->configs = array_merge($this->configs, $designPanel);
			}
			
		}
	}
	function config_options(){
		$this->include_files();
		$headerOptions =  array(
					array(
						'api_type'=> 'hf_panel',
						'id' => 'header_panel',
						'title'=>esc_html__('Header Builder Designs', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
						'description'   => esc_html__("This is the description which doesn't want to show up :(", HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
						'capability'    => 'edit_theme_options',
						'priority'      => 2
					),
				);
		$return = array_merge($headerOptions, $this->configs);
		return $return;
	}

	function panel_builder_options(){
		$this->include_files();
		$sendPanelBuilderData = array();
		$panel = $returnData = array();
		foreach ($this->configs as $key => $value) {
			
			if($value['api_type']=='wp_section'){
				$sectionid = $value['id'];
				$title = $value['title'];
				$panel = $value['panel'];
				$panel_name = $value['panel_name'];
				
				if(!isset($returnData[$panel])){
					$returnData[$panel] = array(
										"control_id"=> $panel,
										"section"	=> $panel,
										"id"		=> $panel,
										"panel"		=> $panel,
										"title"		=> $panel_name,
											);
					$returnData[$panel]['devices'] = array("desktop"=>"Desktop",
													"mobile"=>"Mobile/Tablet"
													);
					$returnData[$panel]['rows'] = array("bottom"=>"Header Bottom",
													"main"=>"Header Main",
													"sidebar"=>"Menu Sidebar",
													"top"=>"Header Top"
													);
				}
				
				$returnData[$panel]['items'][$sectionid] = array(
									"name"	=> $title,
									"id"	=> $sectionid,
									"col"	=>	0,
									"width" => "4",
									"section" => "header_html",
								);
			}
		}

		return $returnData;
	}
}