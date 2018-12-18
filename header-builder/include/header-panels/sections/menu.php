<?php
namespace HeaderBuilder\headerPanels\sections;
class MenuDesign{
	public $id = 'menu';
	public $name = 'Menu';
	public $nameslug = 'menu-';
	public $api_type = 'wp_section';
	public $width = '6';
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
					'title'    			=> __($this->name, HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'description' 		=> __('Menu options', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN)
				),

				
				//settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'menu'. $this->panel,
					'capability'        => 'edit_theme_options',
					"default"			=> "Black",
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'menu'. $this->panel,
			        'section' 			=> $this->nameslug. $this->panel,
			        'label'   			=> __('Enter COlor', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'text'
			    ),

			);
	}

	function render()
    {
        $style = '';
        $container_classes = $this->id . ' ' . $this->id . '-__id__ nav-menu-__device__ ' . $this->id . '-__device__' . ($style ? ' ' . $style : '');
        echo '<nav  id="site-navigation-__id__-__device__" class="site-navigation ' . $container_classes . '" class="nav-menu">';
        wp_nav_menu();

        echo '</nav>';

    }
}




/**
 * Change menu item ID
 *
 * @see Walker_Nav_Menu::start_el();
 *
 * @param $string_id
 * @param $item
 * @param $args An object of wp_nav_menu() arguments.
 * @return mixed
 */
/*function headerfooter_builder_change_nav_menu_item_id( $string_id , $item, $args ){
    if ( $args->theme_location == 'menu-1' || $args->theme_location == 'menu-2' ) {
        $string_id = 'menu-item--__id__-__device__-'.$item->ID;
    }

    return $string_id;
}
add_filter( 'nav_menu_item_id', 'headerfooter_builder_change_nav_menu_item_id', 55, 3 );
*/

/**
 * Add Nav icon to menu
 *
 * @param $title
 * @param $item
 * @param $args
 * @param $depth
 * @return string
 */
/*function headerfooter_builder_add_icon_to_menu($title, $item, $args, $depth)
{
    if (in_array('menu-item-has-children', $item->classes)) {

        $title .= '<span class="nav-icon-angle">&nbsp;</span>';

    }
    return $title;
}
add_filter('nav_menu_item_title', 'headerfooter_builder_add_icon_to_menu', 25, 4);
*/
/**
 * Add more sub menu classes
 * @since 0.1.1
 * @see Walker_Nav_Menu::start_lvl
 *
 * @param $classes
 * @param $args
 * @param $depth
 * @return array
 */
/*function headerfooter_builder_add_sub_menu_classes( $classes, $args, $depth ){
    $classes[] ='sub-lv-'.$depth;
    return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'headerfooter_builder_add_sub_menu_classes', 35, 3 );*/