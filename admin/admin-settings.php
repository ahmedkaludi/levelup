<?php
namespace AMPElementoreThemeSettings;	
Class AFWP__Admin_settings{
	const PAGE_ID = 'elementor';
	const MENU_PRIORITY_AMP_THEMES = 503;
	public $allTabs = array('dashboard','help');
	public $tabsdata = array('dashboard'=>array(
											'label_name'=>'dashboard',
											'icon_class'=> 'dashicons-dashboard',
											'section_slug'=>'dashboard_menu_section',
											),
							'help'	=>	array(
										'label_name'=>'Help',
										'icon_class'=> 'dashicons-editor-help',
										'section_slug'=>'help_menu_section',
										),
						);
	function __construct(){
		add_action( 'admin_menu', array( $this, 'ampforwp_settings_menu' ), self::MENU_PRIORITY_AMP_THEMES );
		add_action( 'admin_notices',  array($this,'notice_for_new_theme_version_available' ));
		/*
			WP Settings API
		*/
		add_action('admin_init', array( $this, 'ampforwp_tabs_settings_init'));
	}
	public function ampforwp_settings_menu(){
		$AvailableUpdateHtml = '';
		if($this->check_update_available()){
			$AvailableUpdateHtml = '<span class="update-plugins count-2"><span class="plugin-count">1</span></span>';
		}
		add_submenu_page(
				self::PAGE_ID,
				__( 'Elementor Plus '.$AvailableUpdateHtml, ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
				__( 'Elementor Plus '.$AvailableUpdateHtml, ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
				'manage_options',
				'ampforwp_elementor_themes_settings',
				[ $this, 'ampforwp_elementor_themes_settings' ]
			);
	}

	public function pwaforwp_get_tab( $default = '') {
		$availableTabs = $this->allTabs;
		$tab = isset( $_GET['tab'] ) ? sanitize_text_field($_GET['tab']) : $default;
	    if ( ! in_array( $tab, $availableTabs ) ) {
			$tab = $default;
		}
		return $tab;
	}
	protected function pwaforwp_admin_link($tab = '', $args = array()){	
		$page = 'ampforwp_elementor_themes_settings';

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

	public function ampforwp_elementor_themes_settings(){
		if ( isset( $_GET['settings-updated'] ) ) {
			if(!elementor_plus_call_api_registerd()){
				add_settings_error(
					    'ampforwp_elementor_theme_settings', // whatever you registered in `register_setting
					    'API_key_error', // doesn't really mater
					    __('API Key not valid. Please insert valid key', ELEMENTOR_AMPFORWP_TEXT_DOMAIN),
					    'error' // error or notice works to make things pretty
					);
			}
			settings_errors();
		}
		?>
		<div class="wrap">
			<h1>Elementor Theme Settings</h1>
			<h2 class="nav-tab-wrapper ampforwp-elementor-tabs">

				<?php
				$tab = $this->pwaforwp_get_tab($this->allTabs[0]);
				foreach ($this->allTabs as $key => $value) {
					echo '<a href="' . esc_url($this->pwaforwp_admin_link($value)) . '" class="nav-tab ' . esc_attr( $tab == $value ? 'nav-tab-active' : '') . '"><span class="dashicons '.$this->tabsdata[$value]['icon_class'].'"></span> ' . esc_html__(ucfirst($this->tabsdata[$value]['label_name']), ELEMENTOR_AMPFORWP_TEXT_DOMAIN) . '</a>';
				}
				?>
			</h2>
			<form action="options.php" method="post" enctype="multipart/form-data" class="ampforwp-elementor-settings-form">
				<div class="setting-wrappers">
				<?php
				// Output nonce, action, and option_page fields for a settings page.
				settings_fields( 'ampforwp_elementor_theme_setting_group' );	
				foreach ($this->allTabs as $key => $value) {
					echo "<div class='ampforwp-elementor-".$value."' ".( $tab != $value ? 'style="display:none;"' : '').">";
					// Status
					do_settings_sections( $this->tabsdata[$value]['section_slug'] );	// Page slug
					echo "</div>";
				}
				?>	
				</div>
				<div class="button-wrapper">
                            <input type="hidden" name="pwaforwp_settings[manualfileSetup]" value="1">
				<?php
					// Output save settings button
					submit_button( esc_html__('Save Settings', 'pwa-for-wp') );
					?>
				</div>
			</form>
		</div><!-- /.wrap -->
		<?php
	}
	function ampforwp_tabs_settings_init(){
		register_setting( 'ampforwp_elementor_theme_setting_group', 'ampforwp_elementor_theme_settings' );

		add_settings_section('dashboard_menu_section', esc_html__('Sync Themes',ELEMENTOR_AMPFORWP_TEXT_DOMAIN), '__return_false', 'dashboard_menu_section');
		
		// Sync status
		add_settings_field(
			'ampforwp_elementor_dashboard_api_key',								// ID
			esc_html__('Enter API key',ELEMENTOR_AMPFORWP_TEXT_DOMAIN),			// Title
			array($this, 'ampforwp_elementor_api_key_callback'),					// Callback
			'dashboard_menu_section',							// Page slug
			'dashboard_menu_section'							// Settings Section ID
		);
		$settings = get_option('ampforwp_elementor_theme_settings');
		if(isset($settings['api_status']) && $settings['api_status']){
			// Sync status
			add_settings_field(
				'ampforwp_elementor_dashboard_sync',								// ID
				esc_html__('Theme Library Status',ELEMENTOR_AMPFORWP_TEXT_DOMAIN),			// Title
				array($this, 'ampforwp_elementor_sync_callback'),					// Callback
				'dashboard_menu_section',							// Page slug
				'dashboard_menu_section'							// Settings Section ID
			);
		}
		

		add_settings_section('help_menu_section', "<strong>Feel free to email us </strong>: <a class='link' href='mailto:team@magazine3.com' target='_blank'>Click here</a>", '__return_false', 'help_menu_section');
		

	}

	function ampforwp_elementor_sync_callback(){
	    global $pagenow;
	    $server_version = get_option( 'ampforwp-elementor-plus-version');
	    $current_version = get_option( 'ampforwp-elementor-plus-loaded-version');
	    // echo $current_version.", ".$server_version;die;
	    if(version_compare($current_version, $server_version, '<') ){
	    ?>
	    
	        <p>
	        	New Version of theme <?php echo $server_version; ?> is available
	        	Click on <button type="button" value="sync" name="sync" id="ampforwp-elementor-sync" class="button-primary">Sync</button> to update Elementor Plus design library.<span class="ampforwp-response-status"></span></p>
	    
	    <?php
		}else{
			echo '<p><span class="dashicons dashicons-yes" style="color: #46b450;"></span>  Theme Library is upto date</p>';
		}


	}

	function ampforwp_elementor_api_key_callback(){
		$settings = get_option('ampforwp_elementor_theme_settings');

		
		if(isset($settings['api_status']) && $settings['api_status']=='valid'){
			echo '<input type="text" name="ampforwp_elementor_theme_settings[api_key]" value="'.(isset($settings['api_key'])? $settings['api_key']: '').'" class="regular-text" readonly>';
			echo '<span class="dashicons dashicons-yes" style="color: #46b450;"></span>';
		}else{
			echo '<input type="text" name="ampforwp_elementor_theme_settings[api_key]" value="'.(isset($settings['api_key'])? $settings['api_key']: '').'" class="regular-text">';
		}
		echo '<p>Please enter the API key above. <a target="_blank" href="http://elementor-plus.com/user-register/" style="text-decoration:none;">Get your FREE key here <i class="dashicons dashicons-arrow-right-alt"></i></a>.</p>';

	}

	function notice_for_new_theme_version_available(){
		global $pagenow;
		$server_version = get_option( 'ampforwp-elementor-plus-version',0);
	    $current_version = get_option( 'ampforwp-elementor-plus-loaded-version',0);

	    if($current_version==0 && $server_version==0 && ( ('admin.php' != $pagenow ) && (!isset($_GET['page']) || 'ampforwp_elementor_themes_settings' != $_GET['page'] ) )  ){
	    	echo '<div class="notice notice-warning" id="sync-status-notice" >
	        <p>Congratulations on installing <strong>Elementor Plus</strong>.<br/> You have one last step remaining to finish the installation. <a href="'. esc_url('admin.php?page=ampforwp_elementor_themes_settings') .'" class=button button-secondary button-hero">Finish Installation</a></p>
	        </div>';
	    }

	    if(version_compare($current_version, $server_version, '<') ){
	    ?>
		    <div class="notice notice-info is-dismissible" id="sync-status-notice" >
		    	<p>
		        	New Version of themes <?php echo $server_version; ?> is available
		        	<a href="<?php echo esc_url('admin.php?page=ampforwp_elementor_themes_settings'); ?>" class="">Click to update Elementor Plus design library</a> .<span class="ampforwp-response-status"></span>
		        </p>
		    </div>
	    <?php
			}
			
		if('development'==ELEMENTOR_AMPFORWP_ENVIRONEMT && ( 'admin.php' === $pagenow ) && ( 'ampforwp_elementor_themes_settings' === $_GET['page'] ) ){
			//Check Version
	    	echo '<div class="notice notice-info is-dismissible" id="sync-status-notice" >
	        <p>Click on <button type="button" value="sync" name="sync" id="ampforwp-elementor-sync-versions" class="button-primary">Check Version</button>.<span class="ampforwp-response-status"></span></p>
	        </div>';
	    }
	}

	//Common functions
	private function check_update_available(){
		$server_version = get_option( 'ampforwp-elementor-plus-version');
	    $current_version = get_option( 'ampforwp-elementor-plus-loaded-version');
	    // echo $current_version.", ".$server_version;die;
	    if(version_compare($current_version, $server_version, '<') ){
	    	return $server_version;
	    }
		return false;
	}
}

new \AMPElementoreThemeSettings\AFWP__Admin_settings();