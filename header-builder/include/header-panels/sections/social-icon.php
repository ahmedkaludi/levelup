<?php
namespace HeaderBuilder\headerPanels\sections;
class SocialiconDesign{
	public $id = 'social-icon';
	public $name = 'Social Icon';
	public $nameslug = 'social-icon-';
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
					'id'				=> 'facebook'. $this->panel,
					'capability'        => 'edit_theme_options',
					"default"			=> "ADD CUSTOM TEXT HERE OR REMOVE IT",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'facebook'. $this->panel,
			        'section' 			=> $this->nameslug. $this->panel,
			        'label'   			=> __('Facebook', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),
			    //settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'twitter'. $this->panel,
					'capability'        => 'edit_theme_options',
					"default"			=> "ADD CUSTOM TEXT HERE OR REMOVE IT",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'twitter'. $this->panel,
			        'section' 			=> $this->nameslug. $this->panel,
			        'label'   			=> __('Twitter', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),
			    //settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'googleplus'. $this->panel,
					'capability'        => 'edit_theme_options',
					"default"			=> "ADD CUSTOM TEXT HERE OR REMOVE IT",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'googleplus'. $this->panel,
			        'section' 			=> $this->nameslug. $this->panel,
			        'label'   			=> __('Google +', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),

			);
	}

	function render( $item_config = array() ) {

		$item['url']['facebook'] = headerfooter_get_media( 'facebook'. $this->panel);
		$item['url']['twitter'] = headerfooter_get_media( 'twitter'. $this->panel);
		$item['url']['googleplus'] = headerfooter_get_media( 'googleplus'. $this->panel );
		
		$item['url'] = array_filter($item['url']);

		$rel = '';
		if ( $nofollow == 1 ) {
			$rel = 'rel="nofollow" ';
		}

		$target       = '_self';
		if ( $target_blank == 1 ) {
			$target = '_blank';
		}

		if ( ! empty( $items ) ) {
          
			echo '<div class="scl-icns">
					<ul class="">';
			foreach ( ( array ) $items as $index => $item ) {
				

				
				
				
				if ( $item['url'] && $icon['icon'] ) {
					echo '<li><a class="social-'. str_replace( array( ' ', 'fa-fa' ), array( '-', 'icon' ), esc_attr( $icon['icon'] )) . $shape. '" '.$rel.'target="' . esc_attr( $target ) . '" href="' . esc_url( $item['url'] ) . '">';
					if ( $icon['icon'] ) {
						echo '<i class="icon ' . esc_attr( $icon['icon'] ) . '" title="' . esc_attr( $item['title'] ) . '"></i>';
					}
					if ( $item['url'] ) {
						echo '</a>';
					}
					echo '</li>';
				}

				

				
				

			}

			echo '</ul>';
		}

	}
}