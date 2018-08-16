jQuery(document).ready(function($) {
	$( "#ampforwp-elementor-sync" ).click(function() {
		var data = {
				'action': 'elementor_plus_update_design_library'
			};
		
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			$.ajax({
					type: 'post',
					url:  ampforwp_elem_sync_object.ajax_url,
					data: data,
					dataType:'json',
					success: function(response) {

						if( response.status == 200 ){
							alert(response.message);
							//$("#sync-status-notice .ampforwp-response-status").remove();
							$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-yes ampforwp-response-status"></span>' );
						}else{
							alert(response.message);
							//$("#sync-status-notice .ampforwp-response-status").remove();
							$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-no-alt ampforwp-response-status"></span>' );
						}
					}
		}) ;
	}) ;

	$( "#ampforwp-elementor-sync-versions" ).click(function() {
		var data = {
				'action': 'elementor_plus_update_design_version'
			};
		
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			$.ajax({
					type: 'post',
					url:  ampforwp_elem_sync_object.ajax_url,
					data: data,
					dataType:'json',
					success: function(response) {

						if( response.status == 200 ){
							alert(response.message);
							/*$("#sync-status-notice .ampforwp-response-status").remove();
							$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-yes ampforwp-response-status"></span>' );*/
						}else{
							/*$("#sync-status-notice .ampforwp-response-status").remove();
							$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-no-alt ampforwp-response-status"></span>' );*/
						}
					}
			});
		});

});