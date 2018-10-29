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
class PricingWidgets extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'pricing';
	}
	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Pricing', LEVELUP_TEXT_DOMAIN );
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
		return [ 'pricing-widget' ];
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
		$designs = levelup_getDesignListByCategory('pricing');
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

		// Pricing Design 1 Fileds//
		$this->add_control(
			'pricing-head1', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Pricing Plans' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-1',
						)
					)
				)
			]
		);
		 $this->add_control(
			'pricing-desc1', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Start with free trail. No credit card needed. Cancel at anytime.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-1',
						)
					)
				)
			]
		);
		$repeater1 = new \Elementor\Repeater();

		$repeater1->add_control(
			'pricing-lst-head1', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Text' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'pricing-lst-lbl1', [
				'label' => esc_html__( 'Label', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Label' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'pricing-lst-pri-1', [
				'label' => esc_html__( 'Price', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '0' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'pricing-btn-1', [
				'label' => esc_html__( 'Button', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get Started for Free' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'pricing-btn-1-lnk',
			[
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'rows' => 10,
				'default' => esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
			]
		);

		$repeater1->add_control(
			'pricing-btn-1-Facilities',
			[
				'label' => esc_html__( 'features', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( '', LEVELUP_TEXT_DOMAIN ),
				
				'description'=> esc_html__( 'Enter Content with semicolon (;) to saperate features', LEVELUP_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'pric1-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater1->get_controls(),
				'default' => [
					[
						'pricing-lst-head1' => esc_html__( 'Free', LEVELUP_TEXT_DOMAIN ),
						'pricing-lst-lbl1'=> esc_html__( 'Forever Free', LEVELUP_TEXT_DOMAIN ),
						'pricing-lst-pri-1'=> esc_html__( '0', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1'=> esc_html__( 'Get Started for Free', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1-lnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1-Facilities'=> esc_html__( '1GB of Space', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'pricing-lst-head1' => __( 'Starter', LEVELUP_TEXT_DOMAIN ),
						'pricing-lst-lbl1'=>__( 'Perfect for Freelancers', LEVELUP_TEXT_DOMAIN ),
						'pricing-lst-pri-1'=>__( '19', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1'=>__( 'Get Started', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1-lnk'=>__( '#', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1-Facilities'=> esc_html__( '1GB of Space;Unlimited Projects;Unlimited Users', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'pricing-lst-head1' => __( 'Pro', LEVELUP_TEXT_DOMAIN ),
						'pricing-lst-lbl1'=>__( 'Perfect for Small Team', LEVELUP_TEXT_DOMAIN ),
						'pricing-lst-pri-1'=>__( '49', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1'=>__( 'Get Started', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1-lnk'=>__( '#', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1-Facilities'=> esc_html__( '1GB of Space;Unlimited Projects;Unlimited Users;Unlimited Dates', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'pricing-lst-head1' => __( 'Premium', LEVELUP_TEXT_DOMAIN ),
						'pricing-lst-lbl1'=>__( 'Forever Free', LEVELUP_TEXT_DOMAIN ),
						'pricing-lst-pri-1'=>__( '149', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1'=>__( 'Go Premium', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1-lnk'=>__( '#', LEVELUP_TEXT_DOMAIN ),
						'pricing-btn-1-Facilities'=> esc_html__( '1GB of Space;Unlimited Projects;Unlimited Users;Unlimited Dates;Unlimited File Recovery', LEVELUP_TEXT_DOMAIN ),
					],
					
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-1',
						)
					)
				)
			]
		);
		//Pricing Module Design 2
		$this->add_control(
			'pricing2-head', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Not sure how much you\'ll send?' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-2',
						)
					)
				)
			]
		);
		 $this->add_control(
			'pricing2-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Use the Levelup Framework for free with no limits.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-2',
						)
					)
				)
			]
		);

		$this->add_control(
			'pricing2-text', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Free Plan' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
			'pricing2-label', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '20.000 CUSTOMERS' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
			'pricing2-desc2', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Startp Framework is free forever-- you only pay for custom domain hsosting or to export your site.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
				'pricing2-btn', [
				'label' => esc_html__( 'Button', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Try for Free' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-2',
						)
					)
				)
			]
		);
		$this->add_control(
				'pricing2-btn-lnk',[
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'rows' => 10,
				'default' => esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-2',
						)
					)
				)
			]
		);
		//Pricing Module Design 3
		$this->add_control(
			'pricing3-head', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Simple Membership' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-3',
						)
					)
				)
			]
		);
		 $this->add_control(
			'pricing3-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Use the Levelup Framework for free with no limits.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'pricing3-label-1', [
				'label' => esc_html__( 'Label 1', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Monthly' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-3',
						)
					)
				)
			]
		);
		$this->add_control(
			'pricing3-label-2', [
				'label' => esc_html__( 'Label 2', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Yearly' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-3',
						)
					)
				)
			]
		);
		$repeater3 = new \Elementor\Repeater();

		$repeater3->add_control(
			'pri3-image',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/placeholder.png',
				],
			]
		);

		$repeater3->add_control(
			'pricing3-lbl-nm', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Text' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater3->add_control(
			'pricing3-pric', [
				'label' => esc_html__( 'Price', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '0' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater3->add_control(
			'pricing3-desc3',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
			]
		);
		$repeater3->add_control(
			'pricing3-btn', [
				'label' => esc_html__( 'Button', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get Started for Free' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater3->add_control(
			'pricing3-btn-lnk',
			[
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'rows' => 10,
				'default' => esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'pric3-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater3->get_controls(),
				'default' => [
					[
						'pri3-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/pri-3-1.png', LEVELUP_TEXT_DOMAIN ),
						'pricing3-lbl-nm'=> esc_html__( 'Starter', LEVELUP_TEXT_DOMAIN ),
						'pricing3-pric'=> esc_html__( '19', LEVELUP_TEXT_DOMAIN ),
						'pricing3-desc3'=> esc_html__( 'Unlimited recipes, plans, programs and more. All you need to make eating healthy ridiculously simple and fun.', LEVELUP_TEXT_DOMAIN ),
						'pricing3-btn'=> esc_html__( 'Get Started for Free', LEVELUP_TEXT_DOMAIN ),
						'pricing3-btn-lnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'pri3-image' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/pri-3-2.png', LEVELUP_TEXT_DOMAIN ),
						'pricing3-lbl-nm'=> esc_html__( 'Professional', LEVELUP_TEXT_DOMAIN ),
						'pricing3-pric'=> esc_html__( '49', LEVELUP_TEXT_DOMAIN ),
						'pricing3-desc3'=> esc_html__( 'Unlock poweful time-saving tools for creating beautiful meal plans and transform your wellness business.', LEVELUP_TEXT_DOMAIN ),
						'pricing3-btn'=> esc_html__( 'Get Started for Free', LEVELUP_TEXT_DOMAIN ),
						'pricing3-btn-lnk'=> esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
					],
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-3',
						)
					)
				)
			]
		);
		//Pricing Module Design 4
		$this->add_control(
			'pricing4-head', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Choose your perfect plan' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'pricing4-desc', [
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'We thought - Mr.Copperfield thought -it was quite a alrge rookery;but the rests were very old ones, and the birds have desertec them a long while.' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'pricing4-text', [
				'label' => esc_html__( 'Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Have a bigger team?' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'pricing4-ln-txt', [
				'label' => esc_html__( 'Text Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Let\'s talk' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'pricing4-lnk', [
				'label' => esc_html__( 'Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-4',
						)
					)
				)
			]
		);
		$repeater4 = new \Elementor\Repeater();

		$repeater4->add_control(
			'pricing4-lst-head1', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Text' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater4->add_control(
			'pricing4-lst-lbl', [
				'label' => esc_html__( 'Label', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Label' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater4->add_control(
			'pricing4-txt', [
				'label' => esc_html__( 'text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Text' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater4->add_control(
			'pricing4-lst-Facilities',
			[
				'label' => esc_html__( 'features', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( '', LEVELUP_TEXT_DOMAIN ),
				
				'description'=> esc_html__( 'Enter Content with semicolon (;) to saperate features', LEVELUP_TEXT_DOMAIN ),
			]
		);
		$repeater4->add_control(
			'pricing4-btn', [
				'label' => esc_html__( 'Button', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get Started' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater4->add_control(
			'pricing4-btn-lnk',
			[
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'rows' => 10,
				'default' => esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'pric4-rep',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater4->get_controls(),
				'default' => [
					[
						'pricing4-lst-head1' => __( 'Starter', LEVELUP_TEXT_DOMAIN ),
						'pricing4-lst-lbl'=>__( 'Free', LEVELUP_TEXT_DOMAIN ),
						'pricing4-txt'=>__( 'Build your schedule every day', LEVELUP_TEXT_DOMAIN ),
						'pricing4-lst-Facilities'=> esc_html__( 'Unlimitied events;Connect Dropbox & Evernote', LEVELUP_TEXT_DOMAIN ),
						'pricing4-btn'=>__( 'Get Started', LEVELUP_TEXT_DOMAIN ),
						'pricing4-btn-lnk'=>__( '#', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'pricing4-lst-head1' => __( 'Pro', LEVELUP_TEXT_DOMAIN ),
						'pricing4-lst-lbl'=>__( '$4.99', LEVELUP_TEXT_DOMAIN ),
						'pricing4-txt'=>__( 'Make your life better', LEVELUP_TEXT_DOMAIN ),
						'pricing4-lst-Facilities'=> esc_html__( 'Unlimitied events;Connect Dropbox & Evernote;Personal Assistant', LEVELUP_TEXT_DOMAIN ),
						'pricing4-btn'=>__( 'Make me a Pro', LEVELUP_TEXT_DOMAIN ),
						'pricing4-btn-lnk'=>__( '#', LEVELUP_TEXT_DOMAIN ),
					],
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'pricing-design-4',
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