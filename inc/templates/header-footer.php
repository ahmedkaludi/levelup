<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 global $redux_builder_amp; 
 \Elementor\Plugin::$instance->frontend->add_body_class( 'elementor-template-full-width' );?>
<?php amp_header(); ?>
<div class="sp sgl">
<?php
\Elementor\Plugin::$instance->modules_manager->get_modules( 'page-templates' )->print_content();
?>
<?php //} 
do_action("ampforwp_single_design_type_handle");
	?>
</div>
<?php // New single desing Ends?>
	<?php amp_footer()?>