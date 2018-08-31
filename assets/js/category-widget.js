( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var WidgetCategoryHandler = function( $scope, $ ) {
		
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		//elementorFrontend.hooks.addAction( 'frontend/element_ready/category.default', WidgetCategoryHandler );
	} );
} )( jQuery );