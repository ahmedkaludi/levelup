<?php
namespace LevelupDesign;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function render($settings, $returnWithSettings = false){
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
		'post_type'   => levelup_basics_config('post_type'),
		'post_status' => 'publish',
		'numberposts' => 1
	);
	global $levelup_ampCss;
	$my_posts = get_posts($args);
	if(count($my_posts)<1){
		return '';
	}
	if($returnWithSettings){
		$designSettings = get_post_meta($my_posts[0]->ID, 'design_settings',true);
		$designSettings = json_decode($designSettings,true);
		levelup_iterate_data( $designSettings, function( $element ) use($returnWithSettings){
			if($element['elType']=='widget' && $element['widgetType']==$returnWithSettings){
				global $levelup_layoutSettings;
				$levelup_layoutSettings = $element['settings'];
			}
		});
		global $levelup_layoutSettings;
		$settings = $levelup_layoutSettings;
	}
	//Fallback get markup from server if not present
	$designsData = array();
	if(get_post_meta($my_posts[0]->ID, 'amp_html_markup',true)=='' || get_post_meta($my_posts[0]->ID, 'non_amp_html_markup',true)==''){
		$designsData = levelup_import_design_markup($selected_design, $my_posts[0]->ID);
	}

	$markup = '';
	if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){
		if(isset($designsData['amp'])){
			$ampMarkup = $designsData['amp'];
		}else{
			$ampMarkup = get_post_meta($my_posts[0]->ID, 'amp_html_markup',true);
		}
		if(!empty($ampMarkup)){
			if(!is_array($ampMarkup)){
				$ampMarkup = json_decode($ampMarkup,true);
			}
			$markup = $ampMarkup['amp_html'];
			$amp_css = $ampMarkup['amp_css'];
			if(!empty($amp_css)  && !isset($levelup_ampCss[$selected_design])){
				ob_start();
				eval('?>'.$amp_css);
				$amp_css = ob_get_contents();
				ob_end_clean();
				$levelup_ampCss[$selected_design] = $amp_css;
			}
		}
	}else{
		if(isset($designsData['non_amp'])){
			$nonAmpMarkup = $designsData['non_amp'];
		}else{
			$nonAmpMarkup = get_post_meta($my_posts[0]->ID, 'non_amp_html_markup',true);
		}
		if(!empty($nonAmpMarkup)){
			if(!is_array($nonAmpMarkup)){
				$nonAmpMarkup = json_decode($nonAmpMarkup,true);
			}
			$markup = $nonAmpMarkup['non_amp_html'];
			$non_amp_css = $nonAmpMarkup['non_amp_css'];
			if($non_amp_css && !isset($levelup_ampCss[$selected_design])){
				ob_start();
				eval('?>'.$non_amp_css);
				$non_amp_css = ob_get_contents();
				ob_end_clean();
				$levelup_ampCss[$selected_design] = $non_amp_css;
				$markup .= "<style>".$non_amp_css."</style>";
			}
			

		}


	}
	if($markup){
		$renderClass = new \LevelupDesignCount\levelupRenderClass();
		$markup = $renderClass->replacements_procees($settings,$markup);
	}
	if($returnWithSettings){
		$designSettings = levelup_iterate_data( $designSettings, function( $element ) use($selected_design, $markup,$returnWithSettings) {
				$element['id'] = levelup_get_random_text();
				if($element['elType'] == 'widget' && $element['widgetType'] == $returnWithSettings){
					$element['settings']['layoutDesignSelected'] = $selected_design;
					$element['htmlCache'] = '<div class="elementor-element-overlay"><ul class="elementor-editor-element-settings elementor-editor-widget-settings"><li class="elementor-editor-element-setting elementor-editor-element-edit" title="Edit"><i class="eicon-edit" aria-hidden="true"></i><span class="elementor-screen-only">Edit</span></li></ul></div><div class="elementor-widget-container">'.$markup.'</div>';
				}
				return $element;
			} );

		return $designSettings;
	}
	return $markup;

}



namespace LevelupDesignCount;

