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
				.nav-menu.desktop ul li{
					list-style-type: none;
					display: inline-block;
					margin-right: 20px;
					position: relative;
				}
				.scl-icns ul li{
					list-style-type: none;
					display: inline-block;
					margin-right:20px;
					font-size:18px;
				}
				.scl-icns ul li:last-child{
					margin-right:0px;
				}
				.nav-menu.desktop ul li a{
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
				.nav-menu.desktop ul li a:before {
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
				.nav-menu.desktop ul li a:hover:before, .nav-menu.desktop ul li a:focus:before, .nav-menu.desktop ul li a:active:before, .nav-menu ul li.active a:before {
				    right: 0;
				}
				.nav-menu.desktop ul li ul li a:before{
					content:"";
					position:relative;
				}
				.nav-menu.desktop li:hover > ul{
				    opacity: 1;
				    transform: translateY(0px);
				    visibility: visible;
				    transition: all 0.2s ease-in-out 0s;
				}
				.nav-menu.desktop li ul li{
				    display: block;
				    position: relative;
				    margin-right:0;
				    border-bottom: 1px solid #ddd;
    				padding: 0px 12px;
				}
				.nav-menu.desktop li ul li:last-child{
					border-bottom:none;
				}
				.nav-menu.desktop li ul li a{
					padding:5px 0px;
					font-size: 13px;
				}
				.nav-menu.desktop li ul li ul{
				    left: 100%;
				    top: 0;
				}
				.nav-menu.desktop .menu li.menu-item-has-children:after{
					content:">";
					display:inline-block;
					color: #000;
				    position: relative;
				    top: 2px;
				    padding-left: 3px;
				}
				.nav-menu.desktop li ul{
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
				.nav-menu.desktop .menu li.menu-item-has-children .sub-menu {
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
				    margin:0;
				}
				.scl-icns li a{
					line-height: 0;
					display:block;
					color:#000;
				}
				.nav-menu{
					margin-right: 25px;
				}
				.nav-menu.desktop ul{margin:0;}
				.nav-menu.desktop, .scl-icns{
					display: inline-block;
				    vertical-align: middle;
				}
				.sr{
					order:1;
					line-height: 0;
				}
				.cb-row--desktop .search-header{
					text-align:center;
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
				.sr span, .overlay-close span{
					font-size:18px;
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
				.headerfooter-site-header{
					position:relative;
					z-index:0;
				}
				.cb-row--mobile{margin:0;}
				.cb-row--mobile .logo-header .logo{
					text-align: left;
				}
				.cb-row--mobile .menu-icon-header{
					text-align: right;
				}

				/** sidebar css **/
				.header-menu-sidebar-bg {
				    position: relative;
				    word-wrap: break-word;
				    min-height: 100%;
				    display: block;
				}
				.header-menu-sidebar-bg:before {
				    content: "";
				    position: absolute;
				    top: 0;
				    bottom: 0;
				    left: 0;
				    right: 0;
				    display: block;
				    min-height: 100%;
				}
				.header-menu-sidebar .header-menu-sidebar-bg:before {
				    background: rgba(0,0,0,.9);
				}
				.is-menu-sidebar.menu_sidebar_slide_left .header-menu-sidebar {
				    z-index: 999900;
				    height: 100%;
				    -webkit-transform: translate3d(0,0,0);
				    transform: translate3d(0,0,0);
				    left: 0;
				    visibility: visible;
				}
				.is-menu-sidebar .header-menu-sidebar {
				    overflow: auto;
				}
				.menu_sidebar_slide_left .header-menu-sidebar {
				    width: auto;
				    right: 45px;
				}
				.header-menu-sidebar {
				    padding: 0;
				    position: fixed;
				    width: 100%;
				    max-width: 100%;
				    top: 0;
				    z-index: 999900;
				    visibility: hidden;
				}
				/** Footer CSS **/
				#site-footer{
					display: inline-flex;
				    flex-wrap: wrap;
				    width: 100%;
				    align-items: center;
				    justify-content: center;
				    border-top: 1px solid #ccc;
    				padding: 30px 0px;
				}
				.cp-right {
					font-size: 16px;
				    color: #333;
				    margin-right: 30px;
				    font-weight: 500;
				}


@media(max-width:1024px){
	.hamb-menu{
		display:block;
		float: right;
	    z-index: 999999;
	    position: relative;
	    padding: 0px 0px 0px 0px;
	    color:#000;
	}
	.mb-mnu{
		display:inline-block;
		width:100%;
	}
	.site, .menu-container {
		width:100%;
		height:100%;
	    overflow-x: hidden;
	}
	.toggle, .full-screen-close{
		display: none;
	}
	.full-screen-close{
		width: 100%;
		height: 100%;
		position: absolute;
		cursor: pointer;
		top:0;
		left:0;
	}
	.toggle:checked + .menu-overlay > .menu-container {
	  	margin-left: 0;
	}
	.toggle:checked + .menu-overlay .full-screen-close{
	  	display: block;
	  	background: rgba(0,0,0,.5);
	  	z-index:99;
	}

	.toggle-btn, .close-btn{
		cursor: pointer;
	}
	.toggle-btn{
		font-size:24px;
	}
	.close-btn{
		float: right;
		color: #ededed;
		font-size: 24px;
    	padding-right: 20px;
	}
	.menu-container, .content{
		transition: margin 0.3s ease-in-out;
	}
	.menu-container{
		background: #0C0C0C;
		width: 86%;
		margin-left: -86%;
		float: left;
		height: 100%;
		position: absolute;
		z-index:999;
	}
	.mobile{
		width:100%;
		display:inline-block;
		margin:0;
	}
	.mobile .menu-menu-container ul{
		margin:0;
		padding:0;
	}
	.mobile .menu-menu-container ul li{
		display:block;
		border-bottom: 1px solid transparent;
		border-color: rgba(255,255,255,.08);
		margin:0;
		position:relative;
	}
	.mobile .menu-menu-container ul li:last-child{
		border-bottom: none;
	}
	.mobile .menu-menu-container li a{
		color: #fff;
		padding: 7px 10px;
		font-size: 15px;
		line-height:1.4;
		font-weight: 500;
		display: block;
		transition: background-color .5s ease-in-out;
		display:inline-block;
		position:relative;
	}
	.nav-menu.mobile li.menu-item-has-children .sub-menu{
		display:none;
		padding-left: 20px;
	}
	.nav-menu.mobile li.menu-item-has-children:hover .sub-menu{
		display:block;
	}
	.nav-menu.mobile li.menu-item-has-children:after{
		content:">";
		display:inline-block;
		color:#fff;
		position:absolute;
		top:0;
		right:0;
		padding: 5px 10px;
	}
	.mobile .menu-menu-container li .sub-menu li a{
		font-size:13px;
	}
}
@media(max-width:500px){
	#site-footer {
    	display: inline-block;
    	text-align: center;
    }
    .cp-right{margin:0px 0px 20px 0px;}
}
				';

		$amp_css = '
			.customify-container{
				width:100%;
				display:inline-block;
			}
			.hide-on-mobile{
				display: flex;
				margin: 0 auto;
				width:1170px;
			}
			.search-header{
			    order: 1;
			}
			.social-icon-header{order:1;margin-left: 20px;}
			.screen-reader-text, .screen-reader-text span {
	    		position: absolute;
			    top: -10000em;
			    width: 1px; 
			    height: 1px;
			    margin: -1px;
			    padding: 0;
			    overflow: hidden;
			    clip: rect(0,0,0,0);
			    border: 0;
			}
			.sr{
				margin: 0px 20px
			}
			@media(max-width:1170px){
				.hide-on-mobile{width:100%;}
			}
			@media(max-width:1024px){
				.hide-on-mobile, .toggle.hide-on-desktop{display:none;}
				.hide-on-desktop{
					display:flex;
				}
				.menu-icon-header{flex-grow:1}
				.customify-grid-middle{padding:20px;}
				.mobile .menu-menu-container > ul {
				    margin: 0;
				    padding: 20px 0px 0px 10px;
				}

			}
		';
		$non_amp_css = '';

		$allcss['global_design_css'] = $css;
		$allcss['amp_css'] = $amp_css;
		$allcss['non_amp_css'] = $non_amp_css;
		return $allcss;
	}
}