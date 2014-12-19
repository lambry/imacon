/* Admin JavaScript */

(function ($) {
	"use strict";
	$(function () {

		var ImageWidget = {
			init: function () {
				this.bindEvents();
			},
			// Bind events
			bindEvents : function() {
				$( '#wpbody-content .widget-liquid-right' ).on( 'click', '.image-widget-select, .image-widget-preview', this.uploader );
			},
			// Launch WordPress media manager
			uploader : function( e ) {
				e.preventDefault();
				var container = $( this ).parents( '.image-widget-container' );
				var frame = wp.media({
					library:  { type : 'image' },
					multiple: false
				});
				// Handle results from media manager.
				frame.on( 'select', function() {
					var attachment = frame.state().get( 'selection' ).toJSON();
					if ( $.isEmptyObject( attachment ) ) return;
					ImageWidget.update( container, attachment[0] );
				});
				frame.open();
				return false;
			},
			// Output Image preview and populate widget form.
			update : function( container, attachment ) {
				var title = container.find( '.image-widget-title' ),
					description = container.find( '.image-widget-description' );
				container.find( '.image-widget-preview img' ).attr( 'src', attachment.url );
				container.find( '.image-widget-image' ).val( attachment.id );
				if ( title.val() === '' ) title.val( attachment.title );
				if ( description.val() === '' ) description.val( attachment.description );
			}
		};

		ImageWidget.init();

	});
}(jQuery));