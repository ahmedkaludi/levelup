<?php
namespace AMPElementorThemeSettings;	
Class AFWP__Admin_settings{
	const PAGE_ID = 'elementor';
	const MENU_PRIORITY_AMP_THEMES = 503;
	public $allTabs = array('dashboard','help');
	public $tabsdata = array(
				'dashboard'	=> array(
									'label_name'	=>	'dashboard',
									'icon_class'	=> 	'dashicons-dashboard',
									'section_slug'	=>	'dashboard_menu_section',
								),
								'help'		=>	array(
									'label_name'	=> 'Help',
									'icon_class'	=> 'dashicons-editor-help',
									'section_slug'	=>'help_menu_section',
								),
						);
	function __construct(){
		add_action( 'plugin_action_links_' . plugin_basename( LEVELUP__FILE__ ), array( $this, 'levelup_plugin_action_links') );
		add_action( 'admin_menu', array( $this, 'levelup_settings_menu' ), self::MENU_PRIORITY_AMP_THEMES );
		add_action( 'admin_notices',  array($this,'levelup_notice_new_version_available' ));
		/*
			WP Settings API
		*/
		add_action('admin_init', array( $this, 'levelup_tabs_settings_init'));
	}
	function levelup_plugin_action_links( $links ) {
		$links[] = '<a href="' . esc_url( admin_url( 'admin.php?page=levelup_settings' ) ) . '">' . esc_html__( 'Settings', LEVELUP_TEXT_DOMAIN ) . '</a>';
		return $links;
	}

	public function levelup_settings_menu(){
		$AvailableUpdateHtml = '';
		if($this->check_update_available()){
			$AvailableUpdateHtml = '<span class="update-plugins count-2"><span class="plugin-count">'.esc_html__( '1', LEVELUP_TEXT_DOMAIN ).'</span></span>';
		}
		add_submenu_page(
				self::PAGE_ID,
				esc_html__( 'LevelUp '.$AvailableUpdateHtml, LEVELUP_TEXT_DOMAIN ),
				esc_html__( 'LevelUp '.$AvailableUpdateHtml, LEVELUP_TEXT_DOMAIN ),
				'manage_options',
				'levelup_settings',
				[ $this, 'levelup_settings' ]
			);
	}

	public function levelup_get_tab( $default = '') {
		$availableTabs = $this->allTabs;
		$tab = isset( $_GET['tab'] ) ? sanitize_text_field($_GET['tab']) : $default;
	    if ( ! in_array( $tab, $availableTabs ) ) {
			$tab = $default;
		}
		return $tab;
	}

	protected function levelup_admin_link($tab = '', $args = array()){	
		$page = 'levelup_settings';

		if ( ! is_multisite() ) {
			$link = admin_url( 'admin.php?page=' . $page );
		}
		else {
			$link = network_admin_url( 'admin.php?page=' . $page );
		}

		if ( $tab ) {
			$link .= '&tab=' . $tab;
		}

		if ( $args ) {
			foreach ( $args as $arg => $value ) {
				$link .= '&' . $arg . '=' . urlencode( $value );
			}
		}
		return esc_url($link);
	}

	public function levelup_settings(){
		if ( isset( $_GET['settings-updated'] ) ) {
			if(!levelup_call_api_registerd()){
				add_settings_error(
					    'levelup_library_settings', // whatever you registered in `register_setting
					    'API_key_error', // doesn't really mater
					    esc_html__('API Key not valid. Please insert valid key', LEVELUP_TEXT_DOMAIN),
					    'error' // error or notice works to make things pretty
					);
			}
			settings_errors();
		}?>
		<div class="wrap">
			<h1><?php esc_html__('LevelUp Settings', LEVELUP_TEXT_DOMAIN); ?></h1>
			<h2 class="nav-tab-wrapper levelup-tabs">

				<?php
				$tab = $this->levelup_get_tab($this->allTabs[0]);
				foreach ($this->allTabs as $key => $value) {
					echo '<a href="' . esc_url($this->levelup_admin_link($value)) . '" class="nav-tab ' . esc_attr( $tab == $value ? 'nav-tab-active' : '') . '"><span class="dashicons '.esc_attr($this->tabsdata[$value]['icon_class']).'"></span> ' . esc_html__(ucfirst($this->tabsdata[$value]['label_name']), LEVELUP_TEXT_DOMAIN) . '</a>';
				}
				?>
			</h2>
			<form action="options.php" method="post" enctype="multipart/form-data" class="levelup-settings-form">
				<div class="setting-wrappers">
				<?php
				// Output nonce, action, and option_page fields for a settings page.
				settings_fields( 'levelup_theme_setting_group' );	
				foreach ($this->allTabs as $key => $value) {
					echo "<div class='levelup-field-".esc_attr($value)."' style='".esc_attr( $tab != $value ? 'display:none;' : '')."'>";
					// Status
					do_settings_sections( $this->tabsdata[$value]['section_slug'] );	// Page slug
					echo "</div>";
				}
				?>	
				</div>
				<div class="button-wrapper">
				<?php
					// Output save settings button
					submit_button( esc_html__('Save Settings', LEVELUP_TEXT_DOMAIN) );
					?>
				</div>
			</form>
		</div><!-- /.wrap -->
		<?php
	}

	public function levelup_tabs_settings_init(){
		register_setting( 'levelup_theme_setting_group', 'levelup_library_settings' );
        
		$desciption2 = "<strong style='font-size: 13px;text-transform: uppercase'>".esc_html__('Welcome to LevelUP:',LEVELUP_TEXT_DOMAIN)."</strong> <span style='font-weight:normal; font-size: 14px;'>".esc_html__('Get Ready take your WP to the next level with the below features.',LEVELUP_TEXT_DOMAIN).
        "   </span>    
         <br />
<strong style='font-size: 24px;margin-top: 50px;position: relative;display: block;line-height: 8px;'>Design Library for Elementor</strong><br/><span style='font-weight:normal;font-size: 14px;'>".esc_html__('Its a free service which requires API key to be installed so that we can deliver the design elements on constant basis.',LEVELUP_TEXT_DOMAIN).
        "   

        

      ";

		add_settings_section('dashboard_menu_section', $desciption2, '__return_false', 'dashboard_menu_section');
		
		// Sync status
		add_settings_field(
			'levelup_dashboard_api_key',								// ID
			esc_html__('Enter API key',LEVELUP_TEXT_DOMAIN),			// Title
			array($this, 'levelup_api_key_callback'),					// Callback
			'dashboard_menu_section',							// Page slug
			'dashboard_menu_section'							// Settings Section ID
		);
		$settings = get_option('levelup_library_settings');
		if(isset($settings['api_status']) && $settings['api_status']){
			// Sync status
			add_settings_field(
				'levelup_dashboard_sync',				// ID
				'',													// Title
				array($this, 'levelup_sync_callback'),	// Callback
				'dashboard_menu_section',							// Page slug
				'dashboard_menu_section'							// Settings Section ID
			);
		}
		
		$desciption = "<strong>".esc_html__('Need Support',LEVELUP_TEXT_DOMAIN)."?</strong>: <span style='font-weight:normal'>".esc_html__('Our world class technical team is always available to help you with your issues',LEVELUP_TEXT_DOMAIN).". <a class='link' href='mailto:team@magazine3.com' target='_blank' style='font-weight:bold;display:inline-block'>".esc_html__('Just send us an email',LEVELUP_TEXT_DOMAIN)."</a></span>.";

		add_settings_section('help_menu_section',
								 $desciption, 
								 '__return_false',
								 'help_menu_section'
								);
		

	}

	public function levelup_sync_callback(){
		
	    global $pagenow;
	    $server_version = get_option( 'levelup-library-version');
	    $current_version = get_option( 'levelup-library-loaded-version');
	     //echo $current_version.", ".$server_version;die;

	    ?>	
	    	<div class="levelup-sync-wrapper">
				<h3><?php echo esc_html__('You now have full access to LevelUp',LEVELUP_TEXT_DOMAIN); ?></h3>
				<p><?php echo esc_html__('Current version', LEVELUP_TEXT_DOMAIN);?> <?php echo esc_html($current_version); ?></p>
				<br>
				<?php
			    if(version_compare($current_version, $server_version, '<') ){
			    ?>
			    	<p><?php echo esc_html__('New Version Available', LEVELUP_TEXT_DOMAIN); echo " ".esc_html($server_version); ?></p>
			    	<br>
			    	<button type="button" value="sync" name="sync" id="levelup-sync-lib" class="button"><i class="dashicons dashicons-download"></i> <?php echo esc_html__('Update the Library to', LEVELUP_TEXT_DOMAIN);?> <?php echo esc_html($server_version); ?></button>
					
				<?php }else{ ?>
					<button type="button" id="levelup-sync-versions" class="button"><i class="dashicons dashicons-download"></i> <?php echo esc_html__('Sync Library', LEVELUP_TEXT_DOMAIN); ?> </button>
				<?php } ?>
			</div>
	    <?php
	   
	}

	public function levelup_api_key_callback(){
		$settings = get_option('levelup_library_settings');

		
		if(isset($settings['api_status']) && $settings['api_status']=='valid'){
			echo '<input type="text" name="levelup_library_settings[api_key]" value="'.esc_attr(isset($settings['api_key'])? $settings['api_key']: '').'" class="regular-text" readonly>';
			echo '<span class="dashicons dashicons-yes" style="color: #46b450;"></span>';
			echo '<span class="button right levelup_remove" ><i class="dashicons dashicons-no" style="color: #e6132f;"></i> '.esc_html__( 'Remove Key', LEVELUP_TEXT_DOMAIN ).'</span>';
		}else{
			echo '<input type="text" name="levelup_library_settings[api_key]" value="'.esc_attr(isset($settings['api_key'])? $settings['api_key']: '').'" class="regular-text">';
		}
		echo '<p>'.esc_html__('Enter the LevelUP API key to get unlimited design elements.  ',LEVELUP_TEXT_DOMAIN ). '<a target="_blank" href="'.esc_url(ELEMENTOR_PLUS_SERVER_URL.'/user-register/').'" style="text-decoration:none;">'.esc_html__( ' Get your FREE key in 20 seconds', LEVELUP_TEXT_DOMAIN ).' <i class="dashicons dashicons-arrow-right-alt"></i></a>.</p>';

	}

	public function levelup_notice_new_version_available(){
		global $pagenow;
		$server_version = get_option( 'levelup-library-version',0);
	    $current_version = get_option( 'levelup-library-loaded-version',0);
	    $settings = get_option( 'levelup_library_settings',0);

	    if((($current_version==0 && $server_version==0) || $settings['api_key']=='') && ( ('admin.php' != $pagenow ) && (!isset($_GET['page']) || 'levelup_settings' != $_GET['page'] ) )  ){
	    	echo '<div class="notice notice-warning" id="sync-status-notice" >
	        <p>'.esc_html__('Congratulations on installing',LEVELUP_TEXT_DOMAIN).' <strong>'.esc_html__('LevelUp',LEVELUP_TEXT_DOMAIN).'</strong>.<br/> '.('You have one last step remaining to finish the installation').'. <a href="'. esc_url('admin.php?page=levelup_settings',LEVELUP_TEXT_DOMAIN) .'" class=button button-secondary button-hero">'.esc_html__('Finish Installation',LEVELUP_TEXT_DOMAIN).'</a></p>
	        </div>';
	    }

	    if(version_compare($current_version, $server_version, '<') ){
	    ?>
		    <div class="notice notice-info is-dismissible" id="sync-status-notice" >
		    	<p>
		        	<?php echo esc_html__('New Version of LevelUp',LEVELUP_TEXT_DOMAIN); ?> <?php echo esc_html($server_version); ?> <?php echo esc_html__('is available',LEVELUP_TEXT_DOMAIN); ?>
		        	<a href="<?php echo esc_url('admin.php?page=levelup_settings'); ?>" class=""><?php echo esc_html__('Click to update LevelUp design library',LEVELUP_TEXT_DOMAIN); ?></a> .<span class="levelup-response-status"></span>
		        </p>
		    </div>
	    <?php
			}
		
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
}

new \AMPElementorThemeSettings\AFWP__Admin_settings();