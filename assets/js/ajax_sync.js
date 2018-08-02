jQuery(document).ready(function($) {
			var data = {
					'action': 'elementor_plus_get_sync_data',
					'whatever': 1234
				};
			$( "#ampforwp-sync" ).click(function() {
				

				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(ajax_object.ajax_url, data, function(response) {
					alert('Got this from the server: ' + response);
				});
			});
		});