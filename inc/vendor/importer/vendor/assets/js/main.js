jQuery( function ( $ ) {
	'use strict';

	/**
	 * No or Single predefined demo import button click.
	 */
	$( '.js-levelup-import-data' ).on( 'click', function () {

		// Reset response div content.
		$( '.js-levelup-ajax-response' ).empty();

		// Prepare data for the AJAX call
		var data = new FormData();
		data.append( 'action', 'levelup_import_demo_data' );
		data.append( 'security', levelup_import.ajax_nonce );
		data.append( 'selected', $( '#levelup_demo-import-files' ).val() );
		if ( $('#levelup_content-file-upload').length ) {
			data.append( 'content_file', $('#levelup_content-file-upload')[0].files[0] );
		}
		if ( $('#levelup_widget-file-upload').length ) {
			data.append( 'widget_file', $('#levelup_widget-file-upload')[0].files[0] );
		}
		if ( $('#levelup_customizer-file-upload').length ) {
			data.append( 'customizer_file', $('#levelup_customizer-file-upload')[0].files[0] );
		}
		if ( $('#levelup_redux-file-upload').length ) {
			data.append( 'redux_file', $('#levelup_redux-file-upload')[0].files[0] );
			data.append( 'redux_option_name', $('#levelup_redux-option-name').val() );
		}

		// AJAX call to import everything (content, widgets, before/after setup)
		ajaxCall( data );

	});


	/**
	 * Grid Layout import button click.
	 */
	$( '.js-levelup-gl-import-data' ).on( 'click', function () {
		var selectedImportID = $( this ).val();
		var $itemContainer   = $( this ).closest( '.js-levelup-gl-item' );

		// If the import confirmation is enabled, then do that, else import straight away.
		if ( levelup_import.import_popup ) {
			displayConfirmationPopup( selectedImportID, $itemContainer );
		}
		else {
			gridLayoutImport( selectedImportID, $itemContainer );
		}
	});


	/**
	 * Grid Layout categories navigation.
	 */
	(function () {
		// Cache selector to all items
		var $items = $( '.js-levelup-gl-item-container' ).find( '.js-levelup-gl-item' ),
			fadeoutClass = 'ocdi-is-fadeout',
			fadeinClass = 'ocdi-is-fadein',
			animationDuration = 200;

		// Hide all items.
		var fadeOut = function () {
			var dfd = jQuery.Deferred();

			$items
				.addClass( fadeoutClass );

			setTimeout( function() {
				$items
					.removeClass( fadeoutClass )
					.hide();

				dfd.resolve();
			}, animationDuration );

			return dfd.promise();
		};

		var fadeIn = function ( category, dfd ) {
			var filter = category ? '[data-categories*="' + category + '"]' : 'div';

			if ( 'all' === category ) {
				filter = 'div';
			}

			$items
				.filter( filter )
				.show()
				.addClass( 'ocdi-is-fadein' );

			setTimeout( function() {
				$items
					.removeClass( fadeinClass );

				dfd.resolve();
			}, animationDuration );
		};

		var animate = function ( category ) {
			var dfd = jQuery.Deferred();

			var promise = fadeOut();

			promise.done( function () {
				fadeIn( category, dfd );
			} );

			return dfd;
		};

		$( '.js-levelup-nav-link' ).on( 'click', function( event ) {
			event.preventDefault();

			// Remove 'active' class from the previous nav list items.
			$( this ).parent().siblings().removeClass( 'active' );

			// Add the 'active' class to this nav list item.
			$( this ).parent().addClass( 'active' );

			var category = this.hash.slice(1);

			// show/hide the right items, based on category selected
			var $container = $( '.js-levelup-gl-item-container' );
			$container.css( 'min-width', $container.outerHeight() );

			var promise = animate( category );

			promise.done( function () {
				$container.removeAttr( 'style' );
			} );
		} );
	}());


	/**
	 * Grid Layout search functionality.
	 */
	$( '.js-levelup-gl-search' ).on( 'keyup', function( event ) {
		if ( 0 < $(this).val().length ) {
			// Hide all items.
			$( '.js-levelup-gl-item-container' ).find( '.js-levelup-gl-item' ).hide();

			// Show just the ones that have a match on the import name.
			$( '.js-levelup-gl-item-container' ).find( '.js-levelup-gl-item[data-name*="' + $(this).val().toLowerCase() + '"]' ).show();
		}
		else {
			$( '.js-levelup-gl-item-container' ).find( '.js-levelup-gl-item' ).show();
		}
	} );

	/**
	 * ---------------------------------------
	 * --------Helper functions --------------
	 * ---------------------------------------
	 */

	/**
	 * Prepare grid layout import data and execute the AJAX call.
	 *
	 * @param int selectedImportID The selected import ID.
	 * @param obj $itemContainer The jQuery selected item container object.
	 */
	function gridLayoutImport( selectedImportID, $itemContainer ) {
		// Reset response div content.
		$( '.js-levelup-ajax-response' ).empty();

		// Hide all other import items.
		$itemContainer.siblings( '.js-levelup-gl-item' ).fadeOut( 500 );

		$itemContainer.animate({
			opacity: 0
		}, 500, 'swing', function () {
			$itemContainer.animate({
				opacity: 1
			}, 500 )
		});

		// Hide the header with category navigation and search box.
		$itemContainer.closest( '.js-levelup-gl' ).find( '.js-levelup-gl-header' ).fadeOut( 500 );

		// Append a title for the selected demo import.
		$itemContainer.parent().prepend( '<h3>' + levelup_import.texts.selected_import_title + '</h3>' );

		// Remove the import button of the selected item.
		$itemContainer.find( '.js-levelup-gl-import-data' ).remove();

		// Prepare data for the AJAX call
		var data = new FormData();
		data.append( 'action', 'levelup_import_demo_data' );
		data.append( 'security', levelup_import.ajax_nonce );
		data.append( 'selected', selectedImportID );

		//Get checkbox values
		var levelup_import_design = 0, levelup_import_widget = 0, levelup_import_customizer = 0, levelup_import_contents = 0;
		if( $('#levelup_import_design:checked').length){
			levelup_import_design = $('#levelup_import_design:checked').val();
			data.append('levelup_import_design', levelup_import_design);
		}
		if( $('#levelup_import_widget:checked').length ){
			levelup_import_widget = $('#levelup_import_widget:checked').val();
			data.append('levelup_import_widget', levelup_import_widget);
		}
		if( $('#levelup_import_customizer:checked').length ){
			levelup_import_customizer = $('#levelup_import_customizer:checked').val();
			data.append('levelup_import_customizer', levelup_import_customizer);
		}
		if( $('#levelup_import_contents:checked').length ){
			levelup_import_contents = $('#levelup_import_contents:checked').val();
			data.append('levelup_import_contents', levelup_import_contents);
		}
		/*console.log(data);
		return false;*/
		// AJAX call to import everything (content, widgets, before/after setup)
		ajaxCall( data );
	}

	/**
	 * Display the confirmation popup.
	 *
	 * @param int selectedImportID The selected import ID.
	 * @param obj $itemContainer The jQuery selected item container object.
	 */
	function displayConfirmationPopup( selectedImportID, $itemContainer ) {
		var $dialogContiner         = $( '#js-levelup-modal-content' );
		var currentFilePreviewImage = levelup_import.import_files[ selectedImportID ]['import_preview_image_url'] || levelup_import.theme_screenshot;
		var previewImageContent     = '';
		var importNotice            = levelup_import.import_files[ selectedImportID ]['import_notice'] || '';
		var importNoticeContent     = '';
		if(levelupSetupCompleted){
			importNoticeContent = "!!! Setup is not completed please complete setup for better experience for AMP and None-AMP";
		}
		var dialogOptions           = $.extend(
			{
				'dialogClass': 'wp-dialog',
				'resizable':   false,
				'height':      'auto',
				'modal':       true
			},
			levelup_import.dialog_options,
			{
				'buttons':
				[
					{
						text: levelup_import.texts.dialog_no,
						click: function() {
							$(this).dialog('close');
						}
					},
					{
						text: levelup_import.texts.dialog_yes,
						class: 'button  button-primary',
						click: function() {
							if(levelupSetupCompleted==0){
								$(this).dialog('close');
								gridLayoutImport( selectedImportID, $itemContainer );
							}else{
								alert("Before Import template, Please \"Complete the setup process\".");
							}

						}
					}
				]
			});

		if ( '' === currentFilePreviewImage ) {
			previewImageContent = '<p>' + levelup_import.texts.missing_preview_image + '</p>';
		}
		else {
			previewImageContent = '<div class="levelup_modal-image-container"><img src="' + currentFilePreviewImage + '" alt="' + levelup_import.import_files[ selectedImportID ]['import_file_name'] + '"></div>'
		}
		previewImageContent = '<div class="levelup_modal-image-container">'+
							'<div><label><input type="checkbox" name="import_design" checked id="levelup_import_design" value="1"> Design</label></div>'+
							(levelup_import.import_files[selectedImportID].import_widget_file_url!=''? '<div><label><input type="checkbox" name="import_widget" checked id="levelup_import_widget" value="1"> Widgets</label></div>' : '')+
							(levelup_import.import_files[selectedImportID].import_customizer_file_url!=''? '<div><label><input type="checkbox" name="import_customizer" checked id="levelup_import_customizer" value="1"> Customizer Settings</label></div>' : '')+
							(levelup_import.import_files[selectedImportID].import_dummy_content!=''?'<div><label><input type="checkbox" name="import_contents" id="levelup_import_contents" value="1"> Dummy Contents</label></div>' : '')
							+'</div>';

		// Prepare notice output.
		if( '' !== importNotice ) {
			importNoticeContent = '<div class="levelup_modal-notice  levelup_demo-import-notice">' + importNotice + '</div>';
		}

		// Populate the dialog content.
		$dialogContiner.prop( 'title', levelup_import.texts.dialog_title );
		$dialogContiner.html(
			'<p class="levelup_modal-item-title">' + levelup_import.import_files[ selectedImportID ]['import_file_name'] + '</p>' +previewImageContent +"<div class='notices'>"+importNoticeContent+"</div>"
		);

		// Display the confirmation popup.
		$dialogContiner.dialog( dialogOptions );
	}

	/**
	 * The main AJAX call, which executes the import process.
	 *
	 * @param FormData data The data to be passed to the AJAX call.
	 */
	function ajaxCall( data ) {
		$.ajax({
			method:      'POST',
			url:         levelup_import.ajax_url,
			data:        data,
			contentType: false,
			processData: false,
			beforeSend:  function() {
				$( '.js-levelup-ajax-loader' ).show();
			}
		})
		.done( function( response ) {
			if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {
				ajaxCall( data );
			}
			else if ( 'undefined' !== typeof response.status && 'customizerAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'levelup_import_customizer_data' );
				newData.append( 'security', levelup_import.ajax_nonce );

				// Set the wp_customize=on only if the plugin filter is set to true.
				if ( true === levelup_import.wp_customize_on ) {
					newData.append( 'wp_customize', 'on' );
				}

				ajaxCall( newData );
			}
			else if ( 'undefined' !== typeof response.status && 'afterAllImportAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'levelup_after_import_data' );
				newData.append( 'security', levelup_import.ajax_nonce );
				ajaxCall( newData );
			}
			else if ( 'undefined' !== typeof response.message ) {
				$( '.js-levelup-ajax-response' ).append( '<p>' + response.message + '</p>' );
				$( '.js-levelup-ajax-loader' ).hide();

				// Trigger custom event, when OCDI import is complete.
				$( document ).trigger( 'ocdiImportComplete' );
			}
			else {
				$( '.js-levelup-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>' + response + '</p></div>' );
				$( '.js-levelup-ajax-loader' ).hide();
			}
		})
		.fail( function( error ) {
			$( '.js-levelup-ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>Error: ' + error.statusText + ' (' + error.status + ')' + '</p></div>' );
			$( '.js-levelup-ajax-loader' ).hide();
		});
	}
} );
