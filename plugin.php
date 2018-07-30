<?php
namespace AmpforwpElementorPlus;

use AmpforwpElementorPlus\Widgets\Ampforwp_Call_To_Action;
use AmpforwpElementorPlus\Widgets\Ampforwp_Inline_Editing;

use AmpforwpElementorPlus\Controls\EmojiOneArea_Control;
use AmpforwpElementorPlus\Controls\Designs_Control;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
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
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'on_controls_registered' ] );
		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);
		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
	}

	public function widget_styles() {

		wp_register_style( 'ampforwp-call-to-action', plugins_url( 'widgets/assets/css/ampforwp-call-to-action.css', __FILE__ ) );
		wp_enqueue_style( 'ampforwp-call-to-action' );

		wp_register_style( 'ampforwp-inline-editing', plugins_url( 'widgets/assets/css/ampforwp-inline-editing.css', __FILE__ ) );
		wp_enqueue_style( 'ampforwp-inline-editing' );
	}

	public function widget_scripts(){
		
		//wp_register_script( 'some-library', plugins_url( 'js/libs/some-library.js', __FILE__ ) );
		// wp_register_script( 'ampforwp-call-to-action', plugins_url( 'widgets/assets/js/ampforwp-call-to-action.js', ELEMENTOR_AMPFORWP_ELEMENTOR_PLUS__FILE__ ), [ 'jquery' ], false, true );
		// wp_enqueue_script( 'ampforwp-call-to-action' );
		
		wp_register_script( 'ampforwp-inline-editing', plugins_url( 'widgets/assets/js/ampforwp-inline-editing.js', ELEMENTOR_AMPFORWP_ELEMENTOR_PLUS__FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_script( 'ampforwp-inline-editing' );
	}
	
	/**
	 * On Controls Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_controls_registered() {
		$this->controls_includes();
		$this->register_controls();
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
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
	private function controls_includes(){
		require_once( __DIR__ . '/controls/emojionearea-control.php' );
		require_once( __DIR__ . '/controls/designs-control.php' );
	}
	 
	private function includes() {
		require __DIR__ . '/widgets/ampforwp-call-to-action.php';
		require __DIR__ . '/widgets/ampforwp-inline-editing.php';
		
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	 
	private function register_controls(){
		$controls_manager = \Elementor\Plugin::$instance->controls_manager;
		$controls_manager->register_control( 'designs', new Designs_Control() );
	}
	
	private function register_widget() {
		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
		$widgets_manager->register_widget_type( new Ampforwp_Call_To_Action() );
		$widgets_manager->register_widget_type( new Ampforwp_Inline_Editing() );
	}
}

new Plugin();
