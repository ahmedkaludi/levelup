<?php
class header_footer_design1{
	public $config = array();
	public $panelId = 'header-design1';
	public $previewImg = "/assets/img/d1.jpg";
	function config_deisgn(){
		$this->previewImg  = HEADER_FOOTER_PLUGIN_DIR_URI. $this->previewImg;
		$this->config = array(
			array(
				'api_type'		=> 'hf_panel',
				'id' 			=> $this->panelId,//change unique
				'panel'    		=> 'header_panel',
				'title'         => __('First Design', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
		        'description'   => "<img src='".$this->previewImg."'>".__("This is the description which doesn't want to show up", HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
		        'previewImg'	=> $this->previewImg,
		        'capability'    => 'edit_theme_options',
		        'class'			=> 'design-panels',
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
				"default"			=> '{"desktop":{"top":[{"x":0,"y":1,"width":12,"height":1,"id":"html-header-design1"}],"main":[{"x":1,"y":1,"width":3,"height":1,"id":"logo-header-design1"},{"x":8,"y":1,"width":4,"height":1,"id":"menu-icon-header-design1"}],"bottom":[]},"mobile":{"top":[{"x":0,"y":1,"width":12,"height":1,"id":"html-header-design1"}],"main":[{"x":6,"y":1,"width":4,"height":1,"id":"social-icon-header-design1"},{"x":0,"y":1,"width":3,"height":1,"id":"logo-header-design1"},{"x":10,"y":1,"width":2,"height":1,"id":"menu-icon-header-design1"}],"bottom":[],"sidebar":[]},"selected_design":"header-design1"}',
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
				$sections[$id] = array(
									"name"	=> $title,
									"id"	=> $id,
									"width" => "4",
									"section" => "header_html",
								);
			}
		}

		return $sections;
	}

	function render_css(){
		$css = '.customify-grid-middle{
					flex-wrap: wrap;
					align-items: center;
					width:100%;
					padding: 38px 0px;
				}
				.nav-menu ul li{
					list-style-type: none;
					display: inline-block;
					margin-right: 20px;
					position: relative;
				}
				.scl-icns ul li{
					list-style-type: none;
					display: inline-block;
					margin-right:20px;
				}
				.scl-icns{margin-right:20px;}
				.scl-icns ul li:last-child a img{
					width:20px;
				}
				.nav-menu ul li a{
					text-decoration: none;
					font-size: 14px;
					font-weight: 600;
					line-height: 1.8;
					color:#333;
				    display: inline-block;
				    vertical-align: middle;
				    transform: perspective(1px) translateZ(0);
				    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
				    position: relative;
				    overflow: hidden;
				    transition:all 0.3s ease-in-out 0s;
				}
				.nav-menu ul li a:before {
				    content: "";
				    position: absolute;
				    z-index: -1;
				    left: 0;
				    right: 100%;
				    bottom: 0;
				    background: #333;
				    height: 2px;
				    transition-property: right;
				    transition-duration: 0.3s;
				    transition-timing-function: ease-out;
				}
				.nav-menu ul li a:hover:before, .nav-menu ul li a:focus:before, .nav-menu ul li a:active:before, .nav-menu ul li.active a:before {
				    right: 0;
				}
				.nav-menu ul li ul li a:before{
					content:"";
					position:relative;
				}
				.nav-menu li:hover > ul{
				    opacity: 1;
				    transform: translateY(0px);
				    visibility: visible;
				    transition: all 0.2s ease-in-out 0s;
				}
				.nav-menu li ul li{
				    display: block;
				    position: relative;
				    margin-right:0;
				    border-bottom: 1px solid #ddd;
    				padding: 0px 12px;
				}
				.nav-menu li ul li:last-child{
					border-bottom:none;
				}
				.nav-menu li ul li a{
					padding:5px 0px;
					font-size: 13px;
				}
				.nav-menu li ul li ul{
				    left: 100%;
				    top: 0;
				}
				.nav-menu .menu li.menu-item-has-children:after{
					content:">";
					display:inline-block;
					color: #000;
				    position: relative;
				    top: 2px;
				    padding-left: 3px;
				}
				.nav-menu li ul{
				    background: #ffffff none repeat scroll 0 0;
				    left: 0;
				    min-width: 200px;
				    opacity: 0;
				    position: absolute;
				    top: 100%;
				    transform: translateY(15px);
				    transition: all 0.3s ease-in-out 0s;
				    visibility: hidden;
				    text-align:left;
				    box-shadow:1px 1px 10px 1px #c7c7c7;
				}
				.nav-menu .menu li.menu-item-has-children .sub-menu {
				    display: block;	    
    				text-align: left;
    				padding:5px 0;
    				z-index: 1;
				}
				.nav-rt{
					width:100%;
					text-align:right;
				}
				.builder-first--menu-header-design1{
					flex-grow: 1;
				    order: 1;
				    text-align: right;
				}
				.scl-icns ul{
					display: flex;
				    line-height: 0;
				    align-items: center;
				}
				.scl-icns li a{
					line-height: 0;
					display:block;
				}
				.nav-menu{
					margin-right: 25px;
				}
				.nav-menu ul{margin:0;}
				.nav-menu, .scl-icns{
					display: inline-block;
				    vertical-align: middle;
				}
				.sr{
					order:1;
					line-height: 0;
				}
				.sr button{
					background:transparent;
					border:none;
					padding:0;
				}
				.header-bg{
					background:#f8f7f8;
					width:100%;
				}

				.overlay {
					position: fixed;
					width: 100%;
					height: 40%;
					top: 0;
					left: 0;
					background: #eee;
				}
				.ov-form {
				    position: relative;
				    width: 90%;
				    margin: 0 auto;
				    padding-top: 40px;
				}
				.overlay .overlay-close {
					position: absolute;
				    right: 15px;
				    top: 70px;
				    background: #ddd;
				    border: navajowhite;
				    padding: 11px;
				    border-radius: 50px;
				    line-height: 0;
				}
				/*.overlay .overlay-close:hover{

				}*/
				.overlay-slidedown {
					visibility: hidden;
					transform: translateY(-100%);
					transition: transform 0.4s ease-in-out, visibility 0s 0.4s;
				}
				.overlay-slidedown.open {
					visibility: visible;
					transform: translateY(0%);
					transition: transform 0.4s ease-in-out;
				}
				.overlay form input{
					border: none;
				    padding: 10px;
				    background: transparent;
				    border-bottom: 3px solid #000;
				    width: 100%;
				    font-size: 70px;
				    font-weight: 700;
				    color: #000;
				    padding-right:70px;
				}
				.sr-txt{
					font-size: 16px;
				    font-weight: 500;
				    margin-top: 20px;
				    display: inline-block;
				}

				/** Hamberger Menu CSS **/
				
				';
		return $css;
	}
}