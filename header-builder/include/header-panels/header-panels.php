<?php
namespace HeaderBuilder\headerPanels;

class headerPanels{
	public $configs = array();
	public $configs_builder = array();
	public $sectionsLoader = array('top-header', 'middle-header','bottom-header', 'sidebar-design','logo-design', 'menu-icon','menu', 'html', 'social-icon');
	public $designs = 	array(
						'design1',
						'design2',
					);
	public $designCss = array();
	function __construct(){
		$this->include_files();
		//if(is_admin()){
			add_action( 'wp_head', array($this, 'design_style_action') );
		//}
	}

	function design_style_action(){
		?><style type="text/css">
             <?php 
             if(is_array($this->designCss)){
             	foreach ($this->designCss as $key => $value) {
             		echo $value;
             	}
             }else{
             	echo $this->designCss;
             }
             ?>
         </style><?php
     
	}

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
				if(method_exists($designObject,'render_css')){
					$this->designCss[$designSettings] = $designObject->render_css();
				}
				$modules = array();

				$modules['logoObj'] = new \HeaderBuilder\headerPanels\sections\LogoDesign($designObject->panelId, $designPanel[0]['title']);
				$modules['menuiconObj'] = new \HeaderBuilder\headerPanels\sections\MenuIconDesign($designObject->panelId, $designPanel[0]['title']);
				$modules['menuObj'] = new \HeaderBuilder\headerPanels\sections\MenuDesign($designObject->panelId, $designPanel[0]['title']);
				$modules['htmlObj'] = new \HeaderBuilder\headerPanels\sections\HtmlDesign($designObject->panelId, $designPanel[0]['title']);
				$modules['SocialiconObj'] = new \HeaderBuilder\headerPanels\sections\SocialiconDesign($designObject->panelId, $designPanel[0]['title']);
				//Top settings
				$modules['topDesignObj'] = new \HeaderBuilder\headerPanels\sections\TopDesign($designObject->panelId, $designPanel[0]['title']);
				//Middle settings
				$modules['middleDesignObj'] = new \HeaderBuilder\headerPanels\sections\MiddleDesign($designObject->panelId, $designPanel[0]['title']);
				//Bottom settings
				$modules['bottomDesignObj'] = new \HeaderBuilder\headerPanels\sections\BottomDesign($designObject->panelId, $designPanel[0]['title']);
				//Sidebar settings
				$modules['SidebarDesignObj'] = new \HeaderBuilder\headerPanels\sections\SidebarDesign($designObject->panelId, $designPanel[0]['title']);
				
				foreach ($modules as $key => $value) {
					$this->configs = array_merge($this->configs, $value->getFields());
					if(!in_array($key, array('topDesignObj','middleDesignObj','bottomDesignObj','SidebarDesignObj'))
					){
						HeaderFooter_Customize_Layout_Builder()->register_item('header', $value );
					}
					if(method_exists($value,'render_css')){
						$this->designCss[$key] = $value->render_css();
					}
				}

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

					//Option to save 
					array(
						'api_type'			=> 'hf_section',
						'id' 				=> 'header_setting_section',
				        'panel'    			=> 'header_panel',
						'title'    			=> 'header panel section',
				        'description' 		=> '',
				        'display'			=> false
					),
					//settings
					array(
						'api_type'			=> 'wp_settings',
						'id'				=> 'header_panel_settings',
						'capability'        => 'edit_theme_options',
						"default"			=> "",
				        'sanitize_callback' => 'sanitize_text_field',
				        'transport'			=> 'postMessage',
				        'name'				=> 'header_panel_settings'
				    ),
				    //control
				    array(
				    	'api_type'			=> 'wp_control',
				    	'id'				=> 'header_panel_settings',
				        'section' 			=> 'header_setting_section',
				        'label'   			=> __('Enter COlor', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
				        'type'    			=> 'js_raw',
				        'selector'          => '#headercaller',
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
				$width = isset($value['width'])? $value['width']  : 4;
				
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
					$returnData[$panel]['settings'] = 'header_panel_settings';
				}
				
				if(
					strpos('top-header-design'.$panel, $sectionid)===false &&
					strpos('middle-header-design'.$panel, $sectionid)===false &&
					strpos('bottom-header-design'.$panel, $sectionid)===false &&
					strpos('sidebar-header-design'.$panel, $sectionid)===false 
				){
					$returnData[$panel]['items'][$sectionid] = array(
										"name"	=> $title,
										"id"	=> $sectionid,
										"col"	=>	0,
										"width" => $width,
										"section" => $sectionid,
									);
				}
			}
		}

		return $returnData;
	}

	function panel_design_options(){
		$this->include_files();
		$designs = array();
		foreach ($this->configs as $key => $value) {
			if($value['api_type']=='hf_panel'){
				$id = $value['id'];
				$designs[] = array('previewImg' => $value['previewImg'],
									'id' => $id);
			}
		}
		return $designs;
	}
}