<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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
							        		array(
							                'taxonomy' => $taxonomy,
							                'field' => 'slug',
							                'terms' => $categoryslug,
							                )
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
											'designImage' => ( !empty( get_the_post_thumbnail_url($post->ID) ) ? get_the_post_thumbnail_url($post->ID) : get_post_meta( $post->ID, 'design_feature_image_url', true ) ),
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

add_action('ampforwp_before_head', 'levelup_amp_fonts');
function levelup_amp_fonts_elementor(){
	global $post;
	$fontsList = get_option( '_elementor_global_css');
	$postFontsList = get_post_meta($post->ID, '_elementor_css');
	$listPostFonts = array();
	foreach ($postFontsList as $key => $postFonts) {
		$listPostFonts = array_merge( $listPostFonts, $postFonts['fonts']);
	}
	$fonts = array_merge($fontsList['fonts'], $listPostFonts);
	$google_fonts = array();
	foreach ($fonts as $key => $font) {
		$font_type = \Elementor\Fonts::get_font_type( $font );
			switch ( $font_type ) {
				case \Elementor\Fonts::GOOGLE:
					$google_fonts['google'][] = $font;
					break;

				case \Elementor\Fonts::EARLYACCESS:
					$google_fonts['early'][] = $font;
					break;
				}
	}
	$google_fonts_index = 1;
	if ( ! empty( $google_fonts['google'] ) ) {
			$google_fonts_index++;


			foreach ( $google_fonts['google'] as &$font ) {
				$font = str_replace( ' ', '+', $font ) . ':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
			}

			$fonts_url = sprintf( 'https://fonts.googleapis.com/css?family=%s', implode( rawurlencode( '|' ), $google_fonts['google'] ) );

			$subsets = [
				'ru_RU' => 'cyrillic',
				'bg_BG' => 'cyrillic',
				'he_IL' => 'hebrew',
				'el' => 'greek',
				'vi' => 'vietnamese',
				'uk' => 'cyrillic',
				'cs_CZ' => 'latin-ext',
				'ro_RO' => 'latin-ext',
				'pl_PL' => 'latin-ext',
			];
			$locale = get_locale();

			if ( isset( $subsets[ $locale ] ) ) {
				$fonts_url .= '&subset=' . $subsets[ $locale ];
			}

			echo "<link rel='stylesheet' id='google-fonts'  href='$fonts_url' type='text/css' media='all' />";
		}

		if ( ! empty( $google_fonts['early'] ) ) {
			foreach ( $google_fonts['early'] as $current_font ) {
				$google_fonts_index++;

				//printf( '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/%s.css">', strtolower( str_replace( ' ', '', $current_font ) ) );

				$font_url = sprintf( 'https://fonts.googleapis.com/earlyaccess/%s.css', strtolower( str_replace( ' ', '', $current_font ) ) );

				//wp_enqueue_style( 'google-earlyaccess-' . $google_fonts_index, $font_url ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
				echo "<link rel='stylesheet' id='google-fonts'  href='$fonts_url' type='text/css' media='all' />";
			}
		}
	
}
function levelup_amp_fonts(){
	echo "<link rel='stylesheet' id='font-awesome-css'  href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' type='text/css' media='all' />";
	levelup_amp_fonts_elementor();
	/*$post_id = $post->ID;
	$dynamicCss = new \Elementor\Core\DynamicTags\Dynamic_CSS($post_id, $post_id);
	$dynamicCss->get_meta();*/
}
//add_action('wp_head', 'levelup_nonamp_design_styling', 100);
add_action( 'amp_post_template_css', 'levelup_amp_column_design',1 );
function levelup_amp_column_design(){
	if(function_exists('wp_upload_dir')){
		$headerGlobalCssPath = LEVELUP__FILE__PATH."/assets/css/frontend/amp.css";
		if(file_exists($headerGlobalCssPath)){
			echo levelup_minify_css(file_get_contents($headerGlobalCssPath));
			
		}
	}

}
add_action( 'amp_post_template_css', 'levelup_amp_design_styling' );
function levelup_amp_design_styling(){
	global $post, $redux_builder_amp;
	if( is_single($post->ID) || is_singular($post->ID)  || !(\Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID)) ) {
		return false;
	}
	$allCss = '';
	// Back to Top CSS // "\e316"
	if( '1' == $redux_builder_amp['ampforwp-footer-top'] ) { 
		$allCss .= '.btt{
					position: fixed;
				    bottom: 50px;
				    right: 10px;
				    padding: 10px;
				    background: '.$redux_builder_amp['swift-color-scheme']['color'].';
				    color: #fff;
				    border-radius: 5px;
				}
				.btt:before{
					content: "\f062";
			    	font-family: \'FontAwesome\';
					display:block;
					font-size: 20px;
			    	font-weight: 600;
				}';
	} 
	$allCss .= '/** Levelup CSS **/
	.elementor-section.elementor-section-boxed>.elementor-container {
	    max-width: 1140px;
	    margin:0 auto;
	}
