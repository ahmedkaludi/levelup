<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class LevelupDesign{
	public function __construct(){
		add_action('init',array($this, 'registerPostType'));
		add_action('init',array($this, 'registerTaxonomy'));
	}

	function registerPostType(){
		$labels = array(
		        'name'                => esc_html__( 'Design Library', LEVELUP_TEXT_DOMAIN ),
		        'singular_name'       => esc_html__( 'Design Library', LEVELUP_TEXT_DOMAIN ),
		        'menu_name'           => esc_html__( 'Design Library', LEVELUP_TEXT_DOMAIN ),
		        'parent_item_colon'   => esc_html__( 'Parent Design Library', LEVELUP_TEXT_DOMAIN ),
		        'all_items'           => esc_html__( 'All Design Library', LEVELUP_TEXT_DOMAIN ),
		        'view_item'           => esc_html__( 'View Design Library', LEVELUP_TEXT_DOMAIN ),
		        'add_new_item'        => esc_html__( 'Add New Design', LEVELUP_TEXT_DOMAIN ),
		        'add_new'             => esc_html__( 'Add New', LEVELUP_TEXT_DOMAIN ),
		        'edit_item'           => esc_html__( 'Edit Design Library', LEVELUP_TEXT_DOMAIN ),
		        'update_item'         => esc_html__( 'Update Design Library', LEVELUP_TEXT_DOMAIN ),
		        'search_items'        => esc_html__( 'Search Design Library', LEVELUP_TEXT_DOMAIN ),
		        'not_found'           => esc_html__( 'Not Found', LEVELUP_TEXT_DOMAIN ),
		        'not_found_in_trash'  => esc_html__( 'Not found in Trash', LEVELUP_TEXT_DOMAIN )
		    );

		    $args = array(
		        'label'               => esc_html__( 'LevelUp Designs', LEVELUP_TEXT_DOMAIN ),
		        'description'         => esc_html__( 'LevelUp Designs and Layouts Library', LEVELUP_TEXT_DOMAIN ),
		        'labels'              => $labels,
		        // Features this CPT supports in Post Editor
		        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		        // You can associate this CPT with a taxonomy or custom taxonomy. 
		        'taxonomies'          => array( levelup_basics_config('taxonomy') ),
		        /* A hierarchical CPT is like Pages and can have
		        * Parent and child items. A non-hierarchical CPT
		        * is like Posts.
		        */ 
		        'hierarchical'        => true,
		        'public'              => true,
		        'show_in_menu'        => true,
		        'show_in_admin_bar'   => true,
		        'menu_position'       => 5,
		        'can_export'          => true,
		        'has_archive'         => true,

		        'exclude_from_search' => true,
		        'publicly_queryable'  => false,
		        'show_in_nav_menus'   => false,
		        'show_ui'             => false,

		        'capability_type'     => 'page',
		        //Rest API Support for custom post type
		        'show_in_rest'       => true,
		  		'rest_base'          => 'design_library-api',
		  		'rest_controller_class' => 'WP_REST_Posts_Controller',
	    	);
	    register_post_type( levelup_basics_config('post_type'), $args );
	}

	public function registerTaxonomy(){
		$taxonomy = levelup_basics_config('taxonomy'); 
		$post_type = levelup_basics_config('post_type'); 
		$labels = array(
				    'name' => esc_html__( 'Design Widget', LEVELUP_TEXT_DOMAIN ),
				    'singular_name' => esc_html__( 'Widget Type', LEVELUP_TEXT_DOMAIN ),
				    'search_items' =>  esc_html__( 'Search Widget', LEVELUP_TEXT_DOMAIN),
				    'all_items' => esc_html__( 'All Widgets', LEVELUP_TEXT_DOMAIN),
				    'parent_item' => esc_html__( 'Parent Widget', LEVELUP_TEXT_DOMAIN),
				    'parent_item_colon' => esc_html__( 'Parent Widget:', LEVELUP_TEXT_DOMAIN),
				    'edit_item' => esc_html__( 'Edit Widget', LEVELUP_TEXT_DOMAIN), 
				    'update_item' => esc_html__( 'Update Widget', LEVELUP_TEXT_DOMAIN),
				    'add_new_item' => esc_html__( 'Add New Widget', LEVELUP_TEXT_DOMAIN),
				    'new_item_name' => esc_html__( 'New Widget Name', LEVELUP_TEXT_DOMAIN),
				    'menu_name' => esc_html__( 'Widget Types', LEVELUP_TEXT_DOMAIN),
				);    
 
		// Now register the taxonomy
		register_taxonomy($taxonomy, array($post_type), array(
				'hierarchical' => false,
				'labels' => $labels,
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => $taxonomy ),
				//REST API suport for Custom taxonomy
				'show_in_rest'       => true,
		  		'rest_base'          => $taxonomy,
		  		'rest_controller_class' => 'WP_REST_Terms_Controller',
			));
	}
}

new LevelupDesign();