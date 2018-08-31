<?php
namespace ElementorePlus;

function render($settings){
	$selected_design = $settings['layoutDesignSelected'];
	$args = array(
	  	//'post__in'        => array($the_slug),
		'meta_query' => array(
						      array(
						         'key'     => 'design_unique_name',
						         'value'   => $selected_design,
						         'compare' => '='
						      )
						   ),
		'post_type'   => elementor_plus_basics_config('post_type'),
		'post_status' => 'publish',
		'numberposts' => 1
	);
	global $elementor_plus_ampCss;
	$my_posts = get_posts($args);
	if(count($my_posts)<1){
		return '';
	}
	if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){
		$ampMarkup = get_post_meta($my_posts[0]->ID, 'amp_html_markup',true);
		if(!empty($ampMarkup)){
			if(!is_array($ampMarkup)){
				$ampMarkup = json_decode($ampMarkup,true);
			}
			$markup = $ampMarkup['amp_html'];
			$amp_css = $ampMarkup['amp_css'];
			if(!empty($amp_css)){
				$elementor_plus_ampCss[$selected_design] = $amp_css;
			}
		}
	}else{
		$nonAmpMarkup = get_post_meta($my_posts[0]->ID, 'non_amp_html_markup',true);
		if(!empty($nonAmpMarkup)){
			if(!is_array($nonAmpMarkup)){
				$nonAmpMarkup = json_decode($nonAmpMarkup,true);
			}
			$markup = $nonAmpMarkup['non_amp_html'];
			$non_amp_css = $nonAmpMarkup['non_amp_css'];
			if($non_amp_css && !isset($elementor_plus_ampCss[$selected_design])){
				$elementor_plus_ampCss[$selected_design] = 'added';//$non_amp_css;
				echo '<Style>'.esc_html($non_amp_css).'</style>';
			}
			

		}


	}
	return $markup;

}



namespace ElementorePlusDesignCount;

function abvailableDesignCount(){
	$args = array(
	  	'post_type'   => elementor_plus_basics_config('post_type'),
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$my_posts = get_posts($args);
	return 	count($my_posts);
}