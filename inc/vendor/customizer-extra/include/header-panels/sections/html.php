<?php
namespace HeaderBuilder\headerPanels\sections;
class HtmlDesign{
	public $id = 'html';
	public $name = 'HTML';
	public $nameslug = 'html-';
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
                    'width'             => $this->width,
					'title'    			=> esc_html__($this->name, HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'description' 		=> esc_html__('Menu options', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN)
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
			        'label'   			=> esc_html__('Enter Custom text', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'textarea'
			    ),

			);
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}

	function render(){
        $content = headerfooter_get_setting( 'html'. $this->panel );
       	echo sprintf('<div class="builder-header-%s-item item--html">%s</div>',esc_attr( $this->id ), $content);
       
    }
}