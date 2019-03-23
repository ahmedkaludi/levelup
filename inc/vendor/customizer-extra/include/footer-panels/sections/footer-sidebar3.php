<?php
namespace HeaderBuilder\footerPanels\sections;
class footerSidebar3Design{
	public $id = 'footer-widget-3';
	public $name = 'Footer widget 3';
	public $nameslug = 'footer-widget-3-';
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
					'title'    			=> esc_html__($this->name, HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'description' 		=> esc_html__('Menu options', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN)
				),
				array(
					'api_type'			=> 'wp_widget',
					'id'				=> 'footer-widget-3',
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
			        'label'   			=> esc_html__('Add Widget', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    )
			   
			);
	}

	function render( $item_config = array() ) {
		$show = false;
		$footer_id = 'footer-widget-3';
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
	                'title'  => sprintf(__('Footer Widget %s', 'levelup'), $id),
	                'text'   => sprintf( // WPCS: XSS ok.
	                /*
	                Translators:
	                    1: Admin URL
	                    2: Customize URL
	                    3: Footer ID
	                */
	                   '<p>%s <a href="%s"><strong>%s %s</strong></a> %s</p>', esc_html__('Replace this widget content by going to', 'levelup'),
	                    esc_url(admin_url('customize.php?autofocus[section]=sidebar-widgets-footer-' . $id)),esc_html__('Appearance &rarr; Customize &rarr; Footer &rarr; Footer', 'levelup'),$id, esc_html__('and adding widgets into this widget area.', 'levelup')
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