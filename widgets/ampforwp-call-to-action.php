<?php
namespace AmpforwpElementorPlus\Widgets;

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
class Ampforwp_Call_To_Action extends Widget_Base {


	public $design_layout_markup = array();

	public $design_controls = '';

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		$is_type_instance = $this->is_type_instance();

		if ( ! $is_type_instance && null === $args ) {
			throw new \Exception( '`$args` argument is required when initializing a full widget instance' );
		}

		if ( $is_type_instance ) {
			
				
		}
	}
	public  function elementor_plus_amp_design_styling(){
		$design_markup = $this->get_design_layout_markup(); 
		$designStyle = $design_markup['amp']['amp_css'];
		echo $designStyle;
	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'call-to-action';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Call To Action', 'ampforwp-elementor-plus' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
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
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'ampforwp' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'ampforwp-call-to-action' ];
	}

	public function get_design_layout_markup(){
		
		$dir = ELEMENTOR_PLUS_DIR_PATH.'/layouts/design1-layout/';

		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {

		        while (($file = readdir($dh)) !== false) {
		        	
		        	if(is_file($dir.$file) && strpos($file, '-layout.php') == true){
		        		$this->design_layout_markup[str_replace("-layout.php", "", $file)] = include $dir.$file;
		        	}
		        }
		        closedir($dh);
		       	$this->design_layout_markup = apply_filters("ampforwp_pagebuilder_modules_filter", $this->design_layout_markup);
		    }
		}
		return $this->design_layout_markup;
	}
	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$design_controls = $this->get_design_layout_markup();
		$this->start_controls_section(
			'section_designs',
			[
				'label' => __( 'Designs', 'ampforwp-elementor-plus' ),
			]
		);
		

		$this->add_control(
			'designs_layout',
			[
				'label' => __( 'Design Layouts', 'ampforwp-elementor-plus' ),
				'type' => 'designs',
				'default' => '',
			]
		);
		
		$this->end_controls_section();
		
		foreach( $design_controls['settings'] as $valSettings){
			
				switch ($valSettings['type']) {
					case 'section_start':
						if( $valSettings['tab'] == 'content'){
							$valSettings['tab'] = Controls_Manager::TAB_CONTENT;
						}
						if( $valSettings['tab'] == 'style'){
							$valSettings['tab'] = Controls_Manager::TAB_STYLE;
						}
						$this->start_controls_section(
							$valSettings['section_id'],
							[
								'label' => __( $valSettings['label'], 'ampforwp-elementor-plus' ),
								'tab' => $valSettings['tab']
							]
						);
						break;
					case 'section_end':
							$this->end_controls_section();
						break;
					case 'button':
							$valSettings['type'] = \Elementor\Controls_Manager::BUTTON;
							$control_id = $valSettings['id'];
							unset($valSettings['id']);
							$this->add_control(
								$control_id,
								$valSettings
							);
							break;
					case 'select':
							$valSettings['type'] = \Elementor\Controls_Manager::SELECT;
							$control_id = $valSettings['id'];
							unset($valSettings['id']);
							$this->add_control(
								$control_id,
								$valSettings
							);
						break;
					case 'text':
							$valSettings['type'] = \Elementor\Controls_Manager::TEXT;
							$control_id = $valSettings['id'];
							unset($valSettings['id']);
							$this->add_control(
								$control_id,
								$valSettings
							);
							break;
					case 'textarea':
							$valSettings['type'] = \Elementor\Controls_Manager::TEXTAREA;
							$control_id = $valSettings['id'];
							unset($valSettings['id']);
							$this->add_control(
								$control_id,
								$valSettings
							);
							break;
					case 'media':
							$valSettings['type'] = \Elementor\Controls_Manager::MEDIA;
							$valSettings['default'] = [
								'url' => \Elementor\Utils::get_placeholder_image_src(), 
							];
							$control_id = $valSettings['id'];
							unset($valSettings['id']);
							$this->add_control(
								$control_id,
								$valSettings
							);
							break;
					default:
						break;
				}
		}
		
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

		$design_markup = $this->get_design_layout_markup(); 
		$settings = $this->get_settings();
		$this->add_render_attribute(
			'wrapper',
			[
				'id' => 'custom-widget-title',
				'class' => [ 'elementor-inline-editing','title' ],
				'data-elementor-setting-key' => 'title',
			]
		);

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_inline_editing_attributes( 'description', 'basic' );
		$this->add_inline_editing_attributes( 'content', 'basic' );

		$title_attr = $this->get_render_attribute_string( 'wrapper' );
		$description_attr = $this->get_render_attribute_string( 'description' );
		$content_attr = $this->get_render_attribute_string( 'content' );

		
		$description = $settings['description'];
		$content = $settings['content'];
		
		$image_url = $settings['image']['url'];

			if($settings['designs_layout']) {
				 //if($settings['designs_layout'] == 'design1'){ 
					if(ampforwp_is_amp_endpoint()){
						add_action( 'amp_post_template_css', [ $this, 'elementor_plus_amp_design_styling'] );
						$outputHtml = $design_markup['amp']['amp_html'];
					}else{
						$outputStyle = $design_markup['non-amp']['non_amp_css'];
						echo '<style>';
						echo $outputStyle;
						echo '</style>';
						$outputHtml = $design_markup['non-amp']['non_amp_html'];
					}
						
					foreach( $design_markup['settings'] as $key => $val){
						if( isset($val['id']) && isset($settings[$val['id']]) ){
							if( isset($val['type']) && $val['type'] == 'media' ){
							 	$settingsData = $settings[$val['id']]['url'];
							}else{
							 	$settingsData = $settings[$val['id']];
							}
							
							$outputHtml = str_replace('{{'.$val['id'].'}}', $settingsData, $outputHtml);
						}
						
					}
					echo $outputHtml;
				
			}else{ ?>

				<div id="call-to-action-default" class="design-layout-default" role="default" aria-label="default">
					<h1>Default</h1>
					<div class="call-to-action-img-default"><img src="<?php echo $image_url;?>" /></div>
					<h3 <?php echo $this->get_render_attribute_string( 'title' ); ?> >
						<?php echo $settings['title'];?>
					</h3>
					<p <?php echo $this->get_render_attribute_string( 'description' ); ?> >
						<?php echo $settings['description'];?>
					</p>
					<p <?php echo $this->get_render_attribute_string( 'content' ); ?> >
						<?php echo $settings['content'];?>
					</p>
				</div>
			<?php
			}
		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		$design_markup = $this->get_design_layout_markup();
		
		$title_attr = $this->get_render_attribute_string( 'wrapper' );
		$description_attr = $this->get_render_attribute_string( 'description' );
		$content_attr = $this->get_render_attribute_string( 'content' );

		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_inline_editing_attributes( 'description', 'basic' );
		$this->add_inline_editing_attributes( 'content', 'basic' );

		?>
		<#
		if ( settings.designs_layout !== '' ) {
		 	if( settings.designs_layout == 'design1' ){ #>
				<?php
					$design1_markup = str_replace('{{title}}', '{{{ settings.title }}}', $design_markup['non-amp']['non_amp_html']);
					$design1_markup = str_replace('{{image}}', '{{ settings.image.url }}', $design1_markup);
					
					echo $design1_markup;
				?>
			<#
			}

			if( settings.designs_layout == 'design2' ){	#>
				<?php 
					
					$design2_markup = str_replace('{{image}}', '{{ settings.image.url }}', $design2_markup);
					$design2_markup = str_replace('{{description}}', '{{{ settings.description }}}', $design2_markup);
					$design2_markup = str_replace('{{content}}', '{{{ settings.content }}}', $design2_markup);

					echo $design2_markup;
				?>
				<#
			}
		}else{	#>
			<div id="call-to-action-default" class="design-layout-default" role="default" aria-label="default">
				<h1>Default</h1>
				<div class="call-to-action-img-default"><img src="{{ settings.image.url }}"></div>
				<h3 <?php echo $this->get_render_attribute_string( 'title' ); ?>>{{{ settings.title }}}</h3>
				<p <?php echo $this->get_render_attribute_string( 'description' ); ?>>{{{ settings.description }}}</p>
				<p <?php echo $this->get_render_attribute_string( 'content' ); ?>>{{{ settings.content }}}</p>
			</div>
		<#	} #>
		<?php
	}
}
