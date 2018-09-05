<?php
namespace ElementorPlusWidgets;
use ElementorPlusWidgets\Widgets\CategoryWidgets;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Main Plugin Class
 *
 * Register new elementor plus widget.
 *
 */
class ElementorPlusPlugin {
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
		add_action('elementor/elements/categories_registered', array( $this,'add_elementor_widget_categories') );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'on_widgets_registered' ) );


		add_action( "print_media_templates", array( $this, "elementor_plus_new_template_dialog" ) );
		add_action('elementor_plus_modal_style', array($this, 'elementor_plus_before_enqueue_style'));
		add_action( 'elementor/editor/before_enqueue_scripts', array($this, 'elementor_plus_before_enqueue_scripts'));

		add_action( 'elementor/frontend/after_register_scripts',  array($this, 'category_widget_scripts') );

	}
	function category_widget_scripts() {
			wp_register_script( 'elementor-plus-category-widget', plugins_url( '/assets/js/category-widget.js', ELEMENTOR_PLUS__FILE__ ), array( 'jquery' ), false, true );
		} 
	function elementor_plus_before_enqueue_style(){
		echo  include ELEMENTOR_PLUS__FILE__PATH.'/assets/css/elementor-plus-widget-options.php';
	}

	function elementor_plus_before_enqueue_scripts() {
			$settings = get_option('elementor_plus_library_settings');
			$designList = array();
			$designArray = elementorPlusGetDesignListData();
			if( $designArray ){
				$designList = $designArray;
			}

			wp_register_script( 'elementor-plus-widget-options', plugins_url( '/assets/js/elementor-plus-widget-options.js', ELEMENTOR_PLUS__FILE__ ), [ 'jquery' ], false, true );

			wp_localize_script( 'elementor-plus-widget-options', 'elementor_plus_object',
	            array( 'ajax_url' => admin_url( 'admin-ajax.php' ),
	            	'elementor_theme_settings'=>esc_url('admin.php?page=elementor_plus_settings'),
	            	'widget_design'=>array("designs"=> $designList )
	            ) );
			
			wp_enqueue_script( 'elementor-plus-widget-options' );

			

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
	}
	/**
	 * Register Widget
	 *
	 * @access private
	 */
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new CategoryWidgets() );
	}

	public function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'elementor-plus-widgets',
			[
				'title' => esc_html__( 'Elementor Plus', ELEMENTOR_PLUS_ENVIRONEMT ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	public function elementor_plus_new_template_dialog(){
		require_once ELEMENTOR_PLUS__FILE__PATH.'/inc/modal-templates.php';
	}
}
new \ElementorPlusWidgets\ElementorPlusPlugin();