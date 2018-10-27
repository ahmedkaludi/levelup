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
class FeatureWidgets extends Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'feature';
	}
	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Feature', LEVELUP_TEXT_DOMAIN );
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
		return [ 'feature-widget' ];
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
				'label' => esc_html__( 'Feature Content', LEVELUP_TEXT_DOMAIN ),
			)
		);
		$designs = levelup_getDesignListByCategory('feature');
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

		// Feature Design 1 Fields //
		$this->add_control(
			'heading1', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'We Design Modern' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-1',
						)
					)
				)
			]
		);

		 $repeater = new \Elementor\Repeater();

		 $repeater->add_control(
			'icon1',
			[
				'label' => esc_html__( 'Icons', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' =>levelup_get_font_icons(),
				'default' => 'fa fa-briefcase',
			]
		);
		 $repeater->add_control(
			'title-1', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'text_desc1',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'icon1' => esc_html__( 'fa fa-briefcase', LEVELUP_TEXT_DOMAIN ),
						'title-1'=> esc_html__( 'We are a firm', LEVELUP_TEXT_DOMAIN ),
						'text_desc1'=> esc_html__( 'Nay preference dispatched difficulty continuing joy one. Songs it be if ought hoped of. Too carriage attended him entrance desirous the saw.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'icon1' => esc_html__( 'fa fa-arrows-alt', LEVELUP_TEXT_DOMAIN ),
						'title-1'=> esc_html__( 'Our latest work', LEVELUP_TEXT_DOMAIN ),
						'text_desc1'=> esc_html__( 'Nay preference dispatched difficulty continuing joy one. Songs it be if ought hoped of. Too carriage attended him entrance desirous the saw.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'icon1' => esc_html__( 'fa fa-laptop', LEVELUP_TEXT_DOMAIN ),
						'title-1'=> esc_html__( 'Digital campaign', LEVELUP_TEXT_DOMAIN ),
						'text_desc1'=> esc_html__( 'Nay preference dispatched difficulty continuing joy one. Songs it be if ought hoped of. Too carriage attended him entrance desirous the saw.', LEVELUP_TEXT_DOMAIN ),
					],
					
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-1',
						)
					)
				)
			]
		);

		// Feature Design 2 Fields //
		 $this->add_control(
			'heading2', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'We are Ready' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-2',
						)
					)
				)
			]
		);
		 $this->add_control(
			'text_desc2',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Blind would equal while oh mr do style. Lain led and fact none. One preferred sportsmen resolving the happiness continued. High at of in loud rich true.', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-2',
						)
					)
				)
			]
		);

		 $repeater2 = new \Elementor\Repeater();

		 $repeater2->add_control(
			'title2', [
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
			'icon2',
			[
				'label' => esc_html__( 'Icons', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' =>levelup_get_font_icons(),
				'default' => 'fa fa-angle-right',
			]
		);
		$repeater2->add_control(
			'link2', [
				'label' => esc_html__( 'Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		 $this->add_control(
			'ic_lst_2',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater2->get_controls(),
				'default' => [
					[
						'title2'=> esc_html__( 'Responsive creation', LEVELUP_TEXT_DOMAIN ),
						'text_description2'=> esc_html__( 'Certainly elsewhere my do allowance at. The address farther six hearted hundred towards husband. Are securing off.', LEVELUP_TEXT_DOMAIN ),
						'icon2' => esc_html__( 'fa fa-angle-right', LEVELUP_TEXT_DOMAIN ),
						'link2' => esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'title2'=> esc_html__( 'Multi-award digital agency', LEVELUP_TEXT_DOMAIN ),
						'text_description2'=> esc_html__( 'Certainly elsewhere my do allowance at. The address farther six hearted hundred towards husband. Are securing off.', LEVELUP_TEXT_DOMAIN ),
						'icon2' => esc_html__( 'fa fa-angle-right', LEVELUP_TEXT_DOMAIN ),
						'link2' => esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'title2'=> esc_html__( 'Web designing', LEVELUP_TEXT_DOMAIN ),
						'text_description2'=> esc_html__( 'Certainly elsewhere my do allowance at. The address farther six hearted hundred towards husband. Are securing off..', LEVELUP_TEXT_DOMAIN ),
						'icon2' => esc_html__( 'fa fa-angle-right', LEVELUP_TEXT_DOMAIN ),
						'link2' => esc_html__( '#', LEVELUP_TEXT_DOMAIN ),
					],
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-2',
						)
					)
				)
			]
		);

		// Feature Design 3 Fields //
		 $this->add_control(
			'heading3', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'A Global Agency Interactive' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-3',
						)
					)
				)
			]
		);
		 $this->add_control(
			'text_desc3',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Cultivated who resolution connection motionless did occasional. Journey promise if it colonel. Can all mirth abode nor hills added.', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-3',
						)
					)
				)
			]
		);
		 $this->add_control(
			'btn_txt', [
				'label' => esc_html__( 'Button', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'VIEW DEMO' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-3',
						)
					)
				)
			]
		);
		 $this->add_control(
			'link3', [
				'label' => esc_html__( 'Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-3',
						)
					)
				)
			]
		);

		 $repeater3 = new \Elementor\Repeater();

		 $repeater3->add_control(
			'icon3',
			[
				'label' => esc_html__( 'Icons', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' =>levelup_get_font_icons(),
				'default' => 'fa fa-paint-brush',
			]
		);

		$repeater3->add_control(
			'title-3', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater3->add_control(
			'text_desc3',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
			]
		);

		$this->add_control(
			'ic_lst_3',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater3->get_controls(),
				'default' => [
					[
						'icon3' => esc_html__( 'fa fa-paint-brush', LEVELUP_TEXT_DOMAIN ),
						'title-3'=> esc_html__( 'New Design', LEVELUP_TEXT_DOMAIN ),
						'text_desc3'=> esc_html__( 'Certainly elsewhere my do allowance at. The address farther six hearted hundred towards husband.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'icon3' => esc_html__( 'fa fa-code', LEVELUP_TEXT_DOMAIN ),
						'title-3'=> esc_html__( 'Creative', LEVELUP_TEXT_DOMAIN ),
						'text_desc3'=> esc_html__( 'Ten now love even supplied feelings mr of dissuade recurred no it offering honoured.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'icon3' => esc_html__( 'fa fa-adjust', LEVELUP_TEXT_DOMAIN ),
						'title-3'=> esc_html__( 'Strategy', LEVELUP_TEXT_DOMAIN ),
						'text_desc3'=> esc_html__( 'No comfort do written conduct at prevent manners on. Celebrated contrasted him occasional.', LEVELUP_TEXT_DOMAIN ),
					],
					
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-3',
						)
					)
				)
			]
		);

		// Feature Design 4 Fields //
		 $this->add_control(
			'heading4', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'We provide Lovely designs' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-4',
						)
					)
				)
			]
		);
		 $this->add_control(
			'text_desc4',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Case read they must it of cold that. Speaking trifling an to unpacked moderate debating learning. An particular contrasted he excellence favourable on.', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-4',
						)
					)
				)
			]
		);
		$repeater4 = new \Elementor\Repeater();

		$repeater4->add_control(
			'image4',
			[
				'label' => esc_html__( 'Choose Image', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => 'http://levelup.magazine3.company/wp-content/uploads/2018/10/placeholder.png',
				],
			]
		);
		$repeater4->add_control(
			'title-4', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater4->add_control(
			'text_description4',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
			]
		);

		$this->add_control(
			'ic_lst_4',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater4->get_controls(),
				'default' => [
					[
						'image4' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/feature-4-img.png', LEVELUP_TEXT_DOMAIN ),
						'title-4'=> esc_html__( 'Our Services', LEVELUP_TEXT_DOMAIN ),
						'text_description4'=> esc_html__( 'Certainly elsewhere my do allowance at. The address farther six hearted hundred towards husband.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'image4' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/feature-4-2-img.png', LEVELUP_TEXT_DOMAIN ),
						'title-4'=> esc_html__( 'Technology', LEVELUP_TEXT_DOMAIN ),
						'text_description4'=> esc_html__( 'Certainly elsewhere my do allowance at. The address farther six hearted hundred towards husband.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'image4' => esc_html__( 'http://levelup.magazine3.company/wp-content/uploads/2018/10/feature-4-3-img.png', LEVELUP_TEXT_DOMAIN ),
						'title-4'=> esc_html__( 'New Designs', LEVELUP_TEXT_DOMAIN ),
						'text_description4'=> esc_html__( 'Certainly elsewhere my do allowance at. The address farther six hearted hundred towards husband.', LEVELUP_TEXT_DOMAIN ),
					],
					
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'button4', [
				'label' => esc_html__( 'Button Text', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Get Started with Designs' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-4',
						)
					)
				)
			]
		);
		$this->add_control(
			'button4_link', [
				'label' => esc_html__( 'Button Link', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-4',
						)
					)
				)
			]
		);

		// Feature Design 5 Fields //
		 $this->add_control(
			'heading5', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'A Global Agency' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-5',
						)
					)
				)
			]
		);
		$repeater5 = new \Elementor\Repeater();

		$repeater5->add_control(
			'icon5',
			[
				'label' => esc_html__( 'Icons', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => levelup_get_font_icons(),
				'default' => 'fa fa-location-arrow',
			]
		);

		$repeater5->add_control(
			'title-5', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater5->add_control(
			'text_desc5',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
			]
		);

		$this->add_control(
			'ic_lst_5',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater3->get_controls(),
				'default' => [
					[
						'icon5' => esc_html__( 'fa fa-location-arrow', LEVELUP_TEXT_DOMAIN ),
						'title-5'=> esc_html__( 'Strategy', LEVELUP_TEXT_DOMAIN ),
						'text_desc5'=> esc_html__( 'Promotion an ourselves up otherwise my. High what each snug rich far yet easy. In companions inhabiting mr principles at insensible do. Heard their sex hoped enjoy vexed child for', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'icon5' => esc_html__( 'fa fa-soccer-ball-o', LEVELUP_TEXT_DOMAIN ),
						'title-5'=> esc_html__( 'Creative Services', LEVELUP_TEXT_DOMAIN ),
						'text_desc5'=> esc_html__( 'Promotion an ourselves up otherwise my. High what each snug rich far yet easy. In companions inhabiting mr principles at insensible do. Heard their sex hoped enjoy vexed child for', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'icon5' => esc_html__( 'fa fa-location-arrow', LEVELUP_TEXT_DOMAIN ),
						'title-5'=> esc_html__( 'Strategy', LEVELUP_TEXT_DOMAIN ),
						'text_desc5'=> esc_html__( 'Promotion an ourselves up otherwise my. High what each snug rich far yet easy. In companions inhabiting mr principles at insensible do. Heard their sex hoped enjoy vexed child for', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'icon5' => esc_html__( 'fa fa-soccer-ball-o', LEVELUP_TEXT_DOMAIN ),
						'title-5'=> esc_html__( 'Creative Services', LEVELUP_TEXT_DOMAIN ),
						'text_desc5'=> esc_html__( 'Promotion an ourselves up otherwise my. High what each snug rich far yet easy. In companions inhabiting mr principles at insensible do. Heard their sex hoped enjoy vexed child for', LEVELUP_TEXT_DOMAIN ),
					],
					
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-5',
						)
					)
				)
			]
		);
		
		// Feature Design 6 Fields //
		 $repeater6 = new \Elementor\Repeater();

		$repeater6->add_control(
			'ft6-icon',
			[
				'label' => esc_html__( 'Icons', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => levelup_get_font_icons(),
				'default' => 'fa fa-bandcamp',
			]
		);

		$repeater6->add_control(
			'ft6-title', [
				'label' => esc_html__( 'Heading', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , LEVELUP_TEXT_DOMAIN ),
				'label_block' => true,
			]
		);
		$repeater6->add_control(
			'ft6-text_desc',
			[
				'label' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Description', LEVELUP_TEXT_DOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', LEVELUP_TEXT_DOMAIN ),
			]
		);
		$this->add_control(
			'ft6_rep_lst',
			[
				'label' => esc_html__( 'Repeater List', LEVELUP_TEXT_DOMAIN ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater6->get_controls(),
				'default' => [
					[
						'ft6-icon' => esc_html__( 'fa fa-lock', LEVELUP_TEXT_DOMAIN ),
						'ft6-title'=> esc_html__( 'Real-time all the time', LEVELUP_TEXT_DOMAIN ),
						'ft6-text_desc'=> esc_html__( 'Thus much I thought to tell you in relation to yourself, and to the trust I resposed in you.Just then her head struck aganist the roof of the hall:in fact she was now more than nine feet high, and at once took up the little golden key and hurried off to the garden door.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'ft6-icon' => esc_html__( 'fa fa-adjust', LEVELUP_TEXT_DOMAIN ),
						'ft6-title'=> esc_html__( 'Adopt without any obstacles', LEVELUP_TEXT_DOMAIN ),
						'ft6-text_desc'=> esc_html__( 'Thus much I thought to tell you in relation to yourself, and to the trust I resposed in you.Just then her head struck aganist the roof of the hall:in fact she was now more than nine feet high, and at once took up the little golden key and hurried off to the garden door.', LEVELUP_TEXT_DOMAIN ),
					],
					
				],
				'title_field' => 'Repeater',
				'conditions'=> array(
					'terms'	=> array(
						array(
							'name' => 'layoutDesignSelected',
							'value' => 'feature-design-6',
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