function abvailableDesignCount(){
	$args = array(
	  	'post_type'   => levelup_basics_config('post_type'),
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$my_posts = get_posts($args);
	return 	count($my_posts);
}


class levelupRenderClass{
	private function query_data($rawhtml, $settings){
		//check is contain loop
		$allPostsMarkup = '';
		$loopPositionMarkup = array();
		$isSinglulerPost = false;
		if(strpos($rawhtml,'{{loop_html')!==false){
			//Case Studies
			/**
			* All Loop Design is Similar
			**/
			if(strpos($rawhtml,'{{loop_html_start}}')!==false){
				 preg_match("/({{loop_html_start}})(.*?)({{loop_html_end}})/s", $rawhtml, $matches);
				if(isset($matches[2])){
					$allPostsMarkup = $matches[2];
				}
			}
			/**
			* Multi Design Loop Familiar with position
			**/
			preg_match_All("/{{loop_html_start_(.*?)}}/s", $rawhtml, $positionmatches, PREG_OFFSET_CAPTURE);
			if(count(array_filter($positionmatches))>0){
				if(isset($positionmatches[1])){
					foreach ($positionmatches[1] as $positionArrayVal) {
						$loopPosition = $positionArrayVal[0];
						preg_match("/({{loop_html_start_".$loopPosition."}})(.*?)({{loop_html_end_".$loopPosition."}})/s", $rawhtml, $matchesPosHtml);
						if(isset($matchesPosHtml[2])){
							$loopPositionMarkup[$loopPosition] = $matchesPosHtml[2];
						}
					}
				}

			}
			//if(strpos($rawhtml,'{{loop_html_start}}')!==false)

		}else{
			//Normal single loop markup 
			$isSinglulerPost = true; 
			$replaceHtml = $rawhtml;
		}
		if(isset($settings['selected_category'])){
			$args = array(
					'cat' => $settings['selected_category'],//$fieldValues['category_selection'],
					'has_password' => false,
					'post_status'=> 'publish'
				);
			if($isSinglulerPost){
				$args['posts_per_page'] = 1;
			}else{
				$args['posts_per_page'] = ( $settings['listShowNumbers']? $settings['listShowNumbers'] : get_option( 'posts_per_page' ) );
			}
			//print_r($args);die;
			$loopReplacedHtmls = '';
			$loopPositionReplacedMarkup = array();
			//The Query
			$the_query = new \WP_Query( $args );
			if ( $the_query->have_posts() ) {
				$key = 1;
				while ( $the_query->have_posts() ) {
					$the_query->the_post();		
					$postid = get_the_ID();
					$trakCurrentMarkup = array();
					if($isSinglulerPost){
						$replaceHtmls = $replaceHtml;
						$content = '';
						ob_start();
						eval('?>'.$replaceHtmls);
						$content = ob_get_contents();
						ob_end_clean();
						$replaceHtmls = $content;
					}else{
						if( isset($loopPositionMarkup[$key]) ){
							$replaceHtmls = $loopPositionMarkup[$key];
							$content = '';
							ob_start();
							eval('?>'.$replaceHtmls);
							$content = ob_get_contents();
							ob_end_clean();
							$loopPositionReplacedMarkup[$key] = $content;
						}else{
							$content = '';
							ob_start();
							eval("?>".$allPostsMarkup);
							$content = ob_get_contents();
							ob_end_clean();
							$loopReplacedHtmls .= $content;
						}
					}


					$key++;
				}//While Loop Closed

			}
			  wp_reset_postdata();
			  wp_reset_query();
		}else{
			ob_start();
			eval('?>'.$rawhtml);
			$replaceHtmls = ob_get_contents();
			ob_end_clean();
		}
		if($isSinglulerPost){
			return $replaceHtmls;
		}
		if(strpos($rawhtml,'{{loop_html')!==false){
			//Case Studies
			/**
			* All Loop Design is Similar
			**/
			if(strpos($rawhtml,'{{loop_html_start}}')!==false){
				$rawhtml = preg_replace("/({{loop_html_start}})(.*?)({{loop_html_end}})/s",$loopReplacedHtmls, $rawhtml);
			}
			/**
			* Multi Design Loop Familiar with position
			**/
			preg_match_All("/{{loop_html_start_(.*?)}}/s", $rawhtml, $positionmatches, PREG_OFFSET_CAPTURE);
			if(count(array_filter($positionmatches))>0){
				if(isset($positionmatches[1])){
					foreach ($positionmatches[1] as $positionArrayVal) {
						$loopPosition = $positionArrayVal[0];
						$rawhtml = preg_replace("/({{loop_html_start_".$loopPosition."}})(.*?)({{loop_html_end_".$loopPosition."}})/s", $loopPositionReplacedMarkup[$loopPosition],$rawhtml);
						
					}
				}

			}
			//if(strpos($rawhtml,'{{loop_html_start}}')!==false)

		}

		return $rawhtml;
	}

	function replacements_procees( $settingArray, $markup ){
		//Start Replacement Process

		preg_match_all("/{{(.*?)}}/", $markup,$matches);
		if(isset($matches[1])){
			foreach ($matches[1] as $key => $fieldName) {
				$isReplace = false;
				$replacementVal = '';
				if( isset($settingArray[$fieldName]) ){
					if( !is_array($settingArray[$fieldName]) ){
						$isReplace = true;
						$replacementVal = $settingArray[$fieldName];
					}
				}

				if($isReplace){
					$markup = preg_replace("/{{".$fieldName."}}/i", $settingArray[$fieldName], $markup);
				}

			}//Closed Foreach $matches[1];
		}// closed isset($matches[1])
		$markup = $this->query_data($markup, $settingArray);
		return $markup;
	}

}//