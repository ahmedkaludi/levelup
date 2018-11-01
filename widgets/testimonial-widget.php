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
class TestimonialWidgets extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'testimonial';
	}
	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Testimonial', LEVELUP_TEXT_DOMAIN );
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
		$scriptArray = array();
		/*$settings = $this->get_settings();
		if(isset($settings['layoutDesignSelected']) && $settings['layoutDesignSelected']=='testimonial-design-1'){
		}*/
			$scriptArray = array('levelup-testimonial-widget', 'levelup-testimonial-widget-slider');
		return $scriptArray;
	}

	public function get_style_depends() {
		$styleArray = array();
		/*$settings = $this->get_settings();
		if(isset($settings['layoutDesignSelected']) && $settings['layoutDesignSelected']=='testimonial-design-1'){
		}*/
			$styleArray = array('levelup-testimonial-widget-style');
		return ['levelup-testimonial-widget-style'];
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
		$designs = levelup_getDesignListByCategory('testimonial');
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

		// Testimonial Design 1 Fileds//
		$repeater1 = new \Elementor\Repeater();

		$repeater1->add_control(
			'tst1-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater1->add_control(
			'tst1-head', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Text' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'tst1-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'desc' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'tst1-athr', [
				'label' => esc_html__( 'Author', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Text' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'testi1-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater1->get_controls(),
				'default' => [
					[
						'tst1-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm2-5.jpg', LEVELUP_TEXT_DOMAIN ),
						'tst1-head'=> esc_html__( 'New Providence is the great UI Kit', LEVELUP_TEXT_DOMAIN ),
						'tst1-desc'=> esc_html__( 'Just then her head struck aganist the roof of the hall:in fact she was now more than nine feet high, and she at once at once took up the little gilden key and hurried off to the garden door.', LEVELUP_TEXT_DOMAIN ),
						'tst1-athr'=> esc_html__( 'CAMERON DOWMAN', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'tst1-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm2-3.jpg', LEVELUP_TEXT_DOMAIN ),
						'tst1-head'=> esc_html__( 'Take a Look at Our Awesome New Product', LEVELUP_TEXT_DOMAIN ),
						'tst1-desc'=> esc_html__( 'Of course we haven\'t forgotten about the responsive layout. Create a website with full mobile support.', LEVELUP_TEXT_DOMAIN ),
						'tst1-athr'=> esc_html__( 'BRAIN OAKMAN', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'tst1-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm2-2.jpg', LEVELUP_TEXT_DOMAIN ),
						'tst1-head'=> esc_html__( 'Innovating Themes for the Future', LEVELUP_TEXT_DOMAIN ),
						'tst1-desc'=> esc_html__( 'Easily change and tweak your content when you need to, however you want, No more third party wendor lock-in.', LEVELUP_TEXT_DOMAIN ),
						'tst1-athr'=> esc_html__( 'EVAN BARRINGTON ', LEVELUP_TEXT_DOMAIN ),
					],
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'testimonial-design-1',
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

}//Class Closed