@media (min-width: 768px){
  .elementor-column.elementor-col-10, .elementor-column[data-col="10"] {
    width: 10%; }
  .elementor-column.elementor-col-11, .elementor-column[data-col="11"] {
    width: 11.111%; }
  .elementor-column.elementor-col-12, .elementor-column[data-col="12"] {
    width: 12.5%; }
  .elementor-column.elementor-col-14, .elementor-column[data-col="14"] {
    width: 14.285%; }
  .elementor-column.elementor-col-16, .elementor-column[data-col="16"] {
    width: 16.666%; }
  .elementor-column.elementor-col-20, .elementor-column[data-col="20"] {
    width: 20%; }
  .elementor-column.elementor-col-25, .elementor-column[data-col="25"] {
    width: 25%; }
  .elementor-column.elementor-col-30, .elementor-column[data-col="30"] {
    width: 30%; }
  .elementor-column.elementor-col-33, .elementor-column[data-col="33"] {
    width: 33.333%; }
  .elementor-column.elementor-col-40, .elementor-column[data-col="40"] {
    width: 40%; }
  .elementor-column.elementor-col-50, .elementor-column[data-col="50"] {
    width: 50%; }
  .elementor-column.elementor-col-60, .elementor-column[data-col="60"] {
    width: 60%; }
  .elementor-column.elementor-col-66, .elementor-column[data-col="66"] {
    width: 66.666%; }
  .elementor-column.elementor-col-70, .elementor-column[data-col="70"] {
    width: 70%; }
  .elementor-column.elementor-col-75, .elementor-column[data-col="75"] {
    width: 75%; }
  .elementor-column.elementor-col-80, .elementor-column[data-col="80"] {
    width: 80%; }
  .elementor-column.elementor-col-83, .elementor-column[data-col="83"] {
    width: 83.333%; }
  .elementor-column.elementor-col-90, .elementor-column[data-col="90"] {
    width: 90%; }
  .elementor-column.elementor-col-100, .elementor-column[data-col="100"] {
    width: 100%; }
}
.elementor-column-gap-default>.elementor-row>.elementor-column>.elementor-element-populated {
    padding: 10px;
}
.elementor-row{
    width:100%;
    display:flex;
}
.elementor-column-wrap, .elementor-widget-wrap {
    width: 100%;
    position: relative;
}
@media (max-width: 767px){
	.elementor-row {flex-wrap: wrap;}
	.elementor-column {width: 100%;}
}';
	if(function_exists('wp_upload_dir')){
		$elementorGlobalCssPath = wp_upload_dir()['basedir']."/elementor/css/global.css";
		$elementorCssPath = wp_upload_dir()['basedir']."/elementor/css/post-".get_the_ID().".css";
		if(file_exists($elementorGlobalCssPath)){
			$allCss .= file_get_contents($elementorGlobalCssPath);
		}
		if(file_exists($elementorCssPath)){
			$allCss .= file_get_contents($elementorCssPath);
		}
	}
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
		echo levelup_minify_css($allCss,true);
	}
}

function levelup_nonamp_design_styling()
{
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
	
	echo "<style type='text/css'>".levelup_minify_css($allCss)."</style>";
	
}
/**
 * CSS beautifier
 * @ $buffer All CSS content to be sanitize
 * @ $is_amp If AMP Enabled than minify the names of classes
 */
