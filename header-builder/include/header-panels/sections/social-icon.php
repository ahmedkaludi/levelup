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
					"default"			=> "https://www.facebook.com/wordpress",
			        'sanitize_callback' => 'sanitize_textarea_field',
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
					"default"			=> "https://twitter.com/wordpress",
			        'sanitize_callback' => 'sanitize_textarea_field',
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
					"default"			=> "https://plus.googleplus.com/wordpress",
			        'sanitize_callback' => 'sanitize_textarea_field',
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
			    //settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'instagram'. $this->panel,
					'capability'        => 'edit_theme_options',
					"default"			=> "https://www.instagram.com/",
			        'sanitize_callback' => 'sanitize_textarea_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'instagram'. $this->panel,
			        'section' 			=> $this->nameslug. $this->panel,
			        'label'   			=> __('Instagram', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),

			);
	}

	function render( $item_config = array() ) {
		if(headerfooter_get_setting( 'facebook'. $this->panel)){
			$items['facebook']['url'] = headerfooter_get_setting( 'facebook'. $this->panel);
			$items['facebook']['icon'] = 'facebook';
			$items['facebook']['title'] = 'facebook';
		}
		if(headerfooter_get_setting( 'twitter'. $this->panel)){
			$items['twitter']['url'] = headerfooter_get_setting( 'twitter'. $this->panel);
			$items['twitter']['icon'] = 'twitter';
			$items['twitter']['title'] = 'twitter';
		}
		if(headerfooter_get_setting( 'twitter'. $this->panel)){
			$items['googleplus']['url'] = headerfooter_get_setting( 'googleplus'. $this->panel );
			$items['googleplus']['icon'] = 'googleplus';	
			$items['googleplus']['title'] = 'googleplus';	
		}
		if(headerfooter_get_setting( 'instagram'. $this->panel)){
			$items['googleplus']['url'] = headerfooter_get_setting( 'instagram'. $this->panel );
			$items['googleplus']['icon'] = 'instagram';	
			$items['googleplus']['title'] = 'Instagram';	
		}
		
		$items = array_filter($items);
		$rel = '';
		if (isset( $nofollow) && $nofollow == 1 ) {
			$rel = 'rel="nofollow" ';
		}

		$target       = '_self';
		if (isset($target_blank) && $target_blank == 1 ) {
			$target = '_blank';
		}

		if ( ! empty( $items ) ) {
          
			echo '<div class="scl-icns social-navigation">
					<ul class="">';
			foreach ( ( array ) $items as $index => $item ) {

				
				
				
				if ( $item['url'] && $item['icon'] ) {
					echo '<li><a class="social-'. str_replace( array( ' ', 'fa-fa' ), array( '-', 'icon' ), esc_attr( $item['icon'] )) . '" '.$rel.'target="' . esc_attr( $target ) . '" href="' . esc_url( $item['url'] ) . '">';
					if ( $item['icon'] ) {
						echo '<i class="icon ' . esc_attr( $item['icon'] ) . '" title="' . esc_attr( $item['title'] ) . '"></i><span class="screen-reader-text">' . esc_attr( $item['title'] ) . '</span>';
					}
					if ( $item['url'] ) {
						echo '</a>';
					}
					echo '</li>';
				}

			}

			echo '</ul></div>';
		}

	}
}