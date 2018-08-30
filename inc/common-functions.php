<?php
if(!function_exists('getDesignListByCategory')){
	function getDesignListByCategory($categoryslug){
		$taxonomy = elementor_plus_basics_config('taxonomy');
		$post_type = elementor_plus_basics_config('post_type');
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
if(!function_exists('elementorPlusGetDesignListData')){
	function elementorPlusGetDesignListData($type = ''){
		$taxonomy = elementor_plus_basics_config('taxonomy');
		$post_type = elementor_plus_basics_config('post_type');
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
											'designId' => get_post_meta( $post->ID, 'design_unique_name', true ),
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

function elementor_plus_basics_config($get){
	$config['post_type'] = 'ep_design_library';
	$config['taxonomy'] = 'ep_widget_type';
	return (isset($config[$get]) ? $config[$get]: '');
}

add_action( 'amp_post_template_css', 'elementor_plus_amp_design_styling' );
function elementor_plus_amp_design_styling(){
	$allCss = '';
	global $elementor_plus_ampCss;
	if(!empty($elementor_plus_ampCss)){
		if(is_array($elementor_plus_ampCss)){
			$elementor_plus_ampCss = array_unique($elementor_plus_ampCss);
			if(count($elementor_plus_ampCss)>0){
				foreach ($elementor_plus_ampCss as $key => $cssValue) {

					$allCss .= $cssValue;
				}
			}
		}else{
			$allCss .= $elementor_plus_ampCss;
		}
	}
	if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){
		echo $allCss;
	}
}