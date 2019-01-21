<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

Class levelup_menuConnector{
	function init(){
		add_action('admin_menu', array($this,'register_levelup_menu_page'));
		add_action('wp_ajax_levelup_send_query_message', array($this,'levelup_send_query_message'));
		add_action( 'wp_ajax_levelup_enable_modules_upgread', array($this,'levelup_enable_modules_upgread') );
		add_action( 'wp_ajax_levelup_connect_design_library_activate', array($this,'levelup_connect_design_library_activate') );
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

	function levelup_is_plugin_active( $plugin_basename ){
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        return is_plugin_active( $plugin_basename );
    }

	function levelup_get_plugin_activation_link( $plugin_base_name, $slug, $plugin_filename ) {
	    $activate_nonce = wp_create_nonce( 'activate-plugin_' . $slug .'/'. $plugin_filename );
	    return self_admin_url( 'plugins.php?_wpnonce=' . $activate_nonce . '&action=activate&plugin='. str_replace( '/', '%2F', $plugin_base_name ) );
	}
	function levelup_get_plugin_install_link( $plugin_slug ){
	    $plugin_slug = esc_attr( $plugin_slug );
	    $install_link  = wp_nonce_url(
	        add_query_arg(
	            array(
	                'action' => 'install-plugin',
	                'plugin' => $plugin_slug,
	            ),
	            network_admin_url( 'update.php' )
	        ),
	        'install-plugin_' . $plugin_slug
	    );
	    return $install_link;
	}
	function levelup_make_html_attributes( $attrs = array() ){
	    if( ! is_array( $attrs ) ){
	        return '';
	    }
	    $attributes_string = '';
	    foreach ( $attrs as $attr => $value ) {
	        $value = is_array( $value ) ? join( ' ', array_unique( $value ) ) : $value;
	        $attributes_string .= sprintf( '%s="%s" ', $attr, esc_attr( trim( $value ) ) );
	    }
	    return $attributes_string;
	}

	function LevelupSettings(){
		$type = isset($_GET['type']) ? $_GET['type'] : '';
		if(empty($type)){ $type = 'dashboard'; }
		//Dashboard require/optional plugins
		$requirePlugins = array(
							array(
								'type'=> 'plugin',
								'plugin_name'=>'Elementor',
								'plugin_label'=>'Install Elementor plugin',
								'plugin_base_name'=>'elementor/elementor.php',
								'plugin_slug'=>'elementor',
								'plugin_filename'=>'elementor.php',
								'plugin_current_status'=>'Install',
								'why'=>'Require',
								),
							array(
								'type'=> 'connect',
								'plugin_name'=>'Design library',
								'plugin_label'=>'Connect to Design library',
								'action_link'=>'',
								'plugin_current_status'=>'Install',
								'why'=>'Required',
								),
							array(
								'type'=> 'plugin',
								'plugin_name'=>'Accelerated Mobile Pages',
								'plugin_label'=>'Enable Amp Support',
								'plugin_base_name'=>'accelerated-mobile-pages/accelerated-moblie-pages.php',
								'plugin_slug'=>'accelerated-mobile-pages',
								'plugin_filename'=>'accelerated-moblie-pages.php',
								'plugin_current_status'=>'Install',
								'why'=>'Optional',
								),
						);
		$setup = '';$setupStatus = array();
		foreach ($requirePlugins as $key => $required) {
			$button_label = $action = $plugin_title = '';
			$plugin_title = $required['plugin_name'];
			$setupStatus[$required['plugin_name']] = 0;
			if($required['type'] == 'plugin'){
				$action = $required['plugin_current_status'];
				$required['class'] = array( 'button','level-up-recommended-plugin' );
				$required['data-plugin-slug']      = $required['plugin_slug'];
				$required['data-activate-url']     = $this->levelup_get_plugin_activation_link( $required['plugin_base_name'], $required['plugin_slug'], $required['plugin_filename'] );
				$required['data-install-url']      = $this->levelup_get_plugin_install_link( $required['plugin_slug'] );
				$required['data-redirect-url']     = self_admin_url( 'admin.php?page=levelup' );

				$installed_plugins  = get_plugins();
				if( ! isset( $installed_plugins[ $required['plugin_base_name'] ] ) ){
			        $required['data-action'] = 'install';
			        $required['href'] = $required['data-install-url'];
			        $button_label = sprintf( esc_html__( 'Install ', 'level-up' ), $plugin_title );

			    } elseif( ! $this->levelup_is_plugin_active( $required['plugin_base_name'] ) ) {
			        $required['data-action'] = 'activate';
			        $required['href'] = $required['data-activate-url'];
			        $button_label = sprintf( esc_html__( 'Activate', 'level-up' ), $plugin_title );
			    }
			    if(!empty($button_label)){
			    	unset($required['type'], $required['plugin_name'], $required['plugin_label'] );
				    $action = '<a '.$this->levelup_make_html_attributes( $required ).' >'. $button_label.'</a>';
				}else{
					$setupStatus[$required['plugin_name']] = 1;
					$action = '<span class="dashicons dashicons-yes green-color"></span> Done';
				}
			}elseif($required['type'] == 'connect'){
				$settings = get_option('levelup_library_settings');
				if(isset($settings['api_status']) && $settings['api_status']=='valid'){
					$setupStatus[$required['plugin_name']] = 1;
					$action = '<span class="dashicons dashicons-yes green-color"></span> Connected Successfully';
				}else{
					$action = '<span><input type="text" id="levelup-connect-to-design-template"><button class="button connect-to-design" data-redirect-url="'.$required['data-redirect-url'] .'">Activate</button></span>';
				}
			}
			$setup .= '<li>
				<div class="setup-option">
					'.($setupStatus[$plugin_title]!=1? $plugin_title : "<strike>".$plugin_title."</strike>").' 
				</div>
				<div class="setup-status">
					'.$action.' <em class="why-help" title="'.$required['why'].'">(Why)</em>
				</div>
			</li>';
		}//foreach closed
		$setupStatus = array_unique( array_values($setupStatus) );
		ob_start();
		switch($type){
			case 'dashboard':
				$setupMessage = '<span class="red-color">Finish the above setup to continue LevelUP</span>';
				
				if(count($setupStatus) == 1){
				$setupMessage = '<span class="green-color">You are all set to start Import the Template</span>';
				}


				echo '
				<div class="setup-wrapper">
            		<h3>Setup</h3>
            		<div class="print_message"></div>
            		<div class="container">
            			<ul>
            				'.$setup.'
            			</ul>
            		</div>
            		<p class="center justify"> '.$setupMessage.'</p>
            	</div>

                <div class="levelup_dashboard">
                	
					
					<div class="levelup_dashboard_left" style="display:none;">
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
                    <div class="levelup_dashboard_right" style="float:left; width:100%;">
                        <h2>Start with a Template</h2>
                        <p>Save time by choosing among beautiful templates designed for different sectors and purposes.</p>
                        <a href="'.esc_url(admin_url( $path = 'admin.php?page=levelup&type=template' )).'" class="button button-primary">Import a Template</a>
                    </div>
                    <div class="cb"></div>
                </div>


                ';
                ?>
                <script>


	            </script>
                <?php
			break;			
			case 'options':
				 global $levelupDefaultOptions;
		        $data = headerfooter_get_setting('header_panel_settings');
		        if(empty($data) && !empty($levelupDefaultOptions)){ $data = $levelupDefaultOptions[$this->control_id]; }
		        if($data){
					$data = json_decode(urldecode_deep( $data ), true) ;
					$dataSelectedDesigns = $data['selected_design'];
				}
				echo '

				<div class="levelup_options postbox">
				    <h2 class="hndle">Links to Customizer Settings</h2>
				    <div class="levelup_options_container">
				        <ul>
				            <li>
				                <span class="dashicons dashicons-format-image"></span>
				                <a href="'.esc_url(admin_url('customize.php?autofocus[section]=logo-' . $dataSelectedDesigns)).'">Upload Logo</a>
				            </li>
				            <li>
				                <span class="dashicons dashicons-format-image"></span>
				                <a href="'.esc_url(admin_url('customize.php?autofocus[section]=menu-' . $dataSelectedDesigns )).'">Setup menu</a>
				            </li>
				            <li>
				                <span class="dashicons dashicons-format-image"></span>
				                <a href="'.esc_url(admin_url('customize.php?autofocus[panel]=header_panel' )).'">Header Builder</a>
				            </li>
				            <li>
				                <span class="dashicons dashicons-format-image"></span>
				                <a href="'.esc_url(admin_url('customize.php?autofocus[panel]=footer_panel' )).'">Footer Builder</a>
				            </li>
				            <li>
				                <span class="dashicons dashicons-format-image"></span>
				                <a href="'.esc_url(admin_url('customize.php?autofocus[section]=theme_field_settings' )).'">Typography</a>
				            </li>
				        </ul>
				    </div>
				</div>
				';
			break;
			case 'template':
				echo "<script>var levelupSetupCompleted = ".(count($setupStatus) == 1? 1: 0)."</script>";
				require_once LEVELUP__FILE__PATH . '/inc/vendor/importer/import-view.php';
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
		$steprequired = '<span class="levelup_action" >'.esc_html__('Action Required', LEVELUP_TEXT_DOMAIN).'</span>';
	}

	  echo '<div class="wrap">
	  			<div id="icon-themes" class="icon32"></div>
                <h2 class="levelup_option_header">LevelUP<span>'.LEVELUP_VERSION.'</span></h2> 
				'. settings_errors().'

				<h2 class="levelup-nav nav-tab-wrapper"> 
		            <a href="'.esc_url(admin_url('admin.php?page=levelup&type=dashboard')).'" class="nav-tab '.($type=='dashboard'? 'nav-tab-active': '').'">'.esc_html__('Dashboard',LEVELUP_TEXT_DOMAIN).'</a>
		            <a href="'.esc_url(admin_url('admin.php?page=levelup&type=options')).'" class="nav-tab '.($type=='options'? 'nav-tab-active': '').'">'.esc_html__('Options', LEVELUP_TEXT_DOMAIN).'</a>
		            <a href="'.esc_url(admin_url('admin.php?page=levelup&type=template')).'" class="nav-tab '.($type=='template'? 'nav-tab-active': '').'">'.esc_html__('Templates', LEVELUP_TEXT_DOMAIN).'</a>
		            <a href="'.esc_url(admin_url('admin.php?page=levelup&type=amp_support')).'" class="nav-tab '.($type=='amp_support'? 'nav-tab-active': '').'">'.esc_html__('AMP', LEVELUP_TEXT_DOMAIN).'</a>
		            <a href="'.esc_url(admin_url('admin.php?page=levelup&type=tools')).'" class="nav-tab '.($type=='tools'? 'nav-tab-active': '').'">'.esc_html__('Tools', LEVELUP_TEXT_DOMAIN).' '.$steprequired.'</a>
		            <a href="'.esc_url(admin_url('admin.php?page=levelup&type=support')).'" class="nav-tab '.($type=='support'? 'nav-tab-active': '').'">'.esc_html__('Support', LEVELUP_TEXT_DOMAIN).'</a>
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

	function levelup_connect_design_library_activate(){
		if(!wp_verify_nonce( $_REQUEST['verify_nonce'], 'levelup_ajax_check_nonce' ) ) {
	        echo json_encode(array("status"=>300,"message"=>'Request not valid'));
	        exit();
	    }
	    // Exit if the user does not have proper permissions
	    if(! current_user_can( 'install_plugins' ) ) {
	        echo json_encode(array("status"=>300,"message"=>'User Request not valid'));
	        exit();
	    }
	    $key = sanitize_text_field($_REQUEST['key']);
	     if(empty($key)) {
	        echo json_encode(array("status"=>402,"message"=>'Please Enter valid key'));
	        exit();
	    }
	    update_option( "levelup_library_settings", array('api_key'=>$key));
	    $settings = get_option('levelup_library_settings');
	    $response = levelup_call_api_registerd();
	    if(!$response){
	    	echo json_encode(array("status"=>400,"message"=>'Response not valid please try again.'));
	        exit();
	    }else{
	    	echo json_encode(array("status"=>200,"message"=>$response));
	        exit();
	    }
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
