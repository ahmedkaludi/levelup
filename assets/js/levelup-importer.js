jQuery( function ( $ ) {
	'use strict';

	/**
	 * ---------------------------------------
	 * ------------- Events ------------------
	 * ---------------------------------------
	 */





	 $( '.gl-import-data' ).on( 'click', function () {
		var selectedImportID = $( this ).val();
		var $itemContainer   = $( this ).closest( '.gl-item' );

		// If the import confirmation is enabled, then do that, else import straight away.
		//if ( levelup_import.import_popup ) {
			displayConfirmationPopup( selectedImportID, $itemContainer );
		/*}
		else {
			gridLayoutImport( selectedImportID, $itemContainer );
		}*/
	});







	 function gridLayoutImport( selectedImportID, $itemContainer ) {
		// Reset response div content.
		$( '.ajax-response' ).empty();

		// Hide all other import items.
		$itemContainer.siblings( '.gl-item' ).fadeOut( 500 );

		$itemContainer.animate({
			opacity: 0
		}, 500, 'swing', function () {
			$itemContainer.animate({
				opacity: 1
			}, 500 )
		});

		// Hide the header with category navigation and search box.
		$itemContainer.closest( '.gl' ).find( '.gl-header' ).fadeOut( 500 );

		// Append a title for the selected demo import.
		$itemContainer.parent().prepend( '<h3>' + levelup_import.texts.selected_import_title + '</h3>' );

		// Remove the import button of the selected item.
		$itemContainer.find( '.gl-import-data' ).remove();

		// Prepare data for the AJAX call
		var data = new FormData();
		data.append( 'action', 'ocdi_import_demo_data' );
		data.append( 'security', levelup_import.ajax_nonce );
		data.append( 'selected', selectedImportID );

		// AJAX call to import everything (content, widgets, before/after setup)
		ajaxCall( data );
	}



	function displayConfirmationPopup( selectedImportID, $itemContainer ) {
		var $dialogContiner         = $( '#modal-content' );
		var currentFilePreviewImage = levelup_import.import_files[ selectedImportID ]['import_preview_image_url'] || levelup_import.theme_screenshot;
		var previewImageContent     = '';
		var importNotice            = levelup_import.import_files[ selectedImportID ]['import_notice'] || '';
		var importNoticeContent     = '';
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
							$(this).dialog('close');
							gridLayoutImport( selectedImportID, $itemContainer );
						}
					}
				]
			});

		if ( '' === currentFilePreviewImage ) {
			previewImageContent = '<p>' + levelup_import.texts.missing_preview_image + '</p>';
		}
		else {
			previewImageContent = '<div class="image-container"><img src="' + currentFilePreviewImage + '" alt="' + levelup_import.import_files[ selectedImportID ]['import_file_name'] + '" style="height:180px;"></div>'
		}

		// Prepare notice output.
		if( '' !== importNotice ) {
			importNoticeContent = '<div class="ocdi__modal-notice  ocdi__demo-import-notice">' + importNotice + '</div>';
		}

		// Populate the dialog content.
		$dialogContiner.prop( 'title', levelup_import.texts.dialog_title );
		$dialogContiner.html(
			'<p class="ocdi__modal-item-title">' + levelup_import.import_files[ selectedImportID ]['import_file_name'] + '</p>' +
			previewImageContent +
			importNoticeContent
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
				$( '.ajax-loader' ).show();
			}
		})
		.done( function( response ) {
			if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {
				ajaxCall( data );
			}
			else if ( 'undefined' !== typeof response.status && 'customizerAJAX' === response.status ) {
				// Fix for data.set and data.delete, which they are not supported in some browsers.
				var newData = new FormData();
				newData.append( 'action', 'ocdi_import_customizer_data' );
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
				newData.append( 'action', 'ocdi_after_import_data' );
				newData.append( 'security', levelup_import.ajax_nonce );
				ajaxCall( newData );
			}
			else if ( 'undefined' !== typeof response.message ) {
				$( '.ajax-response' ).append( '<p>' + response.message + '</p>' );
				$( '.ajax-loader' ).hide();

				// Trigger custom event, when OCDI import is complete.
				$( document ).trigger( 'ImportComplete' );
			}
			else {
				$( '.ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>' + response + '</p></div>' );
				$( '.ajax-loader' ).hide();
			}
		})
		.fail( function( error ) {
			$( '.ajax-response' ).append( '<div class="notice  notice-error  is-dismissible"><p>Error: ' + error.statusText + ' (' + error.status + ')' + '</p></div>' );
			$( '.ajax-loader' ).hide();
		});
	}


} );
