<?php
if(!function_exists('levelup_getDesignListByCategory')){
	function levelup_getDesignListByCategory($categoryslug){
		$taxonomy = levelup_basics_config('taxonomy');
		$post_type = levelup_basics_config('post_type');
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
if(!function_exists('levelupGetDesignListData')){
	function levelupGetDesignListData($type = ''){
		$taxonomy = levelup_basics_config('taxonomy');
		$post_type = levelup_basics_config('post_type');
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
							        		array(
							                'taxonomy' => $taxonomy,
							                'field' => 'term_id',
							                'terms' => $term->term_id,
							            	)
							            )
							        
							    ));

				$currentDesigns = array();

				foreach ($query as $post) {
					$currentDesigns[] = array('title' => $post->post_title,
											'designId' => get_post_meta( $post->ID, 'design_unique_name', true ),
											'designPreview' =>  ( !empty( get_post_meta( $post->ID, 'design_preview_url', true ) ) ? get_post_meta( $post->ID, 'design_preview_url', true ) : '#' ),
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
			wp_reset_query();
			wp_reset_postdata();
		}
		return $completeData;
	}
}

function levelup_basics_config($get){
	$config['post_type'] = 'lu_design_library';
	$config['taxonomy'] = 'lu_widget_type';
	return (isset($config[$get]) ? $config[$get]: '');
}

add_action( 'amp_post_template_css', 'levelup_amp_design_styling' );
function levelup_amp_design_styling(){
	$allCss = '';
	global $levelup_ampCss;
	if(!empty($levelup_ampCss)){
		if(is_array($levelup_ampCss)){
			$levelup_ampCss = array_unique($levelup_ampCss);
			if(count($levelup_ampCss)>0){
				foreach ($levelup_ampCss as $key => $cssValue) {

					$allCss .= $cssValue;
				}
			}
		}else{
			$allCss .= $levelup_ampCss;
		}
	}
	if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){
		echo $allCss;
	}
}