function levelup_minify_css($buffer, $is_amp=false){
	// Remove comments
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	// Remove space after colons
	$buffer = str_replace(': ', ':', $buffer);
	// Remove whitespace
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	if($is_amp){ $buffer = levelup_minify_amp_name_css($buffer); }
	return $buffer; 
}
/**
 * CSS beautifier
 * @ $buffer Minify the names of classes
 */
function levelup_minify_amp_name_css($buffer){
	$buffer = str_replace(array(".elementor-element", ".elementor"), array(".e",".el"), $buffer);
	return $buffer;
}

add_filter( 'elementor/frontend/the_content', 'levelup_apply_builder_in_content');
function levelup_apply_builder_in_content($content){
	if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){
		$content = preg_replace_callback("/class=\"(.*?)\"/", function($matches){
					$matches[1] = str_replace(array("elementor-element", "elementor"), array("e","el"), $matches[1]);
					return 'class="'.$matches[1].'"';
				}, $content);
	}
	return $content;
}

function levelup_new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'levelup_new_excerpt_more');

function levelup_get_font_icons(){
	return ['fa fa-500px' ,'fa fa-address-book','fa fa-address-book-o','fa fa-address-card','fa fa-address-card-o','fa fa-adjust','fa fa-adn','fa fa-align-center','fa fa-align-justify','fa fa-align-left','fa fa-align-right','fa fa-amazon','fa fa-ambulance','fa fa-american-sign-language-interpreting','fa fa-anchor','fa fa-android','fa fa-angellist','fa fa-angle-double-down','fa fa-angle-double-left','fa fa-angle-double-right','fa fa-angle-double-up','fa fa-angle-down','fa fa-angle-left','fa fa-angle-right','fa fa-angle-up','fa fa-apple','fa fa-archive','fa fa-area-chart','fa fa-arrow-circle-down','fa fa-arrow-circle-left','fa fa-arrow-circle-o-down','fa fa-arrow-circle-o-left','fa fa-arrow-circle-o-right','fa fa-arrow-circle-o-up','fa fa-arrow-circle-right','fa fa-arrow-circle-up','fa fa-arrow-down','fa fa-arrow-left','fa fa-arrow-right','fa fa-arrow-up','fa fa-arrows','fa fa-arrows-alt','fa fa-arrows-h','fa fa-arrows-v','fa fa-asl-interpreting','fa fa-assistive-listening-systems','fa fa-asterisk','fa fa-at','fa fa-audio-description','fa fa-automobile','fa fa-backward','fa fa-balance-scale','fa fa-ban','fa fa-bandcamp','fa fa-bank','fa fa-bar-chart','fa fa-bar-chart-o','fa fa-barcode','fa fa-bars','fa fa-bath','fa fa-bathtub','fa fa-battery','fa fa-battery-0','fa fa-battery-1','fa fa-battery-2','fa fa-battery-3','fa fa-battery-4','fa fa-battery-empty','fa fa-battery-full','fa fa-battery-half','fa fa-battery-quarter','fa fa-battery-three-quarters','fa fa-bed','fa fa-beer','fa fa-behance','fa fa-behance-square','fa fa-bell','fa fa-bell-o','fa fa-bell-slash','fa fa-bell-slash-o','fa fa-bicycle','fa fa-binoculars','fa fa-birthday-cake','fa fa-bitbucket','fa fa-bitbucket-square','fa fa-bitcoin','fa fa-black-tie','fa fa-blind','fa fa-bluetooth','fa fa-bluetooth-b','fa fa-bold','fa fa-bolt','fa fa-bomb','fa fa-book','fa fa-bookmark','fa fa-bookmark-o','fa fa-braille','fa fa-briefcase','fa fa-btc','fa fa-bug','fa fa-building','fa fa-building-o','fa fa-bullhorn','fa fa-bullseye','fa fa-bus','fa fa-buysellads','fa fa-cab','fa fa-calculator','fa fa-calendar','fa fa-calendar-check-o','fa fa-calendar-minus-o','fa fa-calendar-o','fa fa-calendar-plus-o','fa fa-calendar-times-o','fa fa-camera','fa fa-camera-retro','fa fa-car','fa fa-caret-down','fa fa-caret-left','fa fa-caret-right','fa fa-caret-square-o-down','fa fa-caret-square-o-left','fa fa-caret-square-o-right','fa fa-caret-square-o-up','fa fa-caret-up','fa fa-cart-arrow-down','fa fa-cart-plus','fa fa-cc','fa fa-cc-amex','fa fa-cc-diners-club','fa fa-cc-discover','fa fa-cc-jcb','fa fa-cc-mastercard','fa fa-cc-paypal','fa fa-cc-stripe','fa fa-cc-visa','fa fa-certificate','fa fa-chain','fa fa-chain-broken','fa fa-check','fa fa-check-circle','fa fa-check-circle-o','fa fa-check-square','fa fa-check-square-o','fa fa-chevron-circle-down','fa fa-chevron-circle-left','fa fa-chevron-circle-right','fa fa-chevron-circle-up','fa fa-chevron-down','fa fa-chevron-left','fa fa-chevron-right','fa fa-chevron-up','fa fa-child','fa fa-chrome','fa fa-circle','fa fa-circle-o','fa fa-circle-o-notch','fa fa-circle-thin','fa fa-clipboard','fa fa-clock-o','fa fa-clone','fa fa-close','fa fa-cloud','fa fa-cloud-download','fa fa-cloud-upload','fa fa-cny','fa fa-code','fa fa-code-fork','fa fa-codepen','fa fa-codiepie','fa fa-coffee','fa fa-cog','fa fa-cogs','fa fa-columns','fa fa-comment','fa fa-comment-o','fa fa-commenting','fa fa-commenting-o','fa fa-comments','fa fa-comments-o','fa fa-compass','fa fa-compress','fa fa-connectdevelop','fa fa-contao','fa fa-copy','fa fa-copyright','fa fa-creative-commons','fa fa-credit-card','fa fa-credit-card-alt','fa fa-crop','fa fa-crosshairs','fa fa-css3','fa fa-cube','fa fa-cubes','fa fa-cut','fa fa-cutlery','fa fa-dashboard','fa fa-dashcube','fa fa-database','fa fa-deaf','fa fa-deafness','fa fa-dedent','fa fa-delicious','fa fa-desktop','fa fa-deviantart','fa fa-diamond','fa fa-digg','fa fa-dollar','fa fa-dot-circle-o','fa fa-download','fa fa-dribbble','fa fa-drivers-license','fa fa-drivers-license-o','fa fa-dropbox','fa fa-drupal','fa fa-edge','fa fa-edit','fa fa-eercast','fa fa-eject','fa fa-ellipsis-h','fa fa-ellipsis-v','fa fa-empire','fa fa-envelope','fa fa-envelope-o','fa fa-envelope-open','fa fa-envelope-open-o','fa fa-envelope-square','fa fa-envira','fa fa-eraser','fa fa-etsy','fa fa-eur','fa fa-euro','fa fa-exchange','fa fa-exclamation','fa fa-exclamation-circle','fa fa-exclamation-triangle','fa fa-expand','fa fa-expeditedssl','fa fa-external-link','fa fa-external-link-square','fa fa-eye','fa fa-eye-slash','fa fa-eyedropper','fa fa-fa','fa fa-facebook','fa fa-facebook-f','fa fa-facebook-official','fa fa-facebook-square','fa fa-fast-backward','fa fa-fast-forward','fa fa-fax','fa fa-feed','fa fa-female','fa fa-fighter-jet','fa fa-file','fa fa-file-archive-o','fa fa-file-audio-o','fa fa-file-code-o','fa fa-file-excel-o','fa fa-file-image-o','fa fa-file-movie-o','fa fa-file-o','fa fa-file-pdf-o','fa fa-file-photo-o','fa fa-file-picture-o','fa fa-file-powerpoint-o','fa fa-file-sound-o','fa fa-file-text','fa fa-file-text-o','fa fa-file-video-o','fa fa-file-word-o','fa fa-file-zip-o','fa fa-files-o','fa fa-film','fa fa-filter','fa fa-fire','fa fa-fire-extinguisher','fa fa-firefox','fa fa-first-order','fa fa-flag','fa fa-flag-checkered','fa fa-flag-o','fa fa-flash','fa fa-flask','fa fa-flickr','fa fa-floppy-o','fa fa-folder','fa fa-folder-o','fa fa-folder-open','fa fa-folder-open-o','fa fa-font','fa fa-font-awesome','fa fa-fonticons','fa fa-fort-awesome','fa fa-forumbee','fa fa-forward','fa fa-foursquare','fa fa-free-code-camp','fa fa-frown-o','fa fa-futbol-o','fa fa-gamepad','fa fa-gavel','fa fa-gbp','fa fa-ge','fa fa-gear','fa fa-gears','fa fa-genderless','fa fa-get-pocket','fa fa-gg','fa fa-gg-circle','fa fa-gift','fa fa-git','fa fa-git-square','fa fa-github','fa fa-github-alt','fa fa-github-square','fa fa-gitlab','fa fa-gittip','fa fa-glass','fa fa-glide','fa fa-glide-g','fa fa-globe','fa fa-google','fa fa-google-plus','fa fa-google-plus-circle','fa fa-google-plus-official','fa fa-google-plus-square','fa fa-google-wallet','fa fa-graduation-cap','fa fa-gratipay','fa fa-grav','fa fa-group','fa fa-h-square','fa fa-hacker-news','fa fa-hand-grab-o','fa fa-hand-lizard-o','fa fa-hand-o-down','fa fa-hand-o-left','fa fa-hand-o-right','fa fa-hand-o-up','fa fa-hand-paper-o','fa fa-hand-peace-o','fa fa-hand-pointer-o','fa fa-hand-rock-o','fa fa-hand-scissors-o','fa fa-hand-spock-o','fa fa-hand-stop-o','fa fa-handshake-o','fa fa-hard-of-hearing','fa fa-hashtag','fa fa-hdd-o','fa fa-header','fa fa-headphones','fa fa-heart','fa fa-heart-o','fa fa-heartbeat','fa fa-history','fa fa-home','fa fa-hospital-o','fa fa-hotel','fa fa-hourglass','fa fa-hourglass-1','fa fa-hourglass-2','fa fa-hourglass-3','fa fa-hourglass-end','fa fa-hourglass-half','fa fa-hourglass-o','fa fa-hourglass-start','fa fa-houzz','fa fa-html5','fa fa-i-cursor','fa fa-id-badge','fa fa-id-card','fa fa-id-card-o','fa fa-ils','fa fa-image','fa fa-imdb','fa fa-inbox','fa fa-indent','fa fa-industry','fa fa-info','fa fa-info-circle','fa fa-inr','fa fa-instagram','fa fa-institution','fa fa-internet-explorer','fa fa-intersex','fa fa-ioxhost','fa fa-italic','fa fa-joomla','fa fa-jpy','fa fa-jsfiddle','fa fa-key','fa fa-keyboard-o','fa fa-krw','fa fa-language','fa fa-laptop','fa fa-lastfm','fa fa-lastfm-square','fa fa-leaf','fa fa-leanpub','fa fa-legal','fa fa-lemon-o','fa fa-level-down','fa fa-level-up','fa fa-life-bouy','fa fa-life-buoy','fa fa-life-ring','fa fa-life-saver','fa fa-lightbulb-o','fa fa-line-chart','fa fa-link','fa fa-linkedin','fa fa-linkedin-square','fa fa-linode','fa fa-linux','fa fa-list','fa fa-list-alt','fa fa-list-ol','fa fa-list-ul','fa fa-location-arrow','fa fa-lock','fa fa-long-arrow-down','fa fa-long-arrow-left','fa fa-long-arrow-right','fa fa-long-arrow-up','fa fa-low-vision','fa fa-magic','fa fa-magnet','fa fa-mail-forward','fa fa-mail-reply','fa fa-mail-reply-all','fa fa-male','fa fa-map','fa fa-map-marker','fa fa-map-o','fa fa-map-pin','fa fa-map-signs','fa fa-mars','fa fa-mars-double','fa fa-mars-stroke','fa fa-mars-stroke-h','fa fa-mars-stroke-v','fa fa-maxcdn','fa fa-meanpath','fa fa-medium','fa fa-medkit','fa fa-meetup','fa fa-meh-o','fa fa-mercury','fa fa-microchip','fa fa-microphone','fa fa-microphone-slash','fa fa-minus','fa fa-minus-circle','fa fa-minus-square','fa fa-minus-square-o','fa fa-mixcloud','fa fa-mobile','fa fa-mobile-phone','fa fa-modx','fa fa-money','fa fa-moon-o','fa fa-mortar-board','fa fa-motorcycle','fa fa-mouse-pointer','fa fa-music','fa fa-navicon','fa fa-neuter','fa fa-newspaper-o','fa fa-object-group','fa fa-object-ungroup','fa fa-odnoklassniki','fa fa-odnoklassniki-square','fa fa-opencart','fa fa-openid','fa fa-opera','fa fa-optin-monster','fa fa-outdent','fa fa-pagelines','fa fa-paint-brush','fa fa-paper-plane','fa fa-paper-plane-o','fa fa-paperclip','fa fa-paragraph','fa fa-paste','fa fa-pause','fa fa-pause-circle','fa fa-pause-circle-o','fa fa-paw','fa fa-paypal','fa fa-pencil','fa fa-pencil-square','fa fa-pencil-square-o','fa fa-percent','fa fa-phone','fa fa-phone-square','fa fa-photo','fa fa-picture-o','fa fa-pie-chart','fa fa-pied-piper','fa fa-pied-piper-alt','fa fa-pied-piper-pp','fa fa-pinterest','fa fa-pinterest-p','fa fa-pinterest-square','fa fa-plane','fa fa-play','fa fa-play-circle','fa fa-play-circle-o','fa fa-plug','fa fa-plus','fa fa-plus-circle','fa fa-plus-square','fa fa-plus-square-o','fa fa-podcast','fa fa-power-off','fa fa-print','fa fa-product-hunt','fa fa-pull-left','fa fa-pull-right','fa fa-puzzle-piece','fa fa-qq','fa fa-qrcode','fa fa-question','fa fa-question-circle','fa fa-question-circle-o','fa fa-quora','fa fa-quote-left','fa fa-quote-right','fa fa-ra','fa fa-random','fa fa-ravelry','fa fa-rebel','fa fa-recycle','fa fa-reddit','fa fa-reddit-alien','fa fa-reddit-square','fa fa-refresh','fa fa-registered','fa fa-remove','fa fa-renren','fa fa-reorder','fa fa-repeat','fa fa-reply','fa fa-reply-all','fa fa-resistance','fa fa-retweet','fa fa-rmb','fa fa-road','fa fa-rocket','fa fa-rotate-left','fa fa-rotate-right','fa fa-rouble','fa fa-rss','fa fa-rss-square','fa fa-rub','fa fa-ruble','fa fa-rupee','fa fa-s15','fa fa-safari','fa fa-save','fa fa-scissors','fa fa-scribd','fa fa-search','fa fa-search-minus','fa fa-search-plus','fa fa-sellsy','fa fa-send','fa fa-send-o','fa fa-server','fa fa-share','fa fa-share-alt','fa fa-share-alt-square','fa fa-share-square','fa fa-share-square-o','fa fa-shekel','fa fa-sheqel','fa fa-shield','fa fa-ship','fa fa-shirtsinbulk','fa fa-shopping-bag','fa fa-shopping-basket','fa fa-shopping-cart','fa fa-shower','fa fa-sign-in','fa fa-sign-language','fa fa-sign-out','fa fa-signal','fa fa-signing','fa fa-simplybuilt','fa fa-sitemap','fa fa-skyatlas','fa fa-skype','fa fa-slack','fa fa-sliders','fa fa-slideshare','fa fa-smile-o','fa fa-snapchat','fa fa-snapchat-ghost','fa fa-snapchat-square','fa fa-snowflake-o','fa fa-soccer-ball-o','fa fa-sort','fa fa-sort-alpha-asc','fa fa-sort-alpha-desc','fa fa-sort-amount-asc','fa fa-sort-amount-desc','fa fa-sort-asc','fa fa-sort-desc','fa fa-sort-down','fa fa-sort-numeric-asc','fa fa-sort-numeric-desc','fa fa-sort-up','fa fa-soundcloud','fa fa-space-shuttle','fa fa-spinner','fa fa-spoon','fa fa-spotify','fa fa-square','fa fa-square-o','fa fa-stack-exchange','fa fa-stack-overflow','fa fa-star','fa fa-star-half','fa fa-star-half-empty','fa fa-star-half-full','fa fa-star-half-o','fa fa-star-o','fa fa-steam','fa fa-steam-square','fa fa-step-backward','fa fa-step-forward','fa fa-stethoscope','fa fa-sticky-note','fa fa-sticky-note-o','fa fa-stop','fa fa-stop-circle','fa fa-stop-circle-o','fa fa-street-view','fa fa-strikethrough','fa fa-stumbleupon','fa fa-stumbleupon-circle','fa fa-subscript','fa fa-subway','fa fa-suitcase','fa fa-sun-o','fa fa-superpowers','fa fa-superscript','fa fa-support','fa fa-table','fa fa-tablet','fa fa-tachometer','fa fa-tag','fa fa-tags','fa fa-tasks','fa fa-taxi','fa fa-telegram','fa fa-television','fa fa-tencent-weibo','fa fa-terminal','fa fa-text-height','fa fa-text-width','fa fa-th','fa fa-th-large','fa fa-th-list','fa fa-themeisle','fa fa-thermometer','fa fa-thermometer-0','fa fa-thermometer-1','fa fa-thermometer-2','fa fa-thermometer-3','fa fa-thermometer-4','fa fa-thermometer-empty','fa fa-thermometer-full','fa fa-thermometer-half','fa fa-thermometer-quarter','fa fa-thermometer-three-quarters','fa fa-thumb-tack','fa fa-thumbs-down','fa fa-thumbs-o-down','fa fa-thumbs-o-up','fa fa-thumbs-up','fa fa-ticket','fa fa-times','fa fa-times-circle','fa fa-times-circle-o','fa fa-times-rectangle','fa fa-times-rectangle-o','fa fa-tint','fa fa-toggle-down','fa fa-toggle-left','fa fa-toggle-off','fa fa-toggle-on','fa fa-toggle-right','fa fa-toggle-up','fa fa-trademark','fa fa-train','fa fa-transgender','fa fa-transgender-alt','fa fa-trash','fa fa-trash-o','fa fa-tree','fa fa-trello','fa fa-tripadvisor','fa fa-trophy','fa fa-truck','fa fa-try','fa fa-tty','fa fa-tumblr','fa fa-tumblr-square','fa fa-turkish-lira','fa fa-tv','fa fa-twitch','fa fa-twitter','fa fa-twitter-square','fa fa-umbrella','fa fa-underline','fa fa-undo','fa fa-universal-access','fa fa-university','fa fa-unlink','fa fa-unlock','fa fa-unlock-alt','fa fa-unsorted','fa fa-upload','fa fa-usb','fa fa-usd','fa fa-user','fa fa-user-circle','fa fa-user-circle-o','fa fa-user-md','fa fa-user-o','fa fa-user-plus','fa fa-user-secret','fa fa-user-times','fa fa-users','fa fa-vcard','fa fa-vcard-o','fa fa-venus','fa fa-venus-double','fa fa-venus-mars','fa fa-viacoin','fa fa-viadeo','fa fa-viadeo-square','fa fa-video-camera','fa fa-vimeo','fa fa-vimeo-square','fa fa-vine','fa fa-vk','fa fa-volume-control-phone','fa fa-volume-down','fa fa-volume-off','fa fa-volume-up','fa fa-warning','fa fa-wechat','fa fa-weibo','fa fa-weixin','fa fa-whatsapp','fa fa-wheelchair','fa fa-wheelchair-alt','fa fa-wifi','fa fa-wikipedia-w','fa fa-window-close','fa fa-window-close-o','fa fa-window-maximize','fa fa-window-minimize','fa fa-window-restore','fa fa-windows','fa fa-won','fa fa-wordpress','fa fa-wpbeginner','fa fa-wpexplorer','fa fa-wpforms','fa fa-wrench','fa fa-xing','fa fa-xing-square','fa fa-y-combinator','fa fa-y-combinator-square','fa fa-yahoo','fa fa-yc','fa fa-yc-square','fa fa-yelp','fa fa-yen','fa fa-yoast','fa fa-youtube','fa fa-youtube-play','fa fa-youtube-square',];
}

