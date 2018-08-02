jQuery(document).ready(function($) {
	$( "#ampforwp-sync" ).click(function() {
		var data = {
				'action': 'elementor_plus_get_sync_data'
			};
		
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajax_object.ajax_url, data, function(response) {

				if( response == 200 ){
					$("#sync-status-notice .ampforwp-response-status").remove();
					$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-yes ampforwp-response-status"></span>' );
				}else{
					$("#sync-status-notice .ampforwp-response-status").remove();
					$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-no-alt ampforwp-response-status"></span>' );
				}
			});
		});
	});