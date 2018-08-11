<?php
/**
 * Plugin Name: Ampforwp Elementor Plus
 * Description: Elementor sample plugin.
 * Plugin URI:  https://elementor.com/
 * Version:     1.1.0
 * Author:      Author Name
 * Author URI:  https://elementor.com/
 * Text Domain: ampforwp-elementor-plus
 */
 
namespace AmpforwpElementorPlus;

use AmpforwpElementorPlus\Widgets\Ampforwp_Call_To_Action;
use AmpforwpElementorPlus\Widgets\Ampforwp_Inline_Editing;

//use AmpforwpElementorPlus\Controls\EmojiOneArea_Control;
use AmpforwpElementorPlus\Controls\Designs_Control;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'ELEMENTOR_PLUS_DIR_PATH', plugin_dir_path(__FILE__) );
define( 'ELEMENTOR_ELEMENTOR_PLUS__FILE__', __FILE__ );

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
final class Ampforwp_Elementor_Plus {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
		
		register_activation_hook( __FILE__, [ $this, 'ampforwp_elementor_plus_activate' ] );

		add_action( 'admin_notices', [ $this, 'ampforwp_elementor_plus_admin_notice' ] );
		add_action( "print_media_templates", [ $this, "ampforwp_new_template_dialog" ] );

		add_action( 'wp_ajax_elementor_plus_get_sync_data', [ $this, 'elementor_plus_get_sync_data'] );
		add_action( 'wp_ajax_elementor_plus_update_design_library', [ $this, 'elementor_plus_update_design_library'] );
		add_action( 'admin_enqueue_scripts', [ $this,'ampforwp_wpajax_js']);

