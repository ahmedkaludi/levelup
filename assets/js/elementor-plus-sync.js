function elementorGetParamByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
jQuery(document).ready(function($) {
	var href = $(this).attr("href");
	var currentTab = elementorGetParamByName("tab",href);
	if(!currentTab){
		currentTab = "dashboard";
	}
	if(currentTab == "help"){
		$('p.submit').hide();
	}
	$(".elementor-plus-tabs a").click(function(e){
		var href = $(this).attr("href");
		var currentTab = elementorGetParamByName("tab",href);
		if(!currentTab){
			currentTab = "dashboard";
		}
		if(currentTab == "help"){
			$('p.submit').hide();
		}else{
			$('p.submit').show();
		}
		$(this).siblings().removeClass("nav-tab-active");
		$(this).addClass("nav-tab-active");
		$(".elementor-plus-settings-form").find(".elementor-plus-field-"+currentTab).siblings().hide();
		$(".elementor-plus-settings-form .elementor-plus-field-"+currentTab).show();
		window.history.pushState("", "", href);
		return false;
	});

	
	$( "#elementor-plus-sync-lib" ).click(function() {
		var syncButton = $(this);
		var data = {
				'action': 'elementor_plus_update_design_library'
			};
		
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			$.ajax({
					type: 'post',
					url:  elementor_plus_sync_object.ajax_url,
					data: data,
					dataType:'json',
					beforeSend: function(){
						syncButton.html("Please Wait...");
					},
					success: function(response) {

						if( response.status == 200 ){
							alert(response.message);
							location.reload();
							//$("#sync-status-notice .ep-response-status").remove();
							//$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-yes ep-response-status"></span>' );
						}else{
							syncButton.html("sync");
							alert(response.message);
							//$("#sync-status-notice .ep-response-status").remove();
							$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-no-alt ep-response-status"></span>' );
						}
					}
		}) ;
	}) ;
	//Only with development version
	$( "#elementor-plus-sync-versions" ).click(function() {
		var syncButton = $(this);
		var data = {
				'action': 'elementor_plus_update_design_version'
			};
		
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			$.ajax({
					type: 'post',
					url:  elementor_plus_sync_object.ajax_url,
					data: data,
					dataType:'json',
					beforeSend: function(){
						syncButton.html("Please Wait...");
					},
					success: function(response) {

						if( response.status == 200 ){
							alert(response.message);
							location.reload();
							/*$("#sync-status-notice .ep-response-status").remove();
							$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-yes ep-response-status"></span>' );*/
						}else{
							syncButton.html("Check version");
							/*$("#sync-status-notice .ep-response-status").remove();
							$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-no-alt ep-response-status"></span>' );*/
						}
					}
			});
		});

	$('.elementor_plus_remove').click(function(){
		var syncButton = $(this);
		var data = {
			'action': 'elementor_plus_remove_key'
		};
		if(confirm("You want to remove the Elementor Plus Key?")){
			$.ajax({
				type: 'post',
				url:  elementor_plus_sync_object.ajax_url,
				data: data,
				dataType:'json',
				beforeSend: function(){
					syncButton.html("Please Wait...");
				},
				success: function(response) {
					if( response.status == 200 ){
						alert(response.message);
						location.reload();
					}
				}
			});

		}
	})

});