add_action('wp_ajax_levelup_get_design', 'levelup_get_design');
function levelup_get_design(){
	$selected_design  = $_POST['templateId'];
	$currentWidgetInfo = $_POST['currentWidget'];//It contains : widgetType, elType
	
	
	require LEVELUP__DIR__PATH . '/inc/render-widgets-functions.php';
	$widget_settings['layoutDesignSelected'] = $selected_design;
	$markup = \LevelupDesign\render($widget_settings, $currentWidgetInfo['widgetType']);
	if(!$markup){
		echo json_encode(array("status"=>400, "message"=>'Html Not render'));
		die;
	}

	
	echo json_encode(array('status'=>200, 'content'=> $markup));
		die;
}


function levelup_get_random_text(){
	return dechex( rand() );
}

function levelup_iterate_data( $data_container, $callback ) {
	if(!is_array($data_container)){ return $data_container; }
	if ( isset( $data_container['elType'] ) ) {
		if ( ! empty( $data_container['elements'] ) ) {
			$data_container['elements'] = levelup_iterate_data( $data_container['elements'], $callback );
		}

		return $callback( $data_container );
	}

	foreach ( $data_container as $element_key => $element_value ) {
		$element_data = levelup_iterate_data( $data_container[ $element_key ], $callback );

		if ( null === $element_data ) {
			continue;
		}

		$data_container[ $element_key ] = $element_data;
	}

	return $data_container;
}

