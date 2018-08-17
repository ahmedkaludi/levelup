<?php
if(!function_exists('getDesignListByCategory')){
	function getDesignListByCategory($categoryslug){
		$taxonomy = elem_ampforwp_basics('taxonomy');
		$post_type = elem_ampforwp_basics('post_type');
		if($categoryslug==''){ return array(); }

		$posts = get_posts( array(
							        'posts_per_page' => -1,
							        'post_type' => $post_type,
							        'orderby'=>'asc',
							        'tax_query' => array(
							                'taxonomy' => $taxonomy,
							                'field' => 'slug',
							                'terms' => $categoryslug,
							            )							        
							    ));
		$categories = array();
		if(count($posts)>0){
			foreach ($posts as $key => $post) {
				$design_unique_name = get_post_meta( $post->ID, 'design_unique_name', true );
				$categories[$design_unique_name] = $post->post_title;
			}
		}
		return $categories;

	}
}
if(!function_exists('getDesignListData')){
	function getDesignListData($type = ''){
		$taxonomy = elem_ampforwp_basics('taxonomy');
		$post_type = elem_ampforwp_basics('post_type');
		$cat_args = array(
		    'orderby'       => 'term_id', 
		    'order'         => 'ASC',
		    'hide_empty'    => true, 
		);
		$terms = get_terms(array(
							    'taxonomy' => $taxonomy,
							    'hide_empty' => false,
							));
		$completeData = array();
		if(count($terms)>0){
			foreach ($terms as $key => $term) {
				$query = get_posts( array(
							        'posts_per_page' => -1,
							        'post_type' => $post_type,
							        'tax_query' => array(
							                'taxonomy' => $taxonomy,
							                'field' => 'term_id',
							                'terms' => $term->term_id,
							            )
							        
							    ));

				$currentDesigns = array();

				foreach ($query as $post) {
					$currentDesigns[] = array('title' => $post->post_title,
											'designId' => $post->ID,
											'designImage' => get_the_post_thumbnail_url($post->ID),
										);
				}


				wp_reset_query();
				wp_reset_postdata();
				$completeData[$term->slug] = array(
												'term_id'=>$term->term_id,
												'slug'=>$term->slug,
												'name'=>$term->name,
												'layouts'=>$currentDesigns
												);
			}
		}
		return $completeData;
	}
}

function elem_ampforwp_basics($get){
	$config['post_type'] = 'design_library';
	$config['taxonomy'] = 'widget_type';
	return (isset($config[$get]) ? $config[$get]: '');
}