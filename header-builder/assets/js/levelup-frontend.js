jQuery(document).ready(function($){
    $(document).on( 'click',  '.menu-mobile-toggle', function( e ){
        e.preventDefault();
        open_menu_sidebar();
    } );
    $(document).on( 'customize_section_opened', function( e, id ){
        if( id === 'header_sidebar' ) {
            open_menu_sidebar( false );
        }
    } );


    var open_menu_sidebar = function( toggle ){
        $( 'body' ).removeClass( 'hiding-header-menu-sidebar' );
        if ( typeof toggle === "undefined" ) {
            toggle = true;
        }

        if( ! toggle ) {
            $( 'body' ).addClass( 'is-menu-sidebar' );
        } else {
            $( 'body' ).toggleClass( 'is-menu-sidebar' );
        }

        if ( $( 'body' ).hasClass( 'menu_sidebar_dropdown' ) ) {
            if ( toggle ) {
                $( '.menu-mobile-toggle, .menu-mobile-toggle .hamburger' ).toggleClass( 'is-active' );
            } else {
                $( '.menu-mobile-toggle, .menu-mobile-toggle .hamburger' ).addClass( 'is-active' );
            }

            if ( $( 'body' ).hasClass( 'is-menu-sidebar' ) ) {
                var h = $( '#header-menu-sidebar-inner' ).outerHeight();
                $('#header-menu-sidebar').animate({
                    height: h
                }, 300, function () {
                    // Animation complete.
                    $('#header-menu-sidebar').height( 'auto' );
                    //$( '#site-content' ).hide();
                });
            } else {
                if( toggle ) {
                    close_menu_sidebar();
                }
            }
        }
    };

    // close icon
    var close_menu_sidebar = function(){

        $( 'body' ).addClass( 'hiding-header-menu-sidebar' );
        $( 'body' ).removeClass( 'is-menu-sidebar' );
        $('.menu-mobile-toggle, .menu-mobile-toggle .hamburger').removeClass( 'is-active' );

        if ( $( 'body' ).hasClass( 'menu_sidebar_dropdown' ) )
        {
            $( 'body' ).removeClass( 'hiding-header-menu-sidebar' );
            var h = $( '#header-menu-sidebar #header-menu-sidebar-inner' ).outerHeight();
            //$( '#header-menu-sidebar' ).css( 'height', 0 );
            //$( '#site-content' ).show();
            $( '#header-menu-sidebar' ).slideUp(300, function(){
                $( '#header-menu-sidebar' ).css( { height: 0, display: 'block' } );
            });

        } else {
            setTimeout( function () {
                $( 'body' ).removeClass( 'hiding-header-menu-sidebar' );
            }, 1000 );
        }

    };
    
    
})
    