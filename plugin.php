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
			$designList = getDesignListData();
			wp_register_script( 'ampforwp-widget-options', plugins_url( '/assets/js/ampforwp-widget-options.js', ELEMENTOR_AMPFORWP__FILE__ ), [ 'jquery' ], false, true );

			wp_localize_script( 'ampforwp-widget-options', 'ampforwp_elem_object',
	            array( 'ajax_url' => admin_url( 'admin-ajax.php' ),
	            	'widget_design'=>array("designs"=> $designList )
	            ) );
			
			wp_enqueue_script( 'ampforwp-widget-options' );

		} );

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
				'title' => __( 'Ampforwp Elementor Plus', 'ampforwp-elementor-plus' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	public function ampforwp_new_template_dialog(){
		require_once ELEMENTOR_AMPFORWP__FILE__PATH.'/inc/modal-templates.php';
	}
}
new Plugin();