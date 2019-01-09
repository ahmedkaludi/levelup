<?php
namespace LevelupWidgets\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Elementor Presentation widget
 *
 * Elementor widget for Presentation widget.
 *
 * @since 1.0.0
 */
class PresentationWidgets extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'content-presentation';
	}
	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Content Presentation', LEVELUP_TEXT_DOMAIN );
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
		return [ 'content-presentation-widget' ];
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
				'label' => esc_html__( 'Content Presentation', LEVELUP_TEXT_DOMAIN ),
			)
		);
		$designs = levelup_getDesignListByCategory('content-presentation');
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

		// Content Presentation Design 1 Fields //
		$this->add_control(
			'cp1-heading1', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Take a Look at Our Awesome New Product' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-1',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp1-block-1-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Of course we haven\'t forgotten about the responsive layout. Create a website with full mobile support.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-1',
						)
					)
				)
			]
		);
				$this->add_control(
			'cp1-ic',
			[
				'label' => esc_html__( 'Icons', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => levelup_get_font_icons(),
				'default' => 'fa fa-apple',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-1',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp1-block-1-btn', [
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Avaliable on App Store' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-1',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp1-block-1-btnlnk', [
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-1',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp1-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/cp-1.png',
				],
			'conditions'=> array(
				'terms'	=> array(
					array(
						'name' => 'layoutDesignSelected',
						'value' => 'content-presentation-design-1',
					)
				)
			)
			]
		);
		$repeater1 = new \Elementor\Repeater();

		$repeater1->add_control(
			'title-1', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'text_description1',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'cp1-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater1->get_controls(),
				'default' => [
					[
						'title-1'=>__( 'FULL CONTROL', LEVELUP_TEXT_DOMAIN ),
						'text_description1'=>__( 'Easily change and tweak your content when you need to, however you want, No more third party wendor lock-in.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'title-1'=>__( 'FOR FREELANCERS AND AGENCIES', LEVELUP_TEXT_DOMAIN ),
						'text_description1'=>__( 'Easily change and tweak your content when you need to, however you want, No more third party wendor lock-in.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'title-1'=>__( 'CMD + C / CMD + V', LEVELUP_TEXT_DOMAIN ),
						'text_description1'=>__( 'Easily change and tweak your content when you need to, however you want, No more third party wendor lock-in.', LEVELUP_TEXT_DOMAIN ),
					],
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-1',
						)
					)
				)
			]
		);
		// Content Presentation Design 2 Fields //
		$this->add_control(
			'cp2-heading1', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Samples will show you the feeling on how to display around using the components in the website building process.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-2',
						)
					)
				)
			]
		);		
		$this->add_control(
			'cp2-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/cp-2.png',
				],
			'conditions'=> array(
				'terms'	=> array(
					array(
						'name' => 'layoutDesignSelected',
						'value' => 'content-presentation-design-2',
					)
				)
			)
			]
		);
		$repeater2 = new \Elementor\Repeater();

		$repeater2->add_control(
			'title-2', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater2->add_control(
			'text_description2',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
			]
		);
		$repeater2->add_control(
			'cp2-btn', [
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Avaliable on App Store' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater2->add_control(
			'cp2-btnlnk', [
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'cp2-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater2->get_controls(),
				'default' => [
					[
						'title-2'=>__( 'How Levelup Frame works?', LEVELUP_TEXT_DOMAIN ),
						'text_description2'=>__( 'The Generator App is an onlinetoll thta helps you to export ready made templates ready to work as your future website. It helps you to combine slides, panels and other components and export it as a set of static files: HYML/CSS/JS.', LEVELUP_TEXT_DOMAIN ),
						'cp2-btn'=>__( 'View Tutorial', LEVELUP_TEXT_DOMAIN ),
						'cp2-btnlnk'=>__( '#', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'title-2'=>__( 'Do you provide hosting with Levelup Framework?', LEVELUP_TEXT_DOMAIN ),
						'text_description2'=>__( 'No, hosting is on you. You upload the result on your hosting via FTP or using tools you like. You can use any server, just make sure it have a PHP installed in case if you need a contact form.', LEVELUP_TEXT_DOMAIN ),
						'cp2-btn'=>__( 'Learn More', LEVELUP_TEXT_DOMAIN ),
						'cp2-btnlnk'=>__( '#', LEVELUP_TEXT_DOMAIN ),
					],
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-2',
						)
					)
				)
			]
		);
		// Content Presentation Design 3 Fields //
		$this->add_control(
			'cp3-heading1', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Welcome Home Designers.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp3-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'We have created a new product that will help designers, developers and companies create websites for their Levelup quickly and easily.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp3-btn', [
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Purchase Now for $248' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp3-btnlnk', [
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-3',
						)
					)
				)
			]
		);
		$repeater3 = new \Elementor\Repeater();

		$repeater3->add_control(
			'title-3', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater3->add_control(
			'text_description3',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
			]
		);	
		$this->add_control(
			'cp3-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater3->get_controls(),
				'default' => [
					[
						'title-3'=>__( 'Build Quick', LEVELUP_TEXT_DOMAIN ),
						'text_description3'=>__( 'Get a beautiful site up and running in no time. Just choose Levelup Framework you like and start tweaking it.', LEVELUP_TEXT_DOMAIN ),
						
					],
					[
						'title-3'=>__( 'A Lot of blocks', LEVELUP_TEXT_DOMAIN ),
						'text_description3'=>__( 'Enjoy endless possibilities nd results with many blocks to tinker and combine with.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'title-3'=>__( 'Fully Responsive', LEVELUP_TEXT_DOMAIN ),
						'text_description3'=>__( 'Your site will look great and work seamlessly across difference devices and platforms.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'title-3'=>__( 'Build Today', LEVELUP_TEXT_DOMAIN ),
						'text_description3'=>__( 'Transform you ideas into reality and lunch a beautiful site with minimal frustration.', LEVELUP_TEXT_DOMAIN ),
					],
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-3',
						)
					)
				)
			]
		);
		// Content Presentation Design 4 Fields //
		$this->add_control(
			'cp4-heading1', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Simple Design & prototyping' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp4-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Levelup Framework gives you complete freedom over your creative process--you don\'t have to think about any technical aspects.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp4-btn', [
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get Started' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp4-btnlnk', [
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp4-sub-heading', [
				'label' => esc_html__( 'Sub Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'It is absolutely free.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp4-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/cp-4.png',
				],
			'conditions'=> array(
				'terms'	=> array(
					array(
						'name' => 'layoutDesignSelected',
						'value' => 'content-presentation-design-4',
					)
				)
			)
			]
		);
		// Content Presentation Design 5 Fields //
		$this->add_control(
			'cp5-heading5', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'What happens tomorrow?' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp5-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'The sigh:of the tumblers restored Bob Sawyer to a degree of equanimity which he had no: possessed sice his interview with his landlacy. His face brightened up, and he began to feel quite convivial.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp5-btn', [
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Watch Video' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp5-btnlnk', [
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp5-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/iPhone-6.png',
				],
			'conditions'=> array(
				'terms'	=> array(
					array(
						'name' => 'layoutDesignSelected',
						'value' => 'content-presentation-design-5',
					)
				)
			)
			]
		);
		$this->add_control(
			'cp5-bg-image',
			[
				'label' => esc_html__( 'Choose Background Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/cp-5-bg-1.jpg',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);

		// Content Presentation Design 6 Fields //
		$this->add_control(
			'cp6-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/iPhone-6-2-1-1.png',
				],
			'conditions'=> array(
				'terms'	=> array(
					array(
						'name' => 'layoutDesignSelected',
						'value' => 'content-presentation-design-6',
					)
				)
			)
			]
		);
		$this->add_control(
			'cp6-heading', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Your day is protected' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp6-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'There have not been any since we have lived here, said my mother.
					We thought - Mr.Copperfield thought -it was quite a alrge rookery;but the rests were very old ones, and the birds have desertec them a long while.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp6-btn1', [
				'label' => esc_html__( 'Button1 Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Try to hack us' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp6-btn1lnk', [
				'label' => esc_html__( 'Button1 Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp6-btn2', [
				'label' => esc_html__( 'Button2 Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn more' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp6-btn2lnk', [
				'label' => esc_html__( 'Button2 Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);
		// Content Presentation Design 7 Fields //
		$this->add_control(
			'cp7-heading', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'we are almost everywhere' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-7',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp7-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'There have not been any since we have lived here, said my mother.We thought - Mr.Copperfield thought -it was quite a alrge rookery;but the rests were very old ones, and the birds have desertec them a long while.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-7',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp7-lg-lbl', [
				'label' => esc_html__( 'Label', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'PARTNERS' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-7',
						)
					)
				)
			]
		);
		$repeater7 = new \Elementor\Repeater();	

		$repeater7->add_control(
			'cp7-lg-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'cp7-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater7->get_controls(),
				'default' => [
					[
						'cp7-lg-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/Dropbox-Logo-1.png', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'cp7-lg-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/Evernote-Logo-1.png', LEVELUP_TEXT_DOMAIN ),
					],
					
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-7',
						)
					)
				)
			]
		);

		$this->add_control(
			'cp7-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/World-Map-1.png',
				],
			'conditions'=> array(
				'terms'	=> array(
					array(
						'name' => 'layoutDesignSelected',
						'value' => 'content-presentation-design-7',
					)
				)
			)
			]
		);
		// Content Presentation Design 8 Fields //
		$this->add_control(
			'cp8-heading', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Beautiful Intreface' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp8-label1', [
				'label' => esc_html__( 'Label 1', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'LANDING SCREEN' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp8-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
				'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/Screens-1-1.png',
				],
			'conditions'=> array(
				'terms'	=> array(
					array(
						'name' => 'layoutDesignSelected',
						'value' => 'content-presentation-design-8',
					)
				)
			)
			]
		);
		$this->add_control(
			'cp8-label2', [
				'label' => esc_html__( 'Label 2', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'NEWPROVIDENCE' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp8-sub-heading', [
				'label' => esc_html__( 'Sub Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get it to your smartphone' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp8-dwn', [
				'label' => esc_html__( 'Download Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'DOWNLOAD FROM' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);
		$repeater8 = new \Elementor\Repeater();

		$repeater8->add_control(
			'cp8-icon',
			[
				'label' => esc_html__( 'Icons', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' =>levelup_get_font_icons(),
				'default' => 'fa fa-apple',
			]
		);
		$repeater8->add_control(
			'cp8-dwn-text1', [
				'label' => esc_html__( 'Download Small Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater8->add_control(
			'cp8-dwn-text2', [
				'label' => esc_html__( 'Download Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater8->add_control(
			'cp8-dwn-lnk', [
				'label' => esc_html__( 'Download Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'cp8-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater8->get_controls(),
				'default' => [
					[
						'cp8-icon'=>__( 'fa fa-apple', LEVELUP_TEXT_DOMAIN ),
						'cp8-dwn-text1'=>__( 'Download on the', LEVELUP_TEXT_DOMAIN ),
						'cp8-dwn-text2'=>__( 'App Store', LEVELUP_TEXT_DOMAIN ),
						'cp8-dwn-lnk'=>__( '#', LEVELUP_TEXT_DOMAIN ),
						
					],
					[
						'cp8-icon'=>__( 'fa fa-play', LEVELUP_TEXT_DOMAIN ),
						'cp8-dwn-text1'=>__( 'Download on the', LEVELUP_TEXT_DOMAIN ),
						'cp8-dwn-text2'=>__( 'Play Store', LEVELUP_TEXT_DOMAIN ),
						'cp8-dwn-lnk'=>__( '#', LEVELUP_TEXT_DOMAIN ),
						
					],
					
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);


		$this->end_controls_section();
		/******
		** Style Design 5 
		** tab Title
		**/
		$this->start_controls_section(
			'cp5_title_style',
			[
				'label' => __( 'Title', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);

		$this->add_control(
			'cp5_title_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#000',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp-5 h2' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp5_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp5-a h2',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);

		// $this->add_group_control(
		// 	\Elementor\Group_Control_Text_Shadow::get_type(),
		// 	[
		// 		'name' => 'text_shadow',
		// 		'selector' => '{{WRAPPER}} h2',
		// 	]
		// );

		// $this->add_control(
		// 	'blend_mode',
		// 	[
		// 		'label' => __( 'Blend Mode', 'elementor' ),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'options' => [
		// 			'' => __( 'Normal', 'elementor' ),
		// 			'multiply' => 'Multiply',
		// 			'screen' => 'Screen',
		// 			'overlay' => 'Overlay',
		// 			'darken' => 'Darken',
		// 			'lighten' => 'Lighten',
		// 			'color-dodge' => 'Color Dodge',
		// 			'saturation' => 'Saturation',
		// 			'color' => 'Color',
		// 			'difference' => 'Difference',
		// 			'exclusion' => 'Exclusion',
		// 			'hue' => 'Hue',
		// 			'luminosity' => 'Luminosity',
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} h2' => 'mix-blend-mode: {{VALUE}}',
		// 		],
		// 		'separator' => 'none',
		// 	]
		// );

		$this->end_controls_section();

		/****** Design 5 tab description **/

		$this->start_controls_section(
			'cp5_description_style',
			[
				'label' => __( 'Description', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);

		$this->add_control(
			'cp5_description_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#555',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp5-a p' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp5_desc_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp5-a p',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);

		$this->end_controls_section();

		/****** Design 5 tab Button **/

		$this->start_controls_section(
			'cp5_button_style',
			[
				'label' => __( 'Button', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp5_button_bg_color',
			[
				'label' => __( 'Button Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#fff',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp5-b a' => 'background: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp5_button_color',
			[
				'label' => __( 'Button Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#333',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp5-b a' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp5_button_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp5-b a',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-5',
						)
					)
				)
			]
		);

		$this->end_controls_section();

		/******
		** Style Design 6 
		** tab Title
		**/
		$this->start_controls_section(
			'cp6_title_style',
			[
				'label' => __( 'Title', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);

		$this->add_control(
			'cp6_title_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#111',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp-6 h2' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp6_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp-6 h2',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);

		$this->end_controls_section();

		/****** Design 6 tab description **/

		$this->start_controls_section(
			'cp6_description_style',
			[
				'label' => __( 'Description', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);

		$this->add_control(
			'cp6_description_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#333',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp-6 p' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp6_desc_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp-6 p',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);

		$this->end_controls_section();

		/****** Design 6 tab Button1 **/
		
		$this->start_controls_section(
			'cp6_button1_style',
			[
				'label' => __( 'Button1', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);

		$this->add_control(
			'cp6_button1_color',
			[
				'label' => __( 'Button Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#fff',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp-6-1 a' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp6_button1_bgcolor',
			[
				'label' => __( 'Button Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#267DF4',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp-6-1 a' => 'background: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp6_button1_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp-6-1 a',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]

		);

		$this->end_controls_section();

		/****** Design 6 tab Button2 **/
		
		$this->start_controls_section(
			'cp6_button2_style',
			[
				'label' => __( 'Button2', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);

		$this->add_control(
			'cp6_button2_color',
			[
				'label' => __( 'Button Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#000',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp-6-2 a' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp6_button2_bgcolor',
			[
				'label' => __( 'Button Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#fff',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp-6-2 a' => 'background: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp6_button2_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp-6-2 a',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-6',
						)
					)
				)
			]
		);

		$this->end_controls_section();

		/******
		** Style Design 8 
		** tab Title
		**/
		$this->start_controls_section(
			'cp8a_title_style',
			[
				'label' => __( 'Top Title', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->add_control(
			'cp8a_title_color',
			[
				'label' => __( 'Title Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#111',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp8-a h2' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp8a_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp8-a h2',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->end_controls_section();

		/****** Design 8a tab text **/

		$this->start_controls_section(
			'cp8a_text_style',
			[
				'label' => __( 'Top Text', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->add_control(
			'cp8a_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#666',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp8-a span' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp8a_text_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp8-a span',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->end_controls_section();

		/****** Design 8c tab description **/

		$this->start_controls_section(
			'cp8c_text_style',
			[
				'label' => __( 'Bottom Text', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->add_control(
			'cp8c_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#666',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp8-c span.np' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp8c_text_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp8-c span.np',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->end_controls_section();

		/****** Design 8c Title description **/

		$this->start_controls_section(
			'cp8c_title_style',
			[
				'label' => __( 'Bottom Title', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->add_control(
			'cp8c_title_color',
			[
				'label' => __( 'Title Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#111',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp8-c h2' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp8c_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp8-a h2',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);

		$this->end_controls_section();


		/****** Design 8c Button **/
		
		$this->start_controls_section(
			'cp8_button_style',
			[
				'label' => __( 'Buttons', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp8c_button-toptext_color',
			[
				'label' => __( 'Button Top Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#a0a0a0',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .dwf' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp8c_button_color',
			[
				'label' => __( 'Buttons Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#fff',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp8c-btns a' => 'color: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);
		$this->add_control(
			'cp8c_button_bgcolor',
			[
				'label' => __( 'Buttons Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#131315',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .cp8c-btns a' => 'background: {{VALUE}};',
				],
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
						)
					)
				)
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cp8c_buttons_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp8c-btns',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'content-presentation-design-8',
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