		add_action( 'plugins_loaded', [ $this, 'register_custom_post_type_elementor_plus' ] );

	}
	public function  register_custom_post_type_elementor_plus(){
		if ( post_type_exists( 'design_library' ) ) {
   			// echo "hello";
   			// die;
		}else{
			// echo "bye";
   			//die;
			/*Create custom post type design library for elementor plus*/
			add_action( 'init', [ $this, 'elementor_plus_custom_post_type'], 0 );
			add_action( 'init', [ $this, 'create_elementor_plus_hierarchical_taxonomy'], 0 );
			add_action('add_meta_boxes', [ $this, 'elementor_plus_add_custom_box']);
			add_action('save_post', ['AmpforwpElementorPlus\Ampforwp_Elementor_Plus', 'elementor_plus_save_data']);
		}
	}

	public function ampforwp_wpajax_js($hook) {
		wp_enqueue_script( 'elementor-ajax-script', plugins_url( '/assets/js/ajax_sync.js', __FILE__ ), array('jquery') );

		// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
		wp_localize_script( 'elementor-ajax-script', 'ajax_object',
	            array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'we_value' => 1234 ) );
	}

	public function elementor_plus_get_sync_data(){
		$response = wp_remote_get( 'http://localhost/elementor-layouts/list.php',array('timeout'=> 120));
		$elementor_plus_json_option = 'ampforwp-call-to-action-layouts';
		$status = '';
		$responseData = '';
		if ( is_array( $response ) && ! is_wp_error( $response ) ) {
			$responseData = $response['body'];
			$responseData = json_decode($responseData);
			if( is_array($responseData)){
				$responseData = json_encode($responseData);
				update_option( $elementor_plus_json_option, $responseData );
				$status = 200;
			}else{
				$status = 400;
			}
		}else{
			$status = 400;
		}
		echo $status;
		wp_die();
	}

	public function elementor_plus_update_design_library(){
		$response = wp_remote_get( 'http://localhost/elementor-layouts/',array('timeout'=> 120));
		//$elementor_plus_json_option = 'ampforwp-call-to-action-layouts';
		$status = '';
		$responseData = '';
		$metaData = '';
		//print_r($response);
		// if ( is_array( $response ) && ! is_wp_error( $response ) ) {
		//  	$responseData = $response['body'];
		//  	$responseData = json_decode($responseData);
		//  	if( is_array($responseData)){
		// 		$responseData = json_encode($responseData);
		//  		//update_option( $elementor_plus_json_option, $responseData );
		//  		$status = 200;
		//  	}
		// }else{
		//  	$status = 400;
		// }
		//echo $responseData;
		$responseData = json_decode($response['body']);
		foreach( $responseData as $key => $valCat ){
			$widgetType = $key;
			foreach( $valCat as $key => $valDesigntype ){
				$designType = $key;
				$post_id = wp_insert_post(array('post_title'=> $widgetType.' '.$designType, 'post_type'=>'design_library', 'post_content'=>'Desgin Layouts with markup and css'));
				wp_set_object_terms( $post_id, $widgetType, 'widget_type' );
				$metaData = array();
				// Check folder permission and define file location
				foreach( $valDesigntype as $key => $valMarkups ){
						$metaData[] = json_encode($valMarkups);
					if( $key == 'image'){
						update_post_meta( $post_id, '_design_image_url', $valMarkups );
					}
					update_post_meta( $post_id, '_amp_html_markup', $metaData[0] );
					update_post_meta( $post_id, '_non_amp_html_markup', $metaData[1] );
					update_post_meta( $post_id, '_design_markup_options', $metaData[2] );
				}
			}
		}
		echo '200';

		wp_die();
	}

	public function ampforwp_elementor_plus_activate() {
		
		/* Create transient data */
		$responseData = '';
		$response_version = wp_remote_get('http://localhost/elementor-layouts/version.php',array('timeout'=> 120));
		$elementor_plus_version_option = 'ampforwp-elementor-plus-version';
		
		if ( is_array( $response_version ) && ! is_wp_error( $response_version ) ) {
			$version = $response_version['body'];
			update_option( $elementor_plus_version_option, $version );
		}

		add_action( 'admin_notices', [ $this, 'ampforwp_elementor_plus_admin_notice' ] );
	}
	
	public function elementor_plus_add_custom_box()
	{
	    $screens = ['design_library'];
	    foreach ($screens as $screen) {
	        add_meta_box(
	            'amp_html_markup',           // Unique ID
	            'Amp Html Markup',  // Box title
	            [self::class,'amp_markup_box_html'],  // Content callback, must be of type callable
	            $screen                   // Post type
	        );

	        add_meta_box(
	            'non_amp_html_markup',           // Unique ID
	            'Non Amp Html Markup',  // Box title
	            [self::class,'non_amp_markup_box_html'],  // Content callback, must be of type callable
	            $screen                   // Post type
	        );

	        add_meta_box(
	            'design_options',           // Unique ID
	            'Design Layout Options',  // Box title
	            [self::class,'elementor_plus_design_options_callback'],  // Content callback, must be of type callable
	            $screen                   // Post type
	        );

	        add_meta_box(
	            'design_image',           // Unique ID
	            'Design Image Url',  // Box title
	            [self::class,'elementor_plus_design_image_callback'],  // Content callback, must be of type callable
	            $screen                   // Post type
	        );

	    }
	}
	
	public static function elementor_plus_save_data($post_id){
		if (array_key_exists('amp_html_markup', $_POST)) {
            update_post_meta(  $post_id, '_amp_html_markup', $_POST['amp_html_markup'] );
        }

        if (array_key_exists('non_amp_html_markup', $_POST)) {
            update_post_meta( $post_id, '_non_amp_html_markup', $_POST['non_amp_html_markup'] );
        }

        if (array_key_exists('design_markup_options', $_POST)) {
            update_post_meta( $post_id, '_design_markup_options', $_POST['design_markup_options'] );
        }

        if (array_key_exists('design_markup_options', $_POST)) {
            update_post_meta( $post_id, '_design_image_url', $_POST['design_image_url'] );
        }
	}

	public static function amp_markup_box_html($post){
		$amp_html_markup = get_post_meta($post->ID, '_amp_html_markup', true);
        ?>
        <!--<label for="wporg_field">Amp Html Markup </label>-->
        <textarea  rows="10" cols="130" name="amp_html_markup" ><?php echo $amp_html_markup; ?></textarea>
        <?php
	}

	public static function non_amp_markup_box_html($post){
		$non_amp_html_markup = get_post_meta($post->ID, '_non_amp_html_markup', true);
        ?>
        <!--<label for="wporg_field">Non Amp Html Markup</label>-->
        <textarea rows="10" cols="130" name="non_amp_html_markup" ><?php echo $non_amp_html_markup; ?></textarea>
        <?php
	}
	
	public static function elementor_plus_design_options_callback($post){
		$design_markup_options = get_post_meta($post->ID, '_design_markup_options', true);
        ?>
        <!--<label for="wporg_field">Design Layout Options</label>-->
        <textarea rows="10" cols="130" name="design_markup_options" ><?php echo $design_markup_options; ?></textarea>
        <?php
	}

	public static function elementor_plus_design_image_callback($post){
		$design_image_url = get_post_meta($post->ID, '_design_image_url', true);
        ?>
        <!--<label for="wporg_field">Design Layout Options</label>-->
        <textarea rows="10" cols="130" name="design_image_url" ><?php echo $design_image_url; ?></textarea>
        <?php
	}
	public  function  create_elementor_plus_hierarchical_taxonomy(){

		$labels = array(
				    'name' => _x( 'Widget Types', 'taxonomy general name' ),
				    'singular_name' => _x( 'Widget Type', 'taxonomy singular name' ),
				    'search_items' =>  __( 'Search Widget' ),
				    'all_items' => __( 'All Widgets' ),
				    'parent_item' => __( 'Parent Widget' ),
				    'parent_item_colon' => __( 'Parent Widget:' ),
				    'edit_item' => __( 'Edit Widget' ), 
				    'update_item' => __( 'Update Widget' ),
				    'add_new_item' => __( 'Add New Widget' ),
				    'new_item_name' => __( 'New Widget Name' ),
				    'menu_name' => __( 'Widget Types' ),
				);    
 
		// Now register the taxonomy
		register_taxonomy('widget_type',array('design_library'), array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'widget_type' ),
				//REST API suport for Custom taxonomy
				'show_in_rest'       => true,
		  		'rest_base'          => 'widget_type',
		  		'rest_controller_class' => 'WP_REST_Terms_Controller',
			));

	}

	public function elementor_plus_custom_post_type(){

	        $labels = array(
		        'name'                => _x( 'Design Library', 'Post Type General Name', 'twentythirteen' ),
		        'singular_name'       => _x( 'Design Library', 'Post Type Singular Name', 'twentythirteen' ),
		        'menu_name'           => __( 'Design Library', 'twentythirteen' ),
		        'parent_item_colon'   => __( 'Parent Design Library', 'twentythirteen' ),
		        'all_items'           => __( 'All Design Library', 'twentythirteen' ),
		        'view_item'           => __( 'View Design Library', 'twentythirteen' ),
		        'add_new_item'        => __( 'Add New Design', 'twentythirteen' ),
		        'add_new'             => __( 'Add New', 'twentythirteen' ),
		        'edit_item'           => __( 'Edit Design Library', 'twentythirteen' ),
		        'update_item'         => __( 'Update Design Library', 'twentythirteen' ),
		        'search_items'        => __( 'Search Design Library', 'twentythirteen' ),
		        'not_found'           => __( 'Not Found', 'twentythirteen' ),
		        'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' )
		    );

		    $args = array(
		        'label'               => __( 'Elementor Plus Designs', 'twentythirteen' ),
		        'description'         => __( 'Elementor Plus Designs and Layouts Library', 'twentythirteen' ),
		        'labels'              => $labels,
		        // Features this CPT supports in Post Editor
		        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		        // You can associate this CPT with a taxonomy or custom taxonomy. 
		        'taxonomies'          => array( 'widget_type' ),
		        /* A hierarchical CPT is like Pages and can have
		        * Parent and child items. A non-hierarchical CPT
		        * is like Posts.
		        */ 
		        'hierarchical'        => true,
		        'public'              => true,
		        'show_ui'             => true,
		        'show_in_menu'        => true,
		        'show_in_nav_menus'   => true,
		        'show_in_admin_bar'   => true,
		        'menu_position'       => 5,
		        'can_export'          => true,
		        'has_archive'         => true,
		        'exclude_from_search' => false,
		        'publicly_queryable'  => true,
		        'capability_type'     => 'page',
		        //Rest API Support for custom post type
		        'show_in_rest'       => true,
		  		'rest_base'          => 'design_library-api',
		  		'rest_controller_class' => 'WP_REST_Posts_Controller',
	    	);
	    register_post_type( 'design_library', $args );
	}

	public function ampforwp_new_template_dialog(){
		require_once 'modal-templates.php';
	}

	public function ampforwp_elementor_plus_admin_notice(){
	    global $pagenow;
	    $current_version = get_option( 'ampforwp-elementor-plus-version');
	    if ( $pagenow == 'plugins.php' ){  
	    	if( $current_version < 2.0 ){

	    	?>
	    <div class="notice notice-info is-dismissible" id="sync-status-notice" >
	        <p>Click on <button type="button" value="sync" name="sync" id="ampforwp-sync" class="button-primary">Sync</button> to update Elementor Plus design library.<span class="ampforwp-response-status"><img src="<?php echo admin_url('images/loading.gif');?>" class="jetpack-lazy-image ampforwp-lazy-image" data-lazy-loaded="1"></span></p>
	    </div>
	    <?php
			}	
		}
	
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'ampforwp-elementor-plus' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action('elementor/elements/categories_registered', [ $this,'ampforwp_add_elementor_widget_categories'] );

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'on_controls_registered' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'elementor_widget_enque_script'] );
	}


	public function ampforwp_add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'ampforwp',
			[
				'title' => __( 'Ampforwp Elementor Plus', 'ampforwp-elementor-plus' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	public function elementor_widget_enque_script(){
		$designs = get_option( 'ampforwp-call-to-action-layouts');
		$designs = json_decode( $designs );
		wp_register_script( 'ampforwp-pop-lib', plugins_url( 'assets/js/modal.popup.lib.js', ELEMENTOR_ELEMENTOR_PLUS__FILE__ ), [ 'jquery', 'backbone', 'backbone-marionette','backbone-radio' ], false, true );
		wp_register_script( 'ampforwp-call-to-action', plugins_url( 'widgets/assets/js/ampforwp-call-to-action.js', ELEMENTOR_ELEMENTOR_PLUS__FILE__ ), [ 'jquery', 'backbone', 'backbone-marionette','backbone-radio' ], false, true );
		wp_localize_script( 'ampforwp-call-to-action', 'ajax_object',
	            array( 'ajax_url' => admin_url( 'admin-ajax.php' ),
	            	'widget_design'=>array("designs"=> $designs ),
	            	'we_value' => 1234 ) );
		///wp_enqueue_script( 'ampforwp-pop-lib' );
		wp_enqueue_script( 'ampforwp-call-to-action' );
	}
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'ampforwp-elementor-plus' ),
			'<strong>' . esc_html__( 'Ampforwp Elementor Plus', 'ampforwp-elementor-plus' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ampforwp-elementor-plus' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ampforwp-elementor-plus' ),
			'<strong>' . esc_html__( 'Ampforwp Elementor Plus', 'ampforwp-elementor-plus' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ampforwp-elementor-plus' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ampforwp-elementor-plus' ),
			'<strong>' . esc_html__( 'Ampforwp Elementor Plus', 'ampforwp-elementor-plus' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'ampforwp-elementor-plus' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

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
		//require_once( __DIR__ . '/controls/emojionearea-control.php' );
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
		//$controls_manager->register_control( 'emojionearea', new EmojiOneArea_Control() );
	}
	
	private function register_widget() {
		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
		$widgets_manager->register_widget_type( new Ampforwp_Call_To_Action() );
		$widgets_manager->register_widget_type( new Ampforwp_Inline_Editing() );
	}
}

require_once 'ampforwp-elementor-ajax.php';
$ampAjaxObj = new AmpforwpElementorPlusAjax();
$ampAjaxObj->init();

Ampforwp_Elementor_Plus::instance();