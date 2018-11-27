<?php
namespace HeaderBuilder\headerPanels\sections;
class LogoDesign{
	public $id = 'logo';
	public $name = 'Logo Design';
	public $nameslug = 'logo-';
	public $api_type = 'wp_section';
	public $panel = '';
	public $panelName = '';
	function __construct($panel,$panelName){
		$this->panel = $panel; 
		$this->panelName = $panelName; 
		$this->id = $this->nameslug. $this->panel;
	}
	function getFields(){
		return array(
				array(
					'api_type'			=> 'wp_section',
					'id' 				=> $this->nameslug. $this->panel,
			        'panel'    			=> $this->panel,
			        'panel_name'    	=> $this->panelName,
                    'width'             => '3',
					'title'    			=> __($this->name, HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'description' 		=> __('Section description which does show up', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN)
				),

				
				//settings
                array(
                    'api_type'          => 'wp_settings',
                    'id'                => 'setting'. $this->panel,
                    'capability'        => 'edit_theme_options',
                    "default"           => "Black",
                    'sanitize_callback' => 'sanitize_text_field',
                    'transport'         => 'postMessage'
                ),
                //control
                array(
                    'api_type'          => 'wp_control',
                    'id'                => 'setting'. $this->panel,
                    'section'           => $this->nameslug. $this->panel,
                    'label'             => __('Enter COlor', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
                    'type'              => 'text'
                ),


                //settings Sitename
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'site_name'. $this->panel,
					'capability'        => 'edit_theme_options',
					"default"			=> "My Website",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'site_name'. $this->panel,
			        'section' 			=> $this->nameslug. $this->panel,
			        'label'   			=> __('Enter Site name', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),

			);
	}

	function logo(){
        $custom_logo_id = headerfooter_get_media( 'custom_logo' );
        $logo_image = headerfooter_get_media( $custom_logo_id, 'full' );
        $logo_retina = headerfooter_get_setting( 'header_logo_retina' );
        $logo_retina_image = headerfooter_get_media( $logo_retina );
        if ( $logo_image ) {
            ?>
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link" rel="home" itemprop="url">
                    <img class="site-img-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_attr_e( 'Logo', 'customify' ); ?>"<?php if ($logo_retina_image) { ?> srcset="<?php echo esc_url($logo_retina_image); ?> 2x"<?php } ?>>
                    <?php do_action( 'customizer/after-logo-img' ); ?>
                </a>
            </div>
             
            <?php
        }
    }

	function render(){
        $show_name      = headerfooter_get_setting( 'header_logo_name' );
        $show_desc      = headerfooter_get_setting( 'header_logo_desc' );
        $image_position = headerfooter_get_setting( 'header_logo_pos' );
        $site_name = headerfooter_get_setting( 'site_name'. $this->panel );
        $logo_classes = array( 'site-branding'  );
        $logo_classes[] = 'logo-'.$image_position;
        $logo_classes = apply_filters( 'customify/logo-classes', $logo_classes );
        ?>
        <div class="<?php echo esc_attr( join(' ', $logo_classes ) ); ?>">
            <?php

            $this->logo();
            if ( $show_name !== 'no' ||  $show_desc !== 'no' ) {
                echo '<div class="site-name-desc">';
                if ($show_name !== 'no') {
                    if (is_front_page() && is_home()) : ?>
                        <__site_device_tag__ class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></__site_device_tag__>
                    <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                        <?php
                    endif;
                }

                if ($show_desc !== 'no') {
                    $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) { ?>
                        <p class="site-description text-uppercase text-xsmall"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                        <?php
                    };
                }
                echo '</div>';
            }

            ?>
        </div><!-- .site-branding -->
        <?php
    }
}
