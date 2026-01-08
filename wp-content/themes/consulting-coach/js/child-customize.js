jQuery(document).ready(function($){
	wp.customize.section( 'sidebar-widgets-service' ).priority( '23' );

    $('#sub-accordion-section-header_settings').on( 'click', '.header_layout_text', function(e){
        e.preventDefault();
        wp.customize.control( 'header_layout' ).focus();        
    });

    $('#sub-accordion-section-header_layout_settings').on( 'click', '.header_settings_text', function(e){
        e.preventDefault();
        wp.customize.control( 'ed_header_search' ).focus();        
    });

});