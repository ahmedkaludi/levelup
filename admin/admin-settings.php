<?php
namespace LevelUPElementorThemeSettings;	
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
Class LEVELUP__Admin_settings{
	const PAGE_ID = 'elementor';
	const MENU_PRIORITY_AMP_THEMES = 503;
	public $allTabs = array('dashboard');
	public $tabsdata = array(
				'dashboard'	=> array(
									'label_name'	=>	'dashboard',
									'icon_class'	=> 	'dashicons-dashboard',
									'section_slug'	=>	'dashboard_menu_section',
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
		add_action( 'admin_notices', array($this, 'levelup_plugin_notice_for_theme') );
	}
	function levelup_plugin_action_links( $links ) {
		$links[] = '<a href="' . esc_url( admin_url( 'admin.php?page=levelup' ) ) . '">' . esc_html__( 'Settings', LEVELUP_TEXT_DOMAIN ) . '</a>';
		return $links;
	}

	public function levelup_settings_menu(){
		//links moved in "Composite-menu.php" 
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
			//settings_errors();
		}
		?>
		<div class="wrap">
			<?php
				//Get Current default Tab
				$tab = $this->levelup_get_tab($this->allTabs[0]);
			?>
			<form action="options.php" method="post" enctype="multipart/form-data" class="levelup-settings-form">
				<div class="levelup levelup-tools-screen">
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
        
		$desciption2 = "<h2 class='levelup_tools_heading'>".esc_html__('Design Library',LEVELUP_TEXT_DOMAIN)."</h2> <p class='levelup_tools_desc'>".esc_html__('Design Library is a free service where we will be creating high quality designs and adding them to our cloud library. You can connect to that library with the help of API and get instant access to all of the designs and use them anywhere! We will be updating the design library on consistent basis and you will get a notification when the update is available.',LEVELUP_TEXT_DOMAIN);

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
		

	}

	public function levelup_sync_callback(){
		
	    global $pagenow;
	    $server_version = get_option( 'levelup-library-version');
	    $current_version = get_option( 'levelup-library-loaded-version');

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
			    	<button type="button" value="sync" name="sync" id="levelup-sync-lib" class="button"><i class="dashicons dashicons-download"></i> <?php echo esc_html__('Upgrade the Library to', LEVELUP_TEXT_DOMAIN);?> <?php echo esc_html($server_version); ?></button>
					
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
			echo '<p>'.esc_html__('  ',LEVELUP_TEXT_DOMAIN ). '<a target="_blank" href="'.esc_url(LEVELUP_SERVER_URL.'/register/').'" style="text-decoration:none;">'.esc_html__( ' Get your FREE key in 20 seconds', LEVELUP_TEXT_DOMAIN ).' <i class="dashicons dashicons-arrow-right-alt"></i></a></p>';
		}
		

	}

	public function levelup_notice_new_version_available(){
		global $pagenow;
		$server_version = get_option( 'levelup-library-version',0);
	    $current_version = get_option( 'levelup-library-loaded-version',0);
	    $settings = get_option( 'levelup_library_settings',0);

	    if(
	    	( (($current_version==0 && $server_version==0) || $settings['api_key']=='') 
	    	|| !is_plugin_active( 'elementor/elementor.php' )  || !is_plugin_active( 'accelerated-mobile-pages/accelerated-moblie-pages.php' ) ) && 
	    	( ('admin.php' != $pagenow ) && !isset($_GET['page']) || 'levelup' != $_GET['page'] ) 
		){
	    	echo '<div class="notice notice-warning" id="sync-status-notice" >
	        <p>'.esc_html__('Congratulations',LEVELUP_TEXT_DOMAIN).' <br/><strong>'.esc_html__('LevelUP',LEVELUP_TEXT_DOMAIN).'</strong> '.(' is  installed but not yet configured,  you need to configure here ').' <a href="'. esc_url('admin.php?page=levelup',LEVELUP_TEXT_DOMAIN) .'" class="button button-primary">'.esc_html__('Finish Setup',LEVELUP_TEXT_DOMAIN).'</a></p>
	        </div>';
	    }

	    if(version_compare($current_version, $server_version, '<') ){
	    ?>
		    <div class="notice notice-info is-dismissible" id="sync-status-notice" >
		    	<p>
		        	<?php echo esc_html__('New Design Elements available',LEVELUP_TEXT_DOMAIN); ?> <?php echo esc_html($server_version); ?> <?php echo esc_html__('is available',LEVELUP_TEXT_DOMAIN); ?>
		        	<a href="<?php echo esc_url('admin.php?page=levelup&type=tools'); ?>" class=""><?php echo esc_html__('Click to get the new designs',LEVELUP_TEXT_DOMAIN); ?></a> .<span class="levelup-response-status"></span>
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

	function levelup_plugin_notice_for_theme(){
		$theme = wp_get_theme();
		if($theme->name!='Level UP'){
			?>
			<div class="updated levelup-message levelup-notice-wrapper levelup-notice-install-now" style="position:relative;">
		        <h3 class=""><?php printf( esc_html__( 'Thanks for choosing %s', LEVELUP_TEXT_DOMAIN ), 'Levelup' ); ?></h3>
		        <p class="levelup-notice-description"><?php printf( __( 'To take full advantages of Levelup Plugin, please install %s Theme.', 'level-up' ), '<strong>Level-UP</strong>' ); ?></p>
		        <p class="submit">
		            <a target="_blank" href="<?php echo admin_url( "theme-install.php?search=level-up" )?>" ><?php echo esc_html__('Get Theme', LEVELUP_TEXT_DOMAIN)?></a>
		            <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'levelup-hide-core-theme-notice', 'install' ), 'levelup_hide_notices_nonce', '_notice_nonce' ) ); ?>" class="notice-dismiss levelup-close-notice"><span class="screen-reader-text"><?php _e( 'Skip', 'level-up' ); ?></span></a>
		        </p>
		    </div>
			<?php
		}
	}
}

new \LevelUPElementorThemeSettings\LEVELUP__Admin_settings();