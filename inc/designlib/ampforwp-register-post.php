<?php

class AMPforWpElementor_design{
	public function __construct(){
		add_action('init',array($this, 'registerPostType'));
		add_action('init',array($this, 'registerTaxonomy'));
	}

	function registerPostType(){
		$labels = array(
		        'name'                => _x( 'Design Library', 'Post Type General Name', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'singular_name'       => _x( 'Design Library', 'Post Type Singular Name', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'menu_name'           => __( 'Design Library', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'parent_item_colon'   => __( 'Parent Design Library', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'all_items'           => __( 'All Design Library', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'view_item'           => __( 'View Design Library', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'add_new_item'        => __( 'Add New Design', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'add_new'             => __( 'Add New', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'edit_item'           => __( 'Edit Design Library', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'update_item'         => __( 'Update Design Library', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'search_items'        => __( 'Search Design Library', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'not_found'           => __( 'Not Found', ELEMENTOR_AMPFORWP_TEXT_DOMAIN ),
		        'not_found_in_trash'  => __( 'Not found in Trash', ELEMENTOR_AMPFORWP_TEXT_DOMAIN )
		    );

		    $args = array(
		        'label'               => __( 'Elementor Plus Designs', 'twentythirteen' ),
		        'description'         => __( 'Elementor Plus Designs and Layouts Library', 'twentythirteen' ),
		        'labels'              => $labels,
		        // Features this CPT supports in Post Editor
		        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		        // You can associate this CPT with a taxonomy or custom taxonomy. 
		        'taxonomies'          => array( elem_ampforwp_basics('taxonomy') ),
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
		        'show_ui'             => true,//False

		        'capability_type'     => 'page',
		        //Rest API Support for custom post type
		        'show_in_rest'       => true,
		  		'rest_base'          => 'design_library-api',
		  		'rest_controller_class' => 'WP_REST_Posts_Controller',
	    	);
	    register_post_type( elem_ampforwp_basics('post_type'), $args );
	}

	public function registerTaxonomy(){
		$taxonomy = elem_ampforwp_basics('taxonomy'); 
		$post_type = elem_ampforwp_basics('post_type'); 
		$labels = array(
				    'name' => _x( 'Design Widget', 'taxonomy general name' ),
				    'singular_name' => _x( 'Widget Type', 'taxonomy singular name' ),
				    'search_items' =>  __( 'Search Widget' ),
				    'all_items' => __( 'All Widgets' ),
				    'parent_item' => __( 'Parent Widget' ),
				    'parent_item_colon' => __( 'Parent Widget:' ),
				    'edit_item' => __( 'Edit Widget' ), 
				    'update_item' => __( 'Update Widget' ),
				    'add_new_item' => __( 'Add New Widget' ),
				    'new_item_name' => __( 'New Widget Name' ),
				    'menu_name' => __( 'Widget Types' ),
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

new AMPforWpElementor_design();