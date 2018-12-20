<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?> 
<table class="form-table">
	<tbody>
		<tr>
			<?php if(!is_plugin_active('accelerated-mobile-pages/accelerated-moblie-pages.php')){ ?>
			<th scope="row">Enable AMP Support</th>
			<td>
				<button type="button" class="button-add-support-activate button levelup-activation-call-module-upgrade" id="add-amp-support">Enable</button>
			</td>
		<?php } else{ ?>
			<th scope="row">Enabled AMP Support</th>
			<td>
				<a href="<?php echo esc_url( admin_url('admin.php?page=amp_options') ) ?>" class="button-add-amp-support" id="">Go to settings</a>
				<p class="alert alert-success">AMP compatibility is activated.</p>
			</td>
		<?php } ?>
		</tr>
	</tbody>
</table>