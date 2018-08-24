<?php

class AMPforWpElementor_design{
	public function __construct(){
		add_action('init',array($this, 'registerPostType'));
		add_action('init',array($this, 'registerTaxonomy'));


		add_action( 'wp_ajax_elementor_plus_get_sync_data', array( $this, 'elementor_plus_get_sync_data') );
		add_action( 'wp_ajax_elementor_plus_get_sync_data', array( $this, 'elementor_plus_get_sync_data') );
		add_action( 'wp_ajax_elementor_plus_update_design_library', array( $this, 'elementor_plus_update_design_library') );
	}


	/*public function elementor_plus_get_sync_data(){
		$response = wp_remote_get( 'http://localhost/elementor-layouts/list.php',array('timeout'=> 120));
		$elementor_plus_json_option = 'ampforwp-call-to-action-layouts';
		$status = '';
		$responseData = '';
		if ( is_array( $response ) && ! is_wp_error( $response ) ) {
			$responseData = $response['body'];
			$responseData = json_decode($responseData);
			if( is_array($responseData)){
				$responseData = json_encode($responseData);
				update_option( $elementor_plus_json_option, $responseData );
				$status = 200;
			}else{
				$status = 400;
			}
		}else{
			$status = 400;
		}
		echo $status;
		wp_die();
	}*/

	public function elementor_plus_update_design_library(){
		$response = wp_remote_get( 'http://localhost/elementor-layouts/',array('timeout'=> 120));
		//$elementor_plus_json_option = 'ampforwp-call-to-action-layouts';
		$status = '';
		$responseData = '';
		$metaData = '';
		//print_r($response);
		// if ( is_array( $response ) && ! is_wp_error( $response ) ) {
		//  	$responseData = $response['body'];
		//  	$responseData = json_decode($responseData);
		//  	if( is_array($responseData)){
		// 		$responseData = json_encode($responseData);
		//  		//update_option( $elementor_plus_json_option, $responseData );
		//  		$status = 200;
		//  	}
		// }else{
		//  	$status = 400;
		// }
		//echo $responseData;
		$responseData = json_decode($response['body']);
		foreach( $responseData as $key => $valCat ){
			$widgetType = $key;
			foreach( $valCat as $key => $valDesigntype ){
				$designType = $key;
				$post_id = wp_insert_post(array('post_title'=> $widgetType.' '.$designType, 'post_type'=>'design_library', 'post_content'=>'Desgin Layouts with markup and css'));
				wp_set_object_terms( $post_id, $widgetType, 'widget_type' );
				$metaData = array();
				// Check folder permission and define file location
				foreach( $valDesigntype as $key => $valMarkups ){
						$metaData[] = json_encode($valMarkups);
					if( $key == 'image'){
						update_post_meta( $post_id, '_design_image_url', $valMarkups );
					}
					update_post_meta( $post_id, '_amp_html_markup', $metaData[0] );
					update_post_meta( $post_id, '_non_amp_html_markup', $metaData[1] );
					update_post_meta( $post_id, '_design_markup_options', $metaData[2] );
				}
			}
		}
		echo '200';

		wp_die();
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
		        'show_ui'             => False,

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