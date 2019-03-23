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
					'title'    			=> esc_html__($this->name, HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'description' 		=> esc_html__('Currently no options created', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN)
				),

				
				//settings

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
		if(function_exists('ampforwp_translation')){
			$label = ampforwp_translation(isset($redux_builder_amp['ampforwp-search-label']) && $redux_builder_amp['ampforwp-search-label'], 'Type your search query and hit enter');
		}else{
			$label =  esc_html__('Type your search query and hit enter',LEVELUP_TEXT_DOMAIN);
		}
		if(function_exists('ampforwp_translation')){
			$placeholder = ampforwp_translation($redux_builder_amp['ampforwp-search-placeholder'], 'Type Here' );
		}else{
			$placeholder = esc_html__('Type Here', LEVELUP_TEXT_DOMAIN);
		}
		if ( isset($redux_builder_amp['ampforwp-amp-takeover']) && !$redux_builder_amp['ampforwp-amp-takeover'] ) {
			$amp_query_variable = 'amp';
			$amp_query_variable_val = '1';
		}

if ( (function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint()) ||  (function_exists( 'is_wp_amp' ) && is_wp_amp()) || (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) ) { ?>
        <div class="sr">
          <button id="trigger-overlay" type="button" on="tap:AMP.setState({visible: !visible})">
              <span class="fa fa-search"></span>
          </button>
        </div>
        <div [class]="visible ? 'overlay overlay-slidedown open' : 'overlay overlay-slidedown close'"  class="overlay overlay-slidedown" id="search-overlay">
          <div class="ov-form">
            <form role="search" target="_top" id="searchform" class="searchform" action="<?php echo esc_url($action_url);?>" method="GET">
                <input type="text" name="<?php echo $amp_query_variable;?>" value="<?php echo $amp_query_variable_val;?>" placeholder="AMP" class="hide" id="ampforwp_search_query_item">
                <input type="text" placeholder="Search" value="<?php echo get_search_query();?>" name="s" id="s" />
                <button type="submit" class="btn-sbt"></button>
                <span class="sr-txt">Hit Enter to Search</span> 
            </form>
            <button class="overlay-close" on="tap:AMP.setState({visible: !visible})">
              <span class="fa fa-close"></span>
            </button>
          </div>
        </div>
        <?php
    	}else{
    		?>
    		<div class="sr">
          <button id="trigger-overlay" type="button" on="tap:AMP.setState({visible: !visible})">
              <span class="fa fa-search"></span>
          </button>
        </div>
        <div [class]="visible ? 'overlay overlay-slidedown open' : 'overlay overlay-slidedown close'"  class="overlay overlay-slidedown" id="search-overlay">
          <div class="ov-form">
           <form role="search" method="get" class="levelup-fullscreen-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		          <input type="search" class="search-field"
		              placeholder="<?php echo esc_attr_x( 'Search', 'label', 'level-up' ) ?>"
		              value="<?php echo esc_attr( get_search_query() ); ?>" name="s"
		              title="<?php echo esc_attr_x( 'Search for:', 'label', 'level-up' ) ?>" id="levelup-fullscreen-search-input"/>
			      <span class="sr-txt">Hit Enter to Search</span> 
			</form>
            <button class="overlay-close" on="tap:AMP.setState({visible: !visible})">
              <span class="fa fa-close"></span>
            </button>
          </div>
        </div>
    		<?php
    	}
    }
}
