<?php
namespace HeaderBuilder\footerPanels;

class footerPanels{
	public $configs = array();
	public $configs_builder = array();
	public $sectionsLoader = array('top-footer','bottom-footer', 'footer-sidebar1','footer-sidebar2', 'footer-sidebar3', 'footer-sidebar4', 'footer-sidebar5', 'footer-copyright', 'social-icon');
	public $designs = 	array(
						'design1',
						/*'design2',*/
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
			$path = HEADER_FOOTER_PLUGIN_PATH.'/include/footer-panels/sections/'.$designSettings.'.php';
			if(file_exists($path)){
				include_once $path;
			}
		}
		
		foreach ($this->designs as $key => $designSettings) {
			$path = HEADER_FOOTER_PLUGIN_PATH.'/include/footer-panels/designs/'.$designSettings.'.php';
			if(file_exists($path)){
				include_once $path;
				$className = '\footer_'.$designSettings;
				$designObject = new $className();
				$designPanel = $designObject->get_panel_config();
				if(method_exists($designObject,'render_css')){
					$this->designCss[$designSettings] = $designObject->render_css();
				}

				$SocialiconObj = new \HeaderBuilder\footerPanels\sections\SocialiconFooterDesign($designObject->panelId, $designPanel[0]['title']);
				$this->configs = array_merge($this->configs, $SocialiconObj->getFields());
				HeaderFooter_Customize_Layout_Builder()->register_item('footer', $SocialiconObj );

				$copyrightObj = new \HeaderBuilder\footerPanels\sections\footerCopyrightDesign($designObject->panelId, $designPanel[0]['title']);
				$this->configs = array_merge($this->configs, $copyrightObj->getFields());
				HeaderFooter_Customize_Layout_Builder()->register_item('footer', $copyrightObj );

				/*$footerSidebar1Obj = new \HeaderBuilder\footerPanels\sections\footerSidebar1Design($designObject->panelId, $designPanel[0]['title']);
				$this->configs = array_merge($this->configs, $footerSidebar1Obj->getFields());
				HeaderFooter_Customize_Layout_Builder()->register_item('footer', $footerSidebar1Obj );

				$footerSidebar2Obj = new \HeaderBuilder\footerPanels\sections\footerSidebar2Design($designObject->panelId, $designPanel[0]['title']);
				$this->configs = array_merge($this->configs, $footerSidebar2Obj->getFields());
				HeaderFooter_Customize_Layout_Builder()->register_item('footer', $footerSidebar2Obj );

				$footerSidebar3Obj = new \HeaderBuilder\footerPanels\sections\footerSidebar3Design($designObject->panelId, $designPanel[0]['title']);
				$this->configs = array_merge($this->configs, $footerSidebar3Obj->getFields());
				HeaderFooter_Customize_Layout_Builder()->register_item('footer', $footerSidebar3Obj );

				$footerSidebar4Obj = new \HeaderBuilder\footerPanels\sections\footerSidebar4Design($designObject->panelId, $designPanel[0]['title']);
				$this->configs = array_merge($this->configs, $footerSidebar4Obj->getFields());
				HeaderFooter_Customize_Layout_Builder()->register_item('footer', $footerSidebar4Obj );

				$footerSidebar5Obj = new \HeaderBuilder\footerPanels\sections\footerSidebar5Design($designObject->panelId, $designPanel[0]['title']);
				$this->configs = array_merge($this->configs, $footerSidebar5Obj->getFields());
				HeaderFooter_Customize_Layout_Builder()->register_item('footer', $footerSidebar5Obj );*/




				/*//Top settings
				$topDesignObj = new \HeaderBuilder\headerPanels\sections\TopDesign($designObject->panelId, $designPanel[0]['title']);
				$this->configs = array_merge($this->configs, $topDesignObj->getFields());*/
				
				//Bottom settings
				$bottomDesignObj = new \HeaderBuilder\headerPanels\sections\BottomDesign($designObject->panelId, $designPanel[0]['title']);
				$this->configs = array_merge($this->configs, $bottomDesignObj->getFields());

				$this->configs = array_merge($this->configs, $designPanel);
			}
			
		}
	}
	function config_options(){
		$this->include_files();
		$footerOptions =  array(
					array(
						'api_type'=> 'hf_panel',
						'id' => 'footer_panel',
						'title'=>esc_html__('Footer Builder Designs', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
						'description'   => esc_html__("This is the description which doesn't want to show up :(", HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
						'capability'    => 'edit_theme_options',
						'priority'      => 2
					),

					//Option to save 
					array(
						'api_type'			=> 'hf_section',
						'id' 				=> 'footer_setting_section',
				        'panel'    			=> 'footer_panel',
						'title'    			=> 'footer panel section',
						'description' 		=> '',
				        'display'			=> false
					),
					//settings
					array(
						'api_type'			=> 'wp_settings',
						'id'				=> 'footer_panel_settings',
						'capability'        => 'edit_theme_options',
						"default"			=> "",
				        'sanitize_callback' => 'header_footer_santizer',
				        'transport'			=> 'postMessage',
				        'name'				=> 'footer_panel_settings'
				    ),
				    //control
				    array(
				    	'api_type'			=> 'wp_control',
				    	'id'				=> 'footer_panel_settings',
				        'section' 			=> 'footer_setting_section',
				        'label'   			=> __('Enter Color', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
				        'type'    			=> 'js_raw',
				        'selector'          => '#footercaller',
				    ),
					
					
				);
		//print_r($footerOptions);die;
		$return = array_merge($footerOptions, $this->configs);
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
					$returnData[$panel]['devices'] = array("desktop"=>"Footer Layout",
													//"mobile"=>"Mobile/Tablet"
													);
					$returnData[$panel]['rows'] = array("bottom"=>"Header Bottom",
													//"top"=>"Header Top",
													//"sidebar"=>"Menu Sidebar",
													);
					$returnData[$panel]['settings'] = 'footer_panel_settings';
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