<?php
namespace HeaderBuilder\footerPanels\sections;
class footerCopyrightDesign{
	public $id = 'copyright';
	public $name = 'Copyright';
	public $nameslug = 'copyright-';
	public $api_type = 'wp_section';
	public $width = '4';
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
                    'width'             => '4',
					'title'    			=> __($this->name, HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'description' 		=> __('Menu options', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN)
				),

				
				//settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'html'. $this->panel,
					'capability'        => 'edit_theme_options',
					"default"			=> "Copyright @ 2019",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'html'. $this->panel,
			        'section' 			=> $this->nameslug. $this->panel,
			        'label'   			=> __('Enter Custom text', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'textarea'
			    ),

			);
	}

	function render(){
        $content = headerfooter_get_setting( 'html'. $this->panel );
        echo '<div class="cp-right builder-header-'.esc_attr( $this->id ).'-item item--html">';
        echo apply_filters('levelup_the_content', wp_kses_post( balanceTags( $content, true ) ) );
        echo '</div>';
    }
}