add_filter( 'amp_post_template_file', 'levelup_child_designing_custom_template', 22, 3 );
function levelup_child_designing_custom_template($file, $type, $post){
	
	global $post, $redux_builder_amp;
	$levelupTemplate = get_post_meta( $post->ID, '_wp_page_template', true );
	
	$page_template = array('elementor_canvas','elementor_header_footer');
	if(in_array($levelupTemplate, $page_template)){
		switch ($page_template) {
			case 'elementor_canvas':
				if ( is_single() || is_page()  ) {
					if( 'single' === $type && ! ('product' === $post->post_type) ) {
						//$file = LEVELUP__FILE__PATH.'inc/templates/canvas.php';
						$file = LEVELUP__FILE__PATH.'inc/templates/header-footer.php';
				 	}
				}
				break;
			case 'elementor_header_footer':
				if ( is_single() || is_page()  ) {
					if( 'single' === $type && ! ('product' === $post->post_type) ) {
						$file = LEVELUP__FILE__PATH.'inc/templates/header-footer.php';
			
				 	}
				}
				break;
		}
	}
	 
	 
	return $file;
}



/***********
**
** Common function API
**
************/
/**
 * @return true if levelup theme activated
 */
if(!function_exists('if_is_levelup')){
	function if_is_levelup(){
		$theme = wp_get_theme();
		if ( 'Level UP' == $theme->name) {
			 return true;
		}
		return false;
	}
}
/**
 * @return true if ELEMENTOR Builder Enabled
 */
if(!function_exists('if_levelup_has_builder'))  {
	
	function if_levelup_has_builder(){
		global $post;
		if(is_object($post) && get_post_meta( $post->ID, '_elementor_edit_mode', false ) ){
			return true;
		}
		return false; 
	}
}
add_filter( 'amp_post_template_data', 'ampforwp_levelup_scripts' );
function ampforwp_levelup_scripts( $data ) {
	global $redux_builder_amp;
	if ( empty( $data['amp_component_scripts']['amp-bind'] ) ) {
		$data['amp_component_scripts']['amp-bind'] = 'https://cdn.ampproject.org/v0/amp-bind-0.1.js';
	}

	return $data;
}