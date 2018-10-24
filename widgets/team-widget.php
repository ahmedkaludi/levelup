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
class TeamWidgets extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'team';
	}
	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Team', LEVELUP_TEXT_DOMAIN );
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
		return [ 'team-widget' ];
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
		$designs = levelup_getDesignListByCategory('team');
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

		// Team Design 1 Fileds//
		 $this->add_control(
			'team-head1', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Great crew of Startup Framework' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-1',
						)
					)
				)
			]
		);
		$repeater1 = new \Elementor\Repeater();

		$repeater1->add_control(
			'tm1-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater1->add_control(
			'tm1-title', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'tm1-desig', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Designation' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'tm1-desc',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'tm1-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater1->get_controls(),
				'default' => [
					[
						'tm1-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm-1.png', LEVELUP_TEXT_DOMAIN ),
						'tm1-title'=>__( 'Nicole Fisher', LEVELUP_TEXT_DOMAIN ),
						'tm1-desig'=>__( 'PRODUCT MANAGER', LEVELUP_TEXT_DOMAIN ),
						'tm1-desc'=>__( 'Designer who makes easy to change and easy to create new elements.', LEVELUP_TEXT_DOMAIN ),
						
					],
					[
						'tm1-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm-2.png', LEVELUP_TEXT_DOMAIN ),
						'tm1-title'=>__( 'Megan Douglas', LEVELUP_TEXT_DOMAIN ),
						'tm1-desig'=>__( 'CEO', LEVELUP_TEXT_DOMAIN ),
						'tm1-desc'=>__( 'Designer who makes easy to change and easy to create new elements.', LEVELUP_TEXT_DOMAIN ),
						
					],
					[
						'tm1-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm-3.png', LEVELUP_TEXT_DOMAIN ),
						'tm1-title'=>__( 'John Carrington', LEVELUP_TEXT_DOMAIN ),
						'tm1-desig'=>__( 'DEVELOPER', LEVELUP_TEXT_DOMAIN ),
						'tm1-desc'=>__( 'Designer who makes easy to change and easy to create new elements.', LEVELUP_TEXT_DOMAIN ),
						
					],
					[
						'tm1-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm-4.png', LEVELUP_TEXT_DOMAIN ),
						'tm1-title'=>__( 'Trinity Sherlock', LEVELUP_TEXT_DOMAIN ),
						'tm1-desig'=>__( 'DESIGNER', LEVELUP_TEXT_DOMAIN ),
						'tm1-desc'=>__( 'Designer who makes easy to change and easy to create new elements.', LEVELUP_TEXT_DOMAIN ),
						
					],
					[
						'tm1-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm-5.png', LEVELUP_TEXT_DOMAIN ),
						'tm1-title'=>__( 'Jake Cramer', LEVELUP_TEXT_DOMAIN ),
						'tm1-desig'=>__( 'WRITER', LEVELUP_TEXT_DOMAIN ),
						'tm1-desc'=>__( 'Designer who makes easy to change and easy to create new elements.', LEVELUP_TEXT_DOMAIN ),
						
					],
					[
						'tm1-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm-6.png', LEVELUP_TEXT_DOMAIN ),
						'tm1-title'=>__( 'Brandin Coleman', LEVELUP_TEXT_DOMAIN ),
						'tm1-desig'=>__( 'WRITER', LEVELUP_TEXT_DOMAIN ),
						'tm1-desc'=>__( 'Designer who makes easy to change and easy to create new elements.', LEVELUP_TEXT_DOMAIN ),
						
					],
					
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-1',
						)
					)
				)
			]
		);

		// Team Design 2 Fileds//
		$this->add_control(
			'tm2-bg-image',
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
							'value' => 'team-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
			'team2-head', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Our Crew' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
			'team2-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Samples will show you the feeling on how to play around using the components in the website building process.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-2',
						)
					)
				)
			]
		);

		$repeater2 = new \Elementor\Repeater();

		$repeater2->add_control(
			'tm2-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater2->add_control(
			'tm2-title', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);

		$repeater2->add_control(
			'tm2-tw', [
				'label' => esc_html__( 'Icon', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => levelup_get_font_icons(),
				'default' => 'fa fa-twitter',
			]
		);
		$repeater2->add_control(
			'tm2-twlnk', [
				'label' => esc_html__( 'Icon Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater2->add_control(
			'tm2-fb', [
				'label' => esc_html__( 'Icon', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => levelup_get_font_icons(),
				'default' => 'fa fa-facebook-square',
			]
		);
		$repeater2->add_control(
			'tm2-fblnk', [
				'label' => esc_html__( 'Icon Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater2->add_control(
			'tm2-gt', [
				'label' => esc_html__( 'Icon', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => levelup_get_font_icons(),
				'default' => 'fa fa-github',
			]
		);
		$repeater2->add_control(
			'tm2-gtlnk', [
				'label' => esc_html__( 'Icon Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tm2-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater2->get_controls(),
				'default' => [
					[
						'tm2-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm2-5.jpg', LEVELUP_TEXT_DOMAIN ),
						'tm2-title'=>__( 'SAMANTHA GIMSON', LEVELUP_TEXT_DOMAIN ),
						'tm2-tw'=> esc_html__( 'fa fa-twitter', LEVELUP_TEXT_DOMAIN ),
						'tm2-twlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm2-fb'=> esc_html__( 'fa fa-facebook-square', LEVELUP_TEXT_DOMAIN ),
						'tm2-fblnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm2-gt'=> esc_html__( 'fa fa-github', LEVELUP_TEXT_DOMAIN ),
						'tm2-gtlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'tm2-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm2-2.jpg', LEVELUP_TEXT_DOMAIN ),
						'tm2-title'=>__( 'EVAN BARRINGTON', LEVELUP_TEXT_DOMAIN ),
						'tm2-tw'=> esc_html__( 'fa fa-twitter', LEVELUP_TEXT_DOMAIN ),
						'tm2-twlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm2-fb'=> esc_html__( 'fa fa-facebook-square', LEVELUP_TEXT_DOMAIN ),
						'tm2-fblnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm2-gt'=> esc_html__( 'fa fa-github', LEVELUP_TEXT_DOMAIN ),
						'tm2-gtlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'tm2-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/tm2-3.jpg', LEVELUP_TEXT_DOMAIN ),
						'tm2-title'=>__( 'BRAIN OAKMAN', LEVELUP_TEXT_DOMAIN ),
						'tm2-tw'=> esc_html__( 'fa fa-twitter', LEVELUP_TEXT_DOMAIN ),
						'tm2-twlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm2-fb'=> esc_html__( 'fa fa-facebook-square', LEVELUP_TEXT_DOMAIN ),
						'tm2-fblnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm2-gt'=> esc_html__( 'fa fa-github', LEVELUP_TEXT_DOMAIN ),
						'tm2-gtlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
					],
					
					
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
			'tm2-btn', [
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'View our Crew' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
			'tm2-btnlnk', [
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
			'tm2-angl', [
				'label' => esc_html__( 'Icon', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => levelup_get_font_icons(),
				'default' => 'fa-angle-right',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-2',
						)
					)
				)
			]
		);

		// Team Design 3 Fileds//
		
		$this->add_control(
			'team3-head', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Our Awesome Team' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'team3-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'We have created a new product that will help designers, developers and companies create website for their startups quickly and easily.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'tm3-btn', [
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'ENJOY OUR TEAM' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'tm3-btnlnk', [
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-3',
						)
					)
				)
			]
		);
		$repeater3 = new \Elementor\Repeater();

		$repeater3->add_control(
			'tm3-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater3->add_control(
			'tm3-title', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);

		$repeater3->add_control(
			'tm3-desig', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Designation' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);

		$repeater3->add_control(
			'tm3-tw', [
				'label' => esc_html__( 'Icon', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => levelup_get_font_icons(),
				'default' => 'fa fa-twitter',
			]
		);
		$repeater3->add_control(
			'tm3-twlnk', [
				'label' => esc_html__( 'Icon Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater3->add_control(
			'tm3-fb', [
				'label' => esc_html__( 'Icon', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => levelup_get_font_icons(),
				'default' => 'fa fa-facebook-square',
			]
		);
		$repeater3->add_control(
			'tm3-fblnk', [
				'label' => esc_html__( 'Icon Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater3->add_control(
			'tm3-gt', [
				'label' => esc_html__( 'Icon', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => levelup_get_font_icons(),
				'default' => 'fa fa-github',
			]
		);
		$repeater3->add_control(
			'tm3-gtlnk', [
				'label' => esc_html__( 'Icon Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tm3-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater3->get_controls(),
				'default' => [
					[
						'tm3-image' => esc_html__( '', LEVELUP_TEXT_DOMAIN ),
						'tm3-title'=>__( 'Vanessa Laird', LEVELUP_TEXT_DOMAIN ),
						'tm3-desig'=>__( 'UI DESIGNER', LEVELUP_TEXT_DOMAIN ),
						'tm3-tw'=> esc_html__( 'fa fa-twitter', LEVELUP_TEXT_DOMAIN ),
						'tm3-twlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm3-fb'=> esc_html__( 'fa fa-facebook-square', LEVELUP_TEXT_DOMAIN ),
						'tm3-fblnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm3-gt'=> esc_html__( 'fa fa-github', LEVELUP_TEXT_DOMAIN ),
						'tm3-gtlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'tm3-image' => esc_html__( '', LEVELUP_TEXT_DOMAIN ),
						'tm3-title'=>__( 'Manson Campbell', LEVELUP_TEXT_DOMAIN ),
						'tm3-desig'=>__( 'UI DESIGNER', LEVELUP_TEXT_DOMAIN ),
						'tm3-tw'=> esc_html__( 'fa fa-twitter', LEVELUP_TEXT_DOMAIN ),
						'tm3-twlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm3-fb'=> esc_html__( 'fa fa-facebook-square', LEVELUP_TEXT_DOMAIN ),
						'tm3-fblnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm3-gt'=> esc_html__( 'fa fa-github', LEVELUP_TEXT_DOMAIN ),
						'tm3-gtlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'tm3-image' => esc_html__( '', LEVELUP_TEXT_DOMAIN ),
						'tm3-title'=>__( 'Irea Evans', LEVELUP_TEXT_DOMAIN ),
						'tm3-desig'=>__( 'CLIENT MANAGER', LEVELUP_TEXT_DOMAIN ),
						'tm3-tw'=> esc_html__( 'fa fa-twitter', LEVELUP_TEXT_DOMAIN ),
						'tm3-twlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm3-fb'=> esc_html__( 'fa fa-facebook-square', LEVELUP_TEXT_DOMAIN ),
						'tm3-fblnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'tm3-gt'=> esc_html__( 'fa fa-github', LEVELUP_TEXT_DOMAIN ),
						'tm3-gtlnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
					],
					
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'team-design-3',
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