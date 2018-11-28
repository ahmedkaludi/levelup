<?php
namespace HeaderBuilder\footerPanels\sections;
class footerCopyrightDesign{
	public $id = 'copyright';
	public $name = 'Copyright';
	public $nameslug = 'copyright-';
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
                    'width'             => '4',
					'title'    			=> __($this->name, HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'description' 		=> __('Menu options', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN)
				),

				
				//settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'html'. $this->panel,
					'capability'        => 'edit_theme_options',
					"default"			=> "ADD CUSTOM TEXT HERE OR REMOVE IT",
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
        echo '<div class="builder-header-'.esc_attr( $this->id ).'-item item--html">';
        echo apply_filters('customify_the_content', wp_kses_post( balanceTags( $content, true ) ) );
        echo '</div>';
    }
}