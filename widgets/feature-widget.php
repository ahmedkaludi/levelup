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
		$design_controls['settings'] = array(
			array(
				'label'	=>	esc_html__( 'Feature Content', LEVELUP_TEXT_DOMAIN ),
				'tab' 	=> 	'content'
			)
		);
		
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
					'url' => \Elementor\Utils::get_placeholder_image_src(),
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
						'image4' => esc_html__( '', LEVELUP_TEXT_DOMAIN ),
						'title-4'=> esc_html__( 'Our Services', LEVELUP_TEXT_DOMAIN ),
						'text_description4'=> esc_html__( 'Certainly elsewhere my do allowance at. The address farther six hearted hundred towards husband.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'image4' => esc_html__( '', LEVELUP_TEXT_DOMAIN ),
						'title-4'=> esc_html__( 'Technology', LEVELUP_TEXT_DOMAIN ),
						'text_description4'=> esc_html__( 'Certainly elsewhere my do allowance at. The address farther six hearted hundred towards husband.', LEVELUP_TEXT_DOMAIN ),
					],
					[
						'image4' => esc_html__( '', LEVELUP_TEXT_DOMAIN ),
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