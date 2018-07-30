( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var WidgetAmpforwpCallToActionHandler = function( $scope, $ ) {
		console.log( $scope );
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ampforwp-call-to-action.default', WidgetAmpforwpCallToActionHandler );
	} );

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor-templates/models/template', function() {
		elementor.templates.startModal( ampGetTemplatesModalOptions() );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ampforwp-call-to-action.default', WidgetAmpforwpCallToActionHandler );
		
	} );

	$ ( window ).on (
        'elementor:init',
        function () {
        	require('elementor-templates/models/template');
        	var TemplateLibraryLayoutView = require( 'elementor-templates/views/library-layout' ),
				TemplateLibraryCollection = require( 'elementor-templates/collections/templates' ),
				TemplateLibraryManager;

            elementor.hooks.addAction(
                'panel/open_editor/widget/call-to-action',
                function( panel, model, view ) {
                	
                    jQuery(document).on('click','.elementor-button', function( model ) {
						// if ( ! layout ) {
						// 	initLayout();
						// }

						// layout.showModal();
						 elementor.templates.startModal( { } );
					});
				}
            );
        }
	);
} )( jQuery );