<?php
namespace HeaderBuilder\headerPanels\sections;
class SearchDesign{
	public $id = 'search';
	public $name = 'Search';
	public $nameslug = 'search-';
	public $api_type = 'wp_section';
	public $panel = '';
	public $panelName = '';
	function __construct($panel,$panelName){
		$this->panel = $panel; 
		$this->panelName = $panelName; 
		$this->id = $this->nameslug. $this->panel;
        add_action('wp_enqueue_scripts', array($this, 'search_scripts')); 
	}
	function getFields(){
		return array(
				array(
					'api_type'			=> 'wp_section',
					'id' 				=> $this->nameslug. $this->panel,
			        'panel'    			=> $this->panel,
			        'panel_name'    	=> $this->panelName,
                    'width'             => '1',
					'title'    			=> __($this->name, HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'description' 		=> __('Section description which does show up', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN)
				),

				
				//settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'setting'. $this->panel,
					'capability'        => 'edit_theme_options',
					"default"			=> "Enter Item",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'setting'. $this->panel,
			        'section' 			=> $this->nameslug. $this->panel,
			        'label'   			=> __('Placeholder', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),

			);
	}
    function search_scripts(){
        wp_enqueue_script( 'modernizr.custom',  esc_url(HEADER_FOOTER_PLUGIN_DIR_URI. '/assets/js/modernizr.custom.js'), array( ), '', true );
        wp_enqueue_script( 'classie', esc_url(HEADER_FOOTER_PLUGIN_DIR_URI . '/assets/js/classie.js'), array( ), '', true );
        wp_enqueue_script( 'demo1',  esc_url(HEADER_FOOTER_PLUGIN_DIR_URI. '/assets/js/demo1.js'), array( ), '', true );
        
    }
    function render(){

        ?>
        <div class="sr">
          <button id="trigger-overlay" type="button">
              <span class="fa fa-search"></span>
          </button>
        </div>
        <div class="overlay overlay-slidedown" id="search-overlay">
          <div class="ov-form">
            <form action="http://themenectar.com/demo/salient-blog-magazine/" method="GET">
                <input type="text" name="s" value="" placeholder="Search">
                <span class="sr-txt">Hit Enter to Search</span> 
            </form>
            <button class="overlay-close">
              <span class="fa fa-close"></span>
            </button>
          </div>
        </div>
        <?php
    }
}
