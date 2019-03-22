<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?> 
<table class="form-table">
	<tbody>
		<tr>
			<?php if(!is_plugin_active('accelerated-mobile-pages/accelerated-moblie-pages.php')){ ?>
			<th scope="row">?><?php echo esc_html__('Enable AMP Support',LEVELUP_TEXT_DOMAIN);?></th>
			<td>
				<button type="button" class="button-add-support-activate button levelup-activation-call-module-upgrade" id="add-amp-support"><?php echo esc_html__('Enable',LEVELUP_TEXT_DOMAIN);?></button>
			</td>
		<?php } else{ ?>
			<th scope="row"><?php echo esc_html__('Enabled AMP Support',LEVELUP_TEXT_DOMAIN);?></th>
			<td>
				<a href="<?php echo esc_url( admin_url('admin.php?page=amp_options') ) ?>" class="button-add-amp-support" id=""><?php echo esc_html__('Go to settings',LEVELUP_TEXT_DOMAIN);?></a>
				<p class="alert alert-success"><?php echo esc_html__('AMP compatibility is activated.',LEVELUP_TEXT_DOMAIN);?></p>
			</td>
		<?php } ?>
		</tr>
	</tbody>
</table>