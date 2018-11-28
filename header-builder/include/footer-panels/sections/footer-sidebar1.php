<?php
namespace HeaderBuilder\footerPanels\sections;
class footerSidebar1Design{
	public $id = 'footer-widget-1';
	public $name = 'Footer widget 1';
	public $nameslug = 'footer-widget-1-';
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
				array(
					'api_type'			=> 'wp_widget',
					'id'				=> 'footer-widget-1',
					'capability'        => 'edit_theme_options',
					'panel'    			=> $this->panel,
					'section'    		=> $this->nameslug. $this->panel,
			        'transport'			=> 'postMessage'
			    ),
			    array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'widgets-f-'. $this->id,
					'capability'        => 'edit_theme_options',
			        'transport'			=> 'postMessage'
			    ),
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'widgets-f-'. $this->id,
			        'section' 			=> $this->nameslug. $this->panel,
			        'label'   			=> __('Add Widget', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    )

			   /* //settings
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
			    ),*/
			   
			);
	}

	function render( $item_config = array() ) {
		$show = false;
		$footer_id = 'footer-widget-1';
	    if ( is_active_sidebar( $footer_id ) ) {
	        echo '<div class="widget-area">';
	        dynamic_sidebar($footer_id);
	        $show = true;
	        echo '</div>';
	    }

	    // Show admin notice
	    if ( ! $show ) {
	        if (current_user_can('edit_theme_options')) {
	            echo '<div class="widget-area">';
	            $id = str_replace('footer-', '', $footer_id);
	            the_widget('WP_Widget_Text', array(
	                'title'  => sprintf(__('Footer Widget %s', 'customify'), $id),
	                'text'   => sprintf( // WPCS: XSS ok.
	                /*
	                Translators:
	                    1: Admin URL
	                    2: Customize URL
	                    3: Footer ID
	                */
	                    __('<p>Replace this widget content by going to <a href="%1$s"><strong>Appearance &rarr; Customize &rarr; Footer &rarr; Footer %2$s</strong></a> and adding widgets into this widget area.</p>', 'customify'),
	                    esc_url(admin_url('customize.php?autofocus[section]=sidebar-widgets-footer-' . $id)),
	                    $id
	                ),
	                'filter' => true,
	                'visual' => true,
	            ), array(
	                'before_widget' => '<section id="placeholder-widget-text" class="widget widget_text">',
	                'after_widget'  => '</section>',
	                'before_title'  => '<h4 class="widget-title">',
	                'after_title'   => '</h4>',
	            ));
	            echo '</div>';
	        }
	    }
	}
}
