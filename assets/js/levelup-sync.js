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
	$(".levelup-tabs a").click(function(e){
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
		$(".levelup-settings-form").find(".levelup-field-"+currentTab).siblings().hide();
		$(".levelup-settings-form .levelup-field-"+currentTab).show();
		window.history.pushState("", "", href);
		return false;
	});

	
	$( "#levelup-sync-lib" ).click(function() {
		var syncButton = $(this);
		var data = {
				'action': 'levelup_update_design_library'
			};
		
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			$.ajax({
					type: 'post',
					url:  levelup_sync_object.ajax_url,
					data: data,
					dataType:'json',
					beforeSend: function(){
						syncButton.html("Please Wait...");
					},
					success: function(response) {

						if( response.status == 200 ){
							alert(response.message);
							location.reload();
							//$("#sync-status-notice .levelup-response-status").remove();
							//$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-yes levelup-response-status"></span>' );
						}else{
							syncButton.html("sync");
							alert(response.message);
							//$("#sync-status-notice .levelup-response-status").remove();
							$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-no-alt levelup-response-status"></span>' );
						}
					}
		}) ;
	}) ;
	//Only with development version
	$( "#levelup-sync-versions" ).click(function() {
		var syncButton = $(this);
		var data = {
				'action': 'levelup_update_design_version'
			};
		
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			$.ajax({
					type: 'post',
					url:  levelup_sync_object.ajax_url,
					data: data,
					dataType:'json',
					beforeSend: function(){
						syncButton.html("Please Wait...");
					},
					success: function(response) {

						if( response.status == 200 ){
							alert(response.message);
							location.reload();
							/*$("#sync-status-notice .levelup-response-status").remove();
							$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-yes levelup-response-status"></span>' );*/
						}else{
							syncButton.html("Check version");
							location.reload();
							/*$("#sync-status-notice .levelup-response-status").remove();
							$( "#sync-status-notice p" ).append( '<span class="dashicons dashicons-no-alt levelup-response-status"></span>' );*/
						}
					}
			});
		});

	$('.levelup_remove').click(function(){
		var syncButton = $(this);
		var data = {
			'action': 'levelup_remove_key'
		};
		if(confirm("You want to remove the LevelUp Key?")){
			$.ajax({
				type: 'post',
				url:  levelup_sync_object.ajax_url,
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