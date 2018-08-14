<?php
namespace AMPforWpElementorWidgets\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class AMPforWpWidgets extends Widget_Base {
	public $slug = 'about';
	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'about';
	}
	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'About', 'about' );
	}
	/**
	 * Retrieve the widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
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
		return [ 'ampforwp-widgets' ];
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
		return [ 'about' ];
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
			[
				'label' => __( 'Content', 'about' ),
			]
		);
		$designs = getDesignListByCategory('about');
		$defaultDesign = '';
		$defaultDesign = array_keys($designs);
		$defaultDesign = $defaultDesign[0];
		$this->add_control(
			'layoutDesignSelected',
			[
				'label' => __( 'design Selection', 'about' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default'=>$defaultDesign,
				'options'=>$designs
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'about' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'about' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_transform',
			[
				'label' => __( 'Text Transform', 'about' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None', 'hello-world' ),
					'uppercase' => __( 'UPPERCASE', 'about' ),
					'lowercase' => __( 'lowercase', 'about' ),
					'capitalize' => __( 'Capitalize', 'about' ),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}
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

		$the_slug = $settings['layoutDesignSelected'];
		$args = array(
		  'post__in'        => array($the_slug),
		  'post_type'   => elem_ampforwp_basics('post_type'),
		  'post_status' => 'publish',
		  'numberposts' => 1
		);
		$my_posts = get_posts($args);
		if(function_exists('ampforwp_is_amp_endpoint') && ampforwp_is_amp_endpoint()){
			$ampMarkup = get_post_meta($my_posts[0]->ID, 'amp_html_markup',true);
			if(!empty($ampMarkup)){
				$ampMarkup = json_decode($ampMarkup,true);
				$markup = $nonAmpMarkup['amp_html'];
				$non_amp_css = $nonAmpMarkup['amp_css'];
			}
		}else{
			$nonAmpMarkup = get_post_meta($my_posts[0]->ID, 'non_amp_html_markup',true);
			if(!empty($nonAmpMarkup)){
				$nonAmpMarkup = json_decode($nonAmpMarkup,true);
				$markup = $nonAmpMarkup['non_amp_html'];
				$non_amp_css = $nonAmpMarkup['non_amp_css'];
				if($non_amp_css){
					echo '<Style>'.$non_amp_css.'</style>';
				}
				

			}
		}
		if($markup){
			$markup = $this->replacements($settings,$markup);
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


	private function replacements( $settingArray, $markup ){
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
		return $markup;
	}
}