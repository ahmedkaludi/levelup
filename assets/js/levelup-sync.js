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

	$(".levelup-send-query").on("click", function(e){
        e.preventDefault();   
        var message = $("#levelup_query_message").val();              
        if($.trim(message) !=''){
         $.ajax({
                        type: "POST",    
                        url:ajaxurl,                    
                        dataType: "json",
                        data:{action:"levelup_send_query_message", 
	                        message:message, 
	                        levelup_security_nonce:levelup_sync_object.securty_nonce},
                        success:function(response){                       
                          if(response['status'] =='t'){
                            $(".levelup-query-success").show();
                            $(".levelup-query-error").hide();
                          }else{
                            $(".levelup-query-success").hide();  
                            $(".levelup-query-error").show();
                          }
                        },
                        error: function(response){                    
                        console.log(response);
                        }
                        });   
        }else{
            alert('Please enter the message');
        }                        

    });


    /***
     * Enable AMP support
     *
     **/
    $('.button-add-support-activate').click(function(e){
        if(pagenow == 'toplevel_page_levelup' && $(this).hasClass('levelup-activation-call-module-upgrade')){// Check for current page
            var self = $(this);
            var nonce = levelup_sync_object.securty_nonce;
            self.addClass('updating-message');
            var currentId = self.attr('id');
            var activate = '';
            if(currentId=='add-amp-support'){
                activate = '&activate=amp';
            }
            self.text( wp.updates.l10n.installing );
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: 'action=levelup_enable_modules_upgread'+activate+'&verify_nonce='+nonce,
                dataType: 'json',
                success: function (response){
                    if(response.status==200){
                    	//To installation
                    	wp.updates.installPlugin(
                        {
	                            slug: response.slug,
	                            success: function(pluginresponse){
	                            	//wp.updates.installPluginSuccess(pluginresponse);
	                                levelupWPActivateModulesUpgrage(pluginresponse.activateUrl, self, response, nonce)
								}
							}
						);
                    }else{
                        alert(response.message)
                    }
                    
                }
            })//ajaxComplete(wpActivateModulesUpgrage(response.path, self, response));
            
        }
    });



    var levelupWPActivateModulesUpgrage = function(url, self, response, nonce){
	    	if (typeof url === 'undefined' || !url) {
	            return;
	        }
	         self.text( 'Activating...' );
	    	 jQuery.ajax(
	            {
	                async: true,
	                type: 'GET',
	                //data: dataString,
	                url: url,
	                success: function () {
	                    self.removeClass('updating-message')
	                    var msgplug = '';
	                    if(self.attr('id')=='add-amp-support'){
	                        msgplug = 'PWA';


							self.html('<a href="'+response.redirect_url+'" style="text-decoration: none;color: #555;">Installed! - Let\'s Go to '+msgplug+' Settings</a>')
							self.removeClass('levelup-activation-call-module-upgrade');
	                    }
	                },
	                error: function (jqXHR, exception) {
	                    var msg = '';
	                    if (jqXHR.status === 0) {
	                        msg = 'Not connect.\n Verify Network.';
	                    } else if (jqXHR.status === 404) {
	                        msg = 'Requested page not found. [404]';
	                    } else if (jqXHR.status === 500) {
	                        msg = 'Internal Server Error [500].';
	                    } else if (exception === 'parsererror') {
	                        msg = 'Requested JSON parse failed.';
	                    } else if (exception === 'timeout') {
	                        msg = 'Time out error.';
	                    } else if (exception === 'abort') {
	                        msg = 'Ajax request aborted.';
	                    } else {
	                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
	                    }
	                    console.log(msg);
	                },
	            }
	        );
	    }

});