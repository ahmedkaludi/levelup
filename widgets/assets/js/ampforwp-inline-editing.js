( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var WidgetAmpforwpInlineEditingHandler = function( $scope, $ ) {
		console.log( $scope );
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ampforwp-inline-editing.default', WidgetAmpforwpInlineEditingHandler );
	} );

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor-templates/models/template', function() {
		console.log(ampGetTemplatesModalOptions());
		elementor.templates.startModal( ampGetTemplatesModalOptions() );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ampforwp-inline-editing.default', WidgetAmpforwpInlineEditingHandler );
		
	} );
	
} )( jQuery );
