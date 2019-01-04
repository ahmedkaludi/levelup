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
    	global $redux_builder_amp;
    	$action_url = '';
    	$amp_query_variable = '';
		$amp_query_variable_val = '';
    	$action_url = esc_url( get_bloginfo('url') );
		$action_url = preg_replace('#^http?:#', '', $action_url);
		$label = ampforwp_translation(isset($redux_builder_amp['ampforwp-search-label']) && $redux_builder_amp['ampforwp-search-label'], 'Type your search query and hit enter');
		$placeholder = ampforwp_translation($redux_builder_amp['ampforwp-search-placeholder'], 'Type Here' );
		if ( isset($redux_builder_amp['ampforwp-amp-takeover']) && !$redux_builder_amp['ampforwp-amp-takeover'] ) {
			$amp_query_variable = 'amp';
			$amp_query_variable_val = '1';
		}
        ?>
        <script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
        <div class="sr">
          <button id="trigger-overlay" type="button" on="tap:AMP.setState({visible: !visible})">
              <span class="fa fa-search"></span>
          </button>
        </div>
        <div [class]="visible ? 'overlay overlay-slidedown open' : 'overlay overlay-slidedown close'"  class="overlay overlay-slidedown" id="search-overlay">
          <div class="ov-form">
            <form role="search" target="_top" id="searchform" class="searchform" action="<?php echo $action_url;?>" method="GET">
                <input type="text" name="<?php echo $amp_query_variable;?>" value="<?php echo $amp_query_variable_val;?>" placeholder="AMP" class="hide" id="ampforwp_search_query_item">
                <input type="text" placeholder="Search" value="<?php echo get_search_query();?>" name="s" id="s" />
                <input type="submit" id="searchsubmit" />
                <span class="sr-txt"><?php echo $label;?></span> 
            </form>
            <button class="overlay-close" on="tap:AMP.setState({visible: !visible})">
              <span class="fa fa-close"></span>
            </button>
          </div>
        </div>
        <?php
    }
}
