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
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
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
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get Started for Free' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater1->add_control(
			'pricing-btn-1-lnk',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
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