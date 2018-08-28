<?php
namespace AMPforWpElementorWidgets;
use AMPforWpElementorWidgets\Widgets\AMPforWpWidgets;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 */
class Plugin {
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
		add_action('elementor/elements/categories_registered', [ $this,'ampforwp_add_elementor_widget_categories'] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );

		add_action( 'elementor/frontend/after_register_scripts', function() {
			wp_register_script( 'amp-widget', plugins_url( '/assets/js/amp-widget.js', ELEMENTOR_AMPFORWP__FILE__ ), [ 'jquery' ], false, true );
		} );

		add_action( "print_media_templates", [ $this, "ampforwp_new_template_dialog" ] );

		add_action( 'elementor/editor/before_enqueue_scripts', function() {
			$settings = get_option('ampforwp_elementor_theme_settings');
			$designList = array();
			if( isset($settings['api_key']) && !empty($settings['api_key']) && isset($settings['api_status']) && $settings['api_status']=='valid' ){
				$designList = getDesignListData();
			}

			wp_register_script( 'ampforwp-widget-options', plugins_url( '/assets/js/ampforwp-widget-options.js', ELEMENTOR_AMPFORWP__FILE__ ), [ 'jquery' ], false, true );

			wp_localize_script( 'ampforwp-widget-options', 'ampforwp_elem_object',
	            array( 'ajax_url' => admin_url( 'admin-ajax.php' ),
	            	'elementor_theme_settings'=>esc_url('admin.php?page=ampforwp_elementor_themes_settings'),
	            	'widget_design'=>array("designs"=> $designList )
	            ) );
			
			wp_enqueue_script( 'ampforwp-widget-options' );

		} );

		add_action('elementor/editor/before_enqueue_styles', function(){
			wp_register_style( 'ampforwp-widget-options-css', plugins_url( '/assets/css/ampforwp-widget-options.css', ELEMENTOR_AMPFORWP__FILE__ ), array(), false, true );
			wp_enqueue_style( 'ampforwp-widget-options-css' );
		});

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
		require __DIR__ . '/inc/functional.php';
		require __DIR__ . '/widgets/amp-widget.php';
	}
	/**
	 * Register Widget
	 *
	 * @access private
	 */
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new AMPforWpWidgets() );
	}

	public function ampforwp_add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'ampforwp-widgets',
			[
				'title' => __( 'Elementor Plus', 'ampforwp-elementor-plus' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	public function ampforwp_new_template_dialog(){
		require_once ELEMENTOR_AMPFORWP__FILE__PATH.'/inc/modal-templates.php';
	}
}
new Plugin();