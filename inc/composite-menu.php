<?php
Class levelup_menuConnector{
	function init(){
		add_action('admin_menu', array($this,'register_levelup_menu_page'));
		add_action('wp_ajax_levelup_send_query_message', array($this,'levelup_send_query_message'));
		add_action( 'wp_ajax_levelup_enable_modules_upgread', array($this,'levelup_enable_modules_upgread') );
	}
	//Common functions
	private function check_update_available(){
		$server_version = get_option( 'levelup-library-version');
	    $current_version = get_option( 'levelup-library-loaded-version');
	    // echo $current_version.", ".$server_version;die;
	    if(version_compare($current_version, $server_version, '<') ){
	    	return $server_version;
	    }
		return false;
	}
	function register_levelup_menu_page() {
		$settings = get_option('levelup_library_settings');
		$availableUpdateHtml = '';
		if(isset($settings['api_status']) && $settings['api_status']=='valid' && $this->check_update_available()){
			$availableUpdateHtml = '<span class="update-plugins count-1"><span class="update-count" title="">'.esc_html__( '1', LEVELUP_TEXT_DOMAIN ).'</span></span>';
		}
		$menu_label = sprintf( esc_html__( 'LevelUp ', LEVELUP_TEXT_DOMAIN)." %s",  $availableUpdateHtml);
		global $submenu;
	    add_menu_page(
	    		'Level Settings',
	    		$menu_label,
	    		'manage_options',
	    		'levelup',//slug
	    		array($this, 'LevelupSettings'), 
	    		'dashicons-star-filled', 
	    		2
	    	); 
	    add_submenu_page( 'levelup', 'Level Settings', 'Settings', 'manage_options', 'levelup', array($this, 'LevelupSettings') );
	    $submenu['levelup'][] = array('Customizer', 'customize', admin_url( 'customize.php' ));
	}

	function LevelupSettings(){
		$type = $_GET['type'];
		if(empty($type)){ $type = 'dashboard'; }
		ob_start();
		switch($type){
			case 'dashboard':
				echo '
                <div class="levelup_dashboard">
                    <div class="levelup_dashboard_left">
                        <h2>Learn</h2>
                        <iframe width="400" height="225" src="https://www.youtube.com/embed/fnlzOHECEDo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <h4>Learn deeper:</h4>
                        <div class="levelup_dashboard_left_sub">
                           <ul>
                           <li><a href="#">Watch Videos</a></li>
                           <li><a href="#">Read Documentation</a></li>
                           </ul>
                        </div>
                    </div>
                    <div class="levelup_dashboard_right">
                        <h2>Start with a Template</h2>
                        <p>Save time by choosing among beautiful templates designed for different sectors and purposes.</p>
                        <a href="'.esc_url(admin_url( $path = 'admin.php?page=levelup&type=template' )).'" class="button button-primary">Import a Template</a>
                    </div>
                    <div class="cb"></div>
                </div>
                ';
			break;			
			case 'options':
				echo '

<div class="levelup_options postbox">
    <h2 class="hndle">Links to Customizer Settings</h2>
    <div class="levelup_options_container">
        <ul>
            <li>
                <span class="dashicons dashicons-format-image"></span>
                <a href="#">Upload Logo</a>
            </li>
            <li>
                <span class="dashicons dashicons-format-image"></span>
                <a href="#">Header Builder</a>
            </li>
            <li>
                <span class="dashicons dashicons-format-image"></span>
                <a href="#">Footer Builder</a>
            </li>
            <li>
                <span class="dashicons dashicons-format-image"></span>
                <a href="#">Upload Logo</a>
            </li>
            <li>
                <span class="dashicons dashicons-format-image"></span>
                <a href="#">Upload Logo</a>
            </li>
            <li>
                <span class="dashicons dashicons-format-image"></span>
                <a href="#">Upload Logo</a>
            </li>
        </ul>
    </div>
</div>
';
			break;
			case 'template':
				require_once LEVELUP__FILE__PATH . 'inc/importer/import-view.php';
			break;
			case 'tools':
				$levelupAPISettings = new \LevelUPElementorThemeSettings\LEVELUP__Admin_settings();
				$levelupAPISettings->levelup_settings();
			break;

			case 'amp_support':
				require_once LEVELUP__FILE__PATH . 'admin/amp-support.php';
			break;
			case 'support':
				require_once LEVELUP__FILE__PATH . 'admin/support.php';
			break;
		}
	$content = ob_get_contents();
	ob_end_clean();

	$settings = get_option('levelup_library_settings');
	$steprequired = '';
	if(!isset($settings['api_status']) || (isset($settings['api_status']) && $settings['api_status']!='valid') ){
		$steprequired = '<span class="levelup_action" >Action Required</span>';
	}

	  echo '<div class="wrap">
	  			<div id="icon-themes" class="icon32"></div>
                <h2 class="levelup_option_header">LevelUP<span>1.1</span></h2> 
				'. settings_errors().'

				<h2 class="levelup-nav nav-tab-wrapper"> 
		            <a href="'.admin_url('admin.php?page=levelup&type=dashboard').'" class="nav-tab '.($type=='dashboard'? 'nav-tab-active': '').'">Dashboard</a>
		            <a href="'.admin_url('admin.php?page=levelup&type=options').'" class="nav-tab '.($type=='options'? 'nav-tab-active': '').'">Options</a>
		            <a href="'.admin_url('admin.php?page=levelup&type=template').'" class="nav-tab '.($type=='template'? 'nav-tab-active': '').'">Templates</a>
		            <a href="'.admin_url('admin.php?page=levelup&type=amp_support').'" class="nav-tab '.($type=='amp_support'? 'nav-tab-active': '').'">AMP</a>
		            <a href="'.admin_url('admin.php?page=levelup&type=tools').'" class="nav-tab '.($type=='tools'? 'nav-tab-active': '').'">Tools '.$steprequired.'</a>
		            <a href="'.admin_url('admin.php?page=levelup&type=support').'" class="nav-tab '.($type=='support'? 'nav-tab-active': '').'">Support</a>
		        </h2>
		         
		        <div class="contentWrapper">'. 
		        	$content
		 		.'</div>
	  		</div>';
	}


	function levelup_send_query_message(){   
	    
        if ( ! isset( $_POST['levelup_security_nonce'] ) ){
           return; 
        }
        if ( !wp_verify_nonce( $_POST['levelup_security_nonce'], 'levelup_ajax_check_nonce' ) ){
           return;  
        }            
        $message    = sanitize_text_field($_POST['message']);       
        $user       = wp_get_current_user();
        $user_data  = $user->data;        
        $user_email = $user_data->user_email;       
        //php mailer variables        
        $sendto = 'team@magazine3.com';
        $subject = "Customer Query";
        $headers = 'From: '. esc_attr($user_email) . "\r\n" .
        'Reply-To: ' . esc_attr($user_email) . "\r\n";
        // Load WP components, no themes.                      
        $sent = wp_mail($sendto, $subject, strip_tags($message), $headers);        
        if($sent){
        echo json_encode(array('status'=>'t'));            
        }else{
        echo json_encode(array('status'=>'f'));            
        }        
           wp_die();           
	}


	function levelup_enable_modules_upgread(){
		if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'levelup_ajax_check_nonce' ) ) {
	        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
	        exit();
	    }
	    // Exit if the user does not have proper permissions
	    if(! current_user_can( 'install_plugins' ) ) {
	        echo json_encode(array("status"=>300,"message"=>'User Request not valid'));
	        exit();
	    }
	    $plugins = array();
	    $redirectSettingsUrl = '';
	    $currentActivateModule = sanitize_text_field( wp_unslash($_REQUEST['activate']));
	    switch($currentActivateModule){
	        case 'amp': 
	            $nonceUrl = add_query_arg(
	                                    array(
	                                        'action'        => 'activate',
	                                        'plugin'        => 'accelerated-mobile-pages',
	                                        'plugin_status' => 'all',
	                                        'paged'         => '1',
	                                        '_wpnonce'      => wp_create_nonce( 'activate-plugin_accelerated-mobile-pages' ),
	                                    ),
	                        esc_url(network_admin_url( 'plugins.php' ))
	                        );
	            $plugins[] = array(
	                            'name' => 'accelerated-mobile-pages',
	                            'path_' => 'https://downloads.wordpress.org/plugin/accelerated-mobile-pages.zip',
	                            'path' => $nonceUrl,
	                            'install' => 'accelerated-mobile-pages/accelerated-moblie-pages.php',
	                        );
	            $redirectSettingsUrl = admin_url('admin.php?page=amp_options');
	        break;
	        default:
	            $plugins = array();
	        break;
	    }
	    if(count($plugins)>0){
	       echo json_encode( array( "status"=>200, "message"=>"Module successfully Added",'redirect_url'=>esc_url($redirectSettingsUrl) , "slug"=>$plugins[0]['name'], 'path'=> $plugins[0]['path'] ) );
	    }else{
	        echo json_encode(array("status"=>300, "message"=>"Modules not Found"));
	    }
	    wp_die();
	}


}

$obj = new levelup_menuConnector();
$obj->init();
