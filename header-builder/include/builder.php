<?php
namespace HeaderBuilder;

Class HeaderBuild{
	static $instance;
	static function get_instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
	function init(){
		add_action( 'customize_controls_enqueue_scripts', array($this, 'hfbuilder_customize_controls_scripts') );
		add_action( 'customize_controls_print_styles', array($this, 'hfbuilder_customize_controls_styles') );

		add_action( 'customize_register', array($this, 'register_options') );
		
		add_action( 'customize_controls_enqueue_scripts', array($this,'customizer_live_preview_scripts' ));
		

        add_action( 'wp_enqueue_scripts', array($this, 'add_theme_scripts') );

		//Builder
		add_action( 'admin_print_scripts', array( $this, 'builder_template' ) );
	}

	function get_builders(){
        $designs = new \HeaderBuilder\headerPanels\headerPanels();
        $headerOpt = $designs->panel_builder_options();

        //Footer
        $designs = new \HeaderBuilder\footerPanels\footerPanels();
        $footerOpt = $designs->panel_builder_options();
        return array_merge($headerOpt, $footerOpt);
    }
    function get_designs(){
		$designs = new \HeaderBuilder\headerPanels\headerPanels();
		$headerOpt = $designs->panel_design_options();

        //Footer
        $designs = new \HeaderBuilder\footerPanels\footerPanels();
        $footerOpt = $designs->panel_design_options();
		return array_merge($headerOpt,$footerOpt);
	}

    function add_theme_scripts() {
      wp_enqueue_style( 'header-style', esc_url(HEADER_FOOTER_PLUGIN_DIR_URI.'assets/css/header_style.css') );
    }
	
	function customizer_live_preview_scripts(){
		wp_enqueue_script( 'customize-controls');
		wp_enqueue_script( 
			  'HF-Builder',			//Give the script an ID
			  HEADER_FOOTER_PLUGIN_DIR_URI.'/assets/js/header-builder-customizer.js',//Point to file
			  array(
			  	'customize-controls',
	            'jquery-ui-resizable',
	            'jquery-ui-droppable',
	            'jquery-ui-draggable' ),	//Define dependencies
			  false,						//Define a version (optional) 
			  true						//Put script in footer?
		);
		wp_localize_script( 'HF-Builder', 'HF_Builder', array(
            'builders'  => $this->get_builders(),
            'is_rtl'    => '',
            'designs'  => $this->get_designs(),
        ) );
        wp_localize_script( 'HF-Builder', 'HF_Designs', array(
            'designs'  => $this->get_designs(),
          
        ) );
        
	}

	function register_options($wp_customize){
		include HEADER_FOOTER_PLUGIN_PATH_INCLUDE.'customize-panel.php';
		include HEADER_FOOTER_PLUGIN_PATH_INCLUDE.'customize-section.php';

		$wp_customize->register_panel_type( '\HFBuilder_WP_Customize_Panel' );
  		$wp_customize->register_section_type( '\HFBuilder_WP_Customize_Section' );

		$options = $this->get_options();
		//print_r($options);die;
		foreach($options as $args){
			$id = $args['id'];
			$type = $args['api_type'];
			unset($args['id']);
			unset($args['api_type']);
			switch ($type) {
				case 'hf_panel':
					$lvlParentPanel = new \HFBuilder_WP_Customize_Panel( $wp_customize, $id, $args);

					$wp_customize->add_panel( $lvlParentPanel );
					break;
				case 'wp_panel':
					$wp_customize->add_panel($id,$args);
					break;
				case 'hf_section':
                    if($id == 'header_setting_section' || $id == 'footer_panel_settings'){
                     $args['sanitize_callback'] = 'header_footer_santizer';
                    }
					$lvl1ParentSection = new \HFBuilder_WP_Customize_Section(  $wp_customize, $id, $args);
					$wp_customize->add_section($lvl1ParentSection);
					break;
				case 'wp_section':
					$wp_customize->add_section($id,$args);
					break;
				case 'wp_settings':
                    if($id == 'header_panel_settings'){
                        $args['sanitize_callback'] = 'header_footer_santizer';
                    }
					$wp_customize->add_setting($id,$args);
					break;
				case 'wp_control':
					$wp_customize->add_control($id,$args);
				default:
					# code...
					break;
			}
		}
		

	}

	function hfbuilder_customize_controls_scripts() {
	  wp_enqueue_script( 'level-customizer-js', HEADER_FOOTER_PLUGIN_DIR_URI. '/assets/js/level-customizer-js.js' , array(), '1.0', true );
	}

	function hfbuilder_customize_controls_styles() {
	  wp_enqueue_style( 'level-customizer-css', HEADER_FOOTER_PLUGIN_DIR_URI.'/assets/css/level-customizer-css.css', array(), '1.0' );
	}



	

	function get_options(){
		require_once HEADER_FOOTER_PLUGIN_PATH_INCLUDE.'header-panels/header-panels.php';
        $headers = new \HeaderBuilder\headerPanels\headerPanels();
        $returnJson = $headers->config_options();

        require_once HEADER_FOOTER_PLUGIN_PATH_INCLUDE.'footer-panels/footer-panels.php';
		$footer = new \HeaderBuilder\footerPanels\footerPanels();
		$footerReturnJson = $footer->config_options();
        return array_merge($returnJson,$footerReturnJson);
    }

    /**
     * Builder Template
     */
	function builder_template() {
		?>
        <script type="text/html" id="template-headerfooter--builder-panel">
            <div class="customify--customize-builder">
                <div class="customify--cb-inner">
                    <div class="customify--cb-header">
                        <div class="customify--cb-devices-switcher">
                        </div>
                        <div class="customify--cb-actions">
                        </div>
                    </div>
                    <div class="customify--cb-body"></div>
                </div>
            </div>
        </script>


        <script type="text/html" id="tmpl-customify--cb-panel">
            <div class="customify--cp-rows">

                <# if ( ! _.isUndefined( data.rows.top ) ) { #>
                    <div class="customify--row-top customify--cb-row" data-id="{{ data.id }}_top">
                        <a class="customify--cb-row-settings" title="{{ data.rows.top }}" data-id="top-header-design" href="#"></a>
                        <div class="customify--row-inner">
                            <div class="row--grid">
								<?php for ( $i = 1; $i <= 12; $i ++ ) {
									echo '<div></div>';
								} ?>
                            </div>
                            <div class="customify--cb-items grid-stack gridster" data-id="top"></div>
                        </div>
                    </div>
                <#  } #>

                <# if ( ! _.isUndefined( data.rows.main ) ) { #>
                    <div class="customify--row-main customify--cb-row" data-id="{{ data.id }}_main">
                        <a class="customify--cb-row-settings" title="{{ data.rows.main }}" data-id="middle-header-design"
                           href="#"></a>

                        <div class="customify--row-inner">
                            <div class="row--grid">
                                <?php for ( $i = 1; $i <= 12; $i ++ ) {
                                    echo '<div></div>';
                                } ?>
                            </div>
                            <div class="customify--cb-items grid-stack gridster" data-id="main"></div>
                        </div>
                    </div>
                <#  } #>


                <# if ( ! _.isUndefined( data.rows.bottom ) ) { #>
                    <div class="customify--row-bottom customify--cb-row" data-id="{{ data.id }}_bottom">
                        <a class="customify--cb-row-settings" title="{{ data.rows.bottom }}"
                           data-id="bottom-header-design" href="#"></a>
                        <div class="customify--row-inner">
                            <div class="row--grid">
                                <?php for ( $i = 1; $i <= 12; $i ++ ) {
                                    echo '<div></div>';
                                } ?>
                            </div>
                            <div class="customify--cb-items grid-stack gridster" data-id="bottom"></div>
                        </div>
                    </div>
                <#  } #>
            </div>


            <# if ( data.device != 'desktop' ) { #>
                <# if ( ! _.isUndefined( data.rows.sidebar ) ) { #>
                    <div class="customify--cp-sidebar">
                        <div class="customify--row-bottom customify--cb-row" data-id="{{ data.id }}_sidebar">
                            <a class="customify--cb-row-settings" title="{{ data.rows.sidebar }}" data-id="sidebar-header-design"
                               href="#"></a>
                            <div class="customify--row-inner">
                                <div class="customify--cb-items customify--sidebar-items" data-id="sidebar"></div>
                            </div>
                        </div>
                        <div>
                <# } #>
            <# } #>

        </script>

        <script type="text/html" id="tmpl-customify--cb-item">
            <div class="grid-stack-item item-from-list for-s-{{ data.section }}"
                 title="{{ data.name }}"
                 data-id="{{ data.id }}"
                 data-section="{{ data.section }}"
                 data-control="{{ data.control }}"
                 data-gs-x="{{ data.x }}"
                 data-gs-y="{{ data.y }}"
                 data-gs-width="{{ data.width }}"
                 data-df-width="{{ data.width }}"
                 data-gs-height="1"
            >
                <div class="item-tooltip" data-section="{{ data.section }}">{{ data.name }}</div>
                <div class="grid-stack-item-content">
                    <span class="customify--cb-item-name" data-section="{{ data.section }}">{{ data.name }}</span>
                    <span class="customify--cb-item-remove customify-cb-icon"></span>
                    <span class="customify--cb-item-setting customify-cb-icon" data-section="{{ data.section }}"></span>
                </div>
            </div>
        </script>

        <script type="text/html" id="customify-upsell-tmpl">
            <p class="customify-upsell-panel"><?php _e( '', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN ); ?></p>
        </script>
	<?php
		
	}//function closed


}//Builder Class End here