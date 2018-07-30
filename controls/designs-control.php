<?php
namespace AmpforwpElementorPlus\Controls;

use Elementor\Controls_Manager;
/**
 * Elementor emoji one area control.
 *
 * A control for displaying a textarea with the ability to add emojis.
 *
 * @since 1.0.0
 */
class Designs_Control extends \Elementor\Base_Data_Control {

	/**
	 * Get emoji one area control type.
	 *
	 * Retrieve the control type, in this case `emojionearea`.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	
	public function get_type() {
		return 'designs';
	}

	public function enqueue() {
		// Styles
		wp_register_style( 'designs-control', plugins_url('/assets/css/designs-control.css',__FILE__), [ ], '1.0.0' );
		wp_enqueue_style( 'designs-control' );

		wp_register_script( 'designs-control', plugins_url('/assets/js/designs-control.js',__FILE__), [ 'jquery' ], '1.0.0' );
		wp_enqueue_script( 'designs-control' );
	}


	public function get_style_value( $css_property, $control_value ) {
		return $control_value;
	}

	protected function get_control_uid( $input_type = 'default' ) {
		return 'elementor-control-' . $input_type . '-{{{ data._cid }}}';
	}

	protected function get_default_settings() {
		
		return [
			'label_block' => true,
			'image_url' => 'http://localhost/wpapi/wp-content/plugins/elementor/assets/images/placeholder.png',
		];
	}

	/**
	 * Render emoji one area control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		
		?>
		<div class="elementor-control-field">
			<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>

			<div class="elementor-control-input-wrapper">
				
				<div class="elementor-control-design-layout-<?php echo $control_uid;?>">
					<input type="radio" name="designs" data-setting="designs_layout" value="design1" id="design1-radio" >
						<label for="male-radio" style="background-image: url('{{{data.image_url}}}}');">
							Design 1
						</label>
				</div>
				<div class="elementor-control-design-layout-<?php echo $control_uid;?>">
				
					<input type="radio" name="designs" data-setting="designs_layout" value="design2" id="design2-radio" >
						<label for="female-radio" style="background-image: url('{{{data.image_url}}}}');">
							Design 2
						</label>
			
				</div>
			</div>
		</div>
		
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}

}