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
        $args  =array();
        $nav_menu_array = array();
        $defaults = array( 'hide_empty' => false, 'orderby' => 'name' );
        $args = wp_parse_args( $args, $defaults );
        $nav_menu = get_terms( 'nav_menu',  $args);
        $defaultMenu = '';
        foreach($nav_menu as $nav){
            if(empty($defaultMenu)){
                $defaultMenu = $nav->slug;
            }
            $nav_menu_array[$nav->slug] = $nav->name;
        }
		return array(
				array(
					'api_type'			=> 'wp_section',
					'id' 				=> $this->nameslug. $this->panel,
			        'panel'    			=> $this->panel,
			        'panel_name'    	=> $this->panelName,
                    'width'             => $this->width,
					'title'    			=> __($this->name, HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'description' 		=> __('Select Menu to show in header panel', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN)
				),
                
               //settings
				array(
					'api_type'			=> 'wp_settings',
					'id'				=> 'menu'. $this->panel,
					'capability'        => 'edit_theme_options',
					"default"			=> $defaultMenu,
			        'sanitize_callback' => 'sanitize_text_field',
			        'transport'			=> 'postMessage'
			    ),
			    //control
			    array(
			    	'api_type'			=> 'wp_control',
			    	'id'				=> 'menu'. $this->panel,
			        'section' 			=> $this->nameslug. $this->panel,
			        'label'   			=> __('Select Menu', HEADER_FOOTER_PLUGIN_TEXT_DOMAIN),
			        'type'    			=> 'select',
                    'choices'           => $nav_menu_array,
                    'description'       => '<a href="'.esc_url(admin_url('customize.php?autofocus[panel]=nav_menus')).'">Manage Menu</a>'
			    ),

			);
	}

	function render()
    {
        $selected_menu = headerfooter_get_setting( 'menu'. $this->panel );
        $style = '';
        $container_classes = $this->id . ' ' . $this->id . '-__id__ nav-menu-__device__ ' . $this->id . '-__device__' . ($style ? ' ' . $style : '');
        echo '<nav  id="site-navigation-__id__-__device__" class="site-navigation  nav-menu  __device__ ' . $container_classes . '" class="nav-menu">';
        //wp_nav_menu();
        $menu_html_content = wp_nav_menu( array(
	            //'theme_location' => 'amp-menu',
	            'container'=>'aside',
	            'menu'=>$selected_menu,
                'menu_id' => 'nav',
	            'menu_class'=>'hd1-menu',
	            'echo' => false,
				'walker' => new Ampforwp_Walker_Nav_Menu()
	        ) );
        $menu_html_content = apply_filters('ampforwp_menu_content', $menu_html_content);
     //    $sanitizer_obj = new \AMPFORWP_Content( $menu_html_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array(), 'AMP_Style_Sanitizer' => array(), ) ) );
	    // $sanitized_menu =  $sanitizer_obj->get_amp_content();
    	echo $menu_html_content;
        echo '</nav>';

    }
}


/*Sidebar Nav menu Walker Start*/
  class Ampforwp_Walker_Nav_Menu extends \Walker_Nav_Menu {

  function start_lvl(&$output, $depth=0, $args = array(), $has_children = 0) {
  static $column = 1;
    $indent = str_repeat("\t", $depth);
      //$output .= "\n$indent<ul class=\"sub-menu\">\n";

      // Change sub-menu to dropdown menu
  if ($depth > 0 && $has_children > 0 )
    {
    $column += 1;
    $output .= "\n$indent<input type=\"checkbox\" id=\"drop-$column\"><label for=\"drop-$column\" class=\"toggle\"></label><ul class=\"sub-menu\">\n";
  }else{
    $column += 1;
    $output .= "\n$indent<input type=\"checkbox\" id=\"drop-$column\"><label for=\"drop-$column\" class=\"toggle\"></label><ul class=\"sub-menu\">\n";
    
  }
  }
  
  function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    // Most of this code is copied from original Walker_Nav_Menu
    global $wp_query, $wpdb;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    $class_names = join( ' ', apply_filters( 'ampforwp_nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = ' class="' . esc_attr( $class_names ) . '"';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

    $has_children = $wpdb->get_var($wpdb->prepare("SELECT COUNT(meta_id)
                            FROM {$wpdb->prefix}postmeta
                            WHERE meta_key='_menu_item_menu_item_parent'
                            AND meta_value='%d'", $item->ID) );

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $atts = array();
    $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
    $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
    $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
    $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr(  $atts['title'] ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $atts['target']     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $atts['rel']        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $atts['href']        ) .'"' : '';

    // Check if menu item is in main menu
    if ( $depth == 0 && $has_children > 0  ) {
        // These lines adds your custom class and attribute
        $attributes .= ' class="dropdown-toggle"';
        $attributes .= ' data-toggle="dropdown"';
    }

    $item_output = $args['before'];
  
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args['link_before'] . apply_filters( 'the_title', $item->title, $item->ID ) . $args['link_after'];
    $item_output .= '</a>';
  
  // Add the caret if menu level is 0
    if ( $has_children > 0  ) {
        //$item_output .= '<label for="drop-"'.$depth.' class="toggle">+</label>';
    }
    $item_output .= $args['after'];

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

}
/*Sidebar Nav menu Walker end*/




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