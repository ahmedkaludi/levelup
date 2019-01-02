<?php
namespace HeaderBuilder\headerPanels\sections;
class LogoDesign{
	public $id = 'logo';
	public $name = 'Logo Design';
	public $nameslug = 'logo-';
    public $api_type = 'wp_section';
	public $width = '3';
	public $panel = '';
	public $panelName = '';
	function __construct($panel,$panelName){
		$this->panel = $panel; 
		$this->panelName = $panelName; 
		$this->id = $this->nameslug. $this->panel;
	}
    function item(){
        return array(
                    'name' => $this->name,
                    'id'   => $this->id,
                    'col'  => 0,
                    'width'=> $this->width,
                    'section'=> $this->panel
                    );
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
                    'render_callback'   => array($this, 'render'),
			        'section' 			=> $this->nameslug. $this->panel,
			        'label'   			=> __('Enter Site name', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),
                //settings show_name
                array(
                    'api_type'          => 'wp_settings',
                    'id'                => 'show_name'. $this->panel,
                    'capability'        => 'edit_theme_options',
                    "default"           => "yes",
                    'sanitize_callback' => 'sanitize_text_field',
                    'transport'         => 'postMessage'
                ),
                //control
                array(
                    'api_type'          => 'wp_control',
                    'id'                => 'show_name'. $this->panel,
                    'render_callback'   => array($this, 'render'),
                    'section'           => $this->nameslug. $this->panel,
                    'label'             => __('Enter Site name', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
                    'type'              => 'checkbox'
                ),

                //settings show_name
                array(
                    'api_type'          => 'wp_settings',
                    'id'                => 'show_desc'. $this->panel,
                    'capability'        => 'edit_theme_options',
                    "default"           => "",
                    'sanitize_callback' => 'sanitize_text_field',
                    'transport'         => 'postMessage'
                ),
                //control
                array(
                    'api_type'          => 'wp_control',
                    'id'                => 'show_desc'. $this->panel,
                    'render_callback'   => array($this, 'render'),
                    'section'           => $this->nameslug. $this->panel,
                    'label'             => __('Enter Site Description', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
                    'type'              => 'checkbox'
                ),

			);
	}

	function logo(){
        $custom_logo_id = esc_attr( get_theme_mod( 'custom_logo' ) );
        $logo_image = '';
            if( $custom_logo_id ) {
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                $logo_image = $logo[0];
            }
        //$logo_image = headerfooter_get_media( $custom_logo_id, 'full' );
        $logo_retina = '';//headerfooter_get_setting( 'header_logo_retina' );
        $logo_retina_image = '';//headerfooter_get_media( $logo_retina );
        if ( $logo_image ) {
            ?>
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link" rel="home" itemprop="url">
                    <img class="site-img-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_attr_e( 'Logo', 'levelup' ); ?>"<?php if ($logo_retina_image) { ?> srcset="<?php echo esc_url($logo_retina_image); ?> 2x"<?php } ?>>
                    <?php do_action( 'customizer/after-logo-img' ); ?>
                </a>
            </div>
             
            <?php
        }
    }

	function render(){
        $show_name      = headerfooter_get_setting( 'show_name'. $this->panel );
        $show_desc      = headerfooter_get_setting( 'show_desc'. $this->panel );
        $image_position = headerfooter_get_setting( 'header_logo_pos' );
        $site_name      = headerfooter_get_setting( 'site_name'. $this->panel );
        $logo_classes = array( 'site-branding'  );
        $logo_classes[] = 'logo-'.$image_position;
        $logo_classes = apply_filters( 'customify/logo-classes', $logo_classes );
        ?>
        <div class="<?php echo esc_attr( join(' ', $logo_classes ) ); ?>">
            <?php
            if(!$show_name){
                $show_name = 'no';    
            }
            if(!$show_desc){
                $show_desc = 'no';    
            }
            
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
