<?php
namespace LevelupWidgets\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Elementor Category widget
 *
 * Elementor widget for Category widget.
 *
 * @since 1.0.0
 */
class CtaWidgets extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cta';
	}
	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'CTA', LEVELUP_TEXT_DOMAIN );
	}
	/**
	 * Retrieve the widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-list';
	}
	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'levelup-widgets' ];
	}
	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'cta-widget' ];
	}
	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', LEVELUP_TEXT_DOMAIN ),
			)
		);
		$designs = levelup_getDesignListByCategory('cta');
		$defaultDesign = '';
		$defaultDesign = array_keys($designs);
		$defaultDesign = isset($defaultDesign[0])? $defaultDesign[0] : '';
		$this->add_control(
			'layoutDesignSelected',
			array(
				'label' 	=> esc_html__( 'design Selection', LEVELUP_TEXT_DOMAIN ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default'	=>$defaultDesign,
				'options'	=>$designs,
				'show_label'=>false,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelectionpoup',
							'value' => 'no',
						)
					)
				)
			)
		);

		$this->add_control(
			'layoutDesignSelectionpoup',
			array(
				'label' => esc_html__( 'Is first drop', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default'=>'no',
			)
		);

		// CTA Design 1 Fields //
		$this->add_control(
			'cta-image1',
			[
				'label' => __( 'Choose Background Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-1',
						)
					)
				)
			]
		);
		 $this->add_control(
			'cta-head1', [
				'label' => __( 'Heading', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Start Creating Right Now' , 'plugin-domain' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-1',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-desc1',
			[
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( 'A high-quality solution for those who want a beautiful startup websitr quickely.', 'plugin-domain' ),
				'placeholder' => __( 'Type your description here', 'plugin-domain' ),
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-1',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btn1', [
				'label' => __( 'Button Text', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Get Started for $249' , 'plugin-domain' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-1',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btnlnk1', [
				'label' => __( 'Button Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '#' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-1',
						)
					)
				)
			]
		);
		// CTA Design 2 Fields //
		$this->add_control(
			'cta-image2',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-head2', [
				'label' => __( 'Heading', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'The same beautiful experience across devices.' , 'plugin-domain' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-desc2',
			[
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( 'Get a fully retina ready site when you build with Startup Framework. Websites look sharper and more gorgeous on devices with retina display support.', 'plugin-domain' ),
				'placeholder' => __( 'Type your description here', 'plugin-domain' ),
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btn2', [
				'label' => __( 'Button Text', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Learn More' , 'plugin-domain' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btnlnk2', [
				'label' => __( 'Button Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '#' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-2',
						)
					)
				)
			]
		);
		// CTA Design 3 Fields //
		$this->add_control(
			'cta-image3',
			[
				'label' => __( 'Choose Background Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-head3', [
				'label' => __( 'Heading', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Easy to setup. Easy to maintain.' , 'plugin-domain' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-desc3',
			[
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( 'Bootstrap is a widely-used, sleek, intuitive and powerful front-end framework for faster and easier web development.', 'plugin-domain' ),
				'placeholder' => __( 'Type your description here', 'plugin-domain' ),
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btn3', [
				'label' => __( 'Button Text', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Get Started for Free' , 'plugin-domain' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btnlnk3', [
				'label' => __( 'Button Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '#' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-3',
						)
					)
				)
			]
		);
		// CTA Design 4 Fields //
		$this->add_control(
			'cta-bgimage4',
			[
				'label' => __( 'Choose Background Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-txt4', [
				'label' => __( 'Label', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'GET STARTED' , 'plugin-domain' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-head4', [
				'label' => __( 'Heading', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Better for your startup.' , 'plugin-domain' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-desc4',
			[
				'label' => __( 'Description', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( 'We have created a new product that will help designers, developers and companies create websites for their startups quickly and easily', 'plugin-domain' ),
				'placeholder' => __( 'Type your description here', 'plugin-domain' ),
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btn4', [
				'label' => __( 'Button Text', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Google Play' , 'plugin-domain' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btnlnk4', [
				'label' => __( 'Button Link', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '#' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-image4',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-4',
						)
					)
				)
			]
		);

		$this->end_controls_section();

	}//Control settings are closed
	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();

		$markup = \LevelupDesign\render($settings);
		if($markup){
			$markup = $this->replacements_procees($settings,$markup);
		}
		echo $markup;
	}
	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 */
	/*protected function _content_template() {
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
	}*/
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

	private function replacements_procees( $settingArray, $markup ){
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

	private function replaceIfContentConditional($byReplace, $replaceWith, $string){
		preg_match_all("{{if_condition_".$byReplace."==(.*?)}}", $string,$matches);
		if(isset($matches[1]) && count($matches[1])>0){
			$matches[1] = array_unique($matches[1]);
			foreach ($matches[1] as $key => $matchValue) {
				if(trim($matchValue) != trim($replaceWith)){
					$string = str_replace(array("{{if_condition_".$byReplace."==".$matchValue."}}","{{ifend_condition_".$byReplace."_".$matchValue."}}"), array("<amp-condition>","</amp-condition>"), $string);
					
					$string = preg_replace_callback('/(<amp-condition>)(.*?)(<\/amp-condition>)/s', function($match){
						return "";
					}, $string);
				}else{
					$string = str_replace(array("{{if_condition_".$byReplace."==".$matchValue."}}","{{ifend_condition_".$byReplace."_".$matchValue."}}"), array("",""), $string);
				}
			}//FOreach Closed
		}//If Closed

		if(strpos($string,'{{if_'.$byReplace.'}}')!==false){
			$string = str_replace(array('{{if_'.$byReplace.'}}','{{ifend_'.$byReplace.'}}',), array("<amp-condition>","</amp-condition>"), $string);
			if($replaceWith=="" && trim($replaceWith)==""){
				$string = preg_replace("/<amp-condition>(.*)<\/amp-condition>/i", "", $string);
				$string = preg_replace("/<amp-condition>(.*)<\/amp-condition>/s", "", $string);
			}
			$string = str_replace(array('<amp-condition>','</amp-condition>'), array("",""), $string);
		}
		return $string;
	}

}//Class Closed