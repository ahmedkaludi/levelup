<?php
namespace LevelupWidgets\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Elementor Cta widget
 *
 * Elementor widget for Cta widget.
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
				'label' => esc_html__( 'Choose Background Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/09/default-img.jpg',
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
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Start Creating Right Now' , LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'A high-quality solution for those who want a beautiful</br>Levelup websitr quickely.', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get Started for $249' , LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' ),
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
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/cta-2-1.jpg',
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
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'The same beautiful experience across devices.' , LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Get a fully retina ready site when you build with Levelup Framework. Websites look sharper and more gorgeous on devices with retina display support.', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn More' , LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' ),
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
				'label' => esc_html__( 'Choose Background Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/09/default-img.jpg',
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
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Easy to setup. Easy to maintain.' , LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Bootstrap is a widely-used, sleek, intuitive and powerful front-end framework for faster and easier web development.', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get Started for Free' , LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' ),
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
				'label' => esc_html__( 'Choose Background Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/09/default-img.jpg',
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
				'label' => esc_html__( 'Label', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'GET STARTED' , LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Better for your Levelup.' , LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'We have created a new product that will help designers, developers and companies create websites for their Levelup quickly and easily', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Google Play' , LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' ),
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
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/cta-4-1.png',
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
		// CTA Design 5 Fields //
		$this->add_control(
			'cta-head5', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Start Working Faster' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-5',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-desc5',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'No payment required, jump in and get started.', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-5',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btn5', [
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get a License' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-5',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btnlnk5', [
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-5',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-image5',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/cta-5.png',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-5',
						)
					)
				)
			]
		);
		// CTA Design 6 Fields //
		$this->add_control(
			'cta-head6', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'They made signs for me to come down from the rock, and go' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-desc6',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Now the races of these two haven been for some ages utterly extinct, and besides.', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btn6-1', [
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get a License' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btnlnk6-1', [
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btn6-2', [
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn More' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-btnlnk6-2', [
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cta-image6',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/cta-6.png',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'cta-design-6',
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