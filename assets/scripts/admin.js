/* Admin JavaScript */

(function ($) {
	"use strict";
	$(function () {

		var ImageWidget = {
			init: function () {
				this.bindEvents();
				this.placeholder = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAADoUlEQVRo3u1ZTWgTURAOIYRSikjooUgpRXoQEREPHkRERELz/x/yhwnB/CAk9NBDERFKTqWIBykSPIlITyIiIj1J6al4EBFPOXiQ4KEUKUVEpNRvJBvfbt4mb3fzV9iBoZvdefNm3vtm5s2rxWKSSSaZZJIR8vl8m16v98RwIBBwyBzweDzHLpfr2O12/2OjzxKzv/v5jAU/0+GAZMBJYK4D7MqNO6s6IHmI39vgzTHhLT0Qco86sUjk9/sva4bQuDmgGULj5kDfIJTNZq0YfB/y38G/kJPfhUKhhWE40BcIweCacjsx9lssFjs1SAf6AqFqtWrF6wNe8YLC/KB3wDCE8vn8lFphwc6siBgTDoedWh3AsUEMQiIxALlPvB3AJNcFDFmE7BH+3tTqRCaTcWDcNSwUxd9n3VkI23lVghGznfVeBkSj0WkK/FbMfI3H41NanWCpUChYuQ6I1IFIJDILo1ewGmu0qiITQva1Igg3jDjQQYOsxNi1O5y4OeoGO+zYOYzLwdF7tFh4TiHTzXV1wGghg0FOTPakUqm0txdBuwBVh5wj8R/I3+LoiGK3ZHHG2oVv25C5oeqA3qNEMBi8RLHBwiOXy9mgd1flNLnKjqeYgHEvRU6iLUceI7BtMgf0QgirPIfxTUWaewiu8VIuZBuY3C6NTyaTE3i3o7UngBMvisWi1RCEgNXTGPuF15HxftNf4FlW9GDIBq/zwvtXkF0kxnNdRaaqG0KJRMKOce+1NCJQ+zOVSk0y0LtIAc2ThXGPGCeXVPQdQse0ZgiVy2UrNde8otZj298oVr/eRVbmgJocbF/WDCGqAXqaesTFA1aPFDsq8ODugFKeukdNEIIRd5WGijLwfFvSk06nHQqD3+JofkViFMx23sfzDPsN9j5lbN0XhhAM8FMO73at0o2Rw8OMUWcVUHgukjiIIL/KFkUhCJVKJRvsXyYY6GWs3nlJH9LnDAsJrQ4w9h6MrCfGvPvMnHtU+CTGYi0xsE2w3yDbZBqq3ZHdSrCZzEAWqo2sqacDncEs9Bs65jsgNMiLLUBD1tBQxdVbyKBvXcKiUBYRudztxZjrg+LESs1OgyP7A9xo8R5Hzw6OMva2A8O8naYegd0FHAdmYcNHNXlO8dpCRvt/EzLsy106wwC7F1gn0LBMUM9LK99lXBMyZbqfkgXTKP7BgTnXcaayWRQERybxLYhFXaPaAH5GmQbvnDgIdsibZJJJJplkmP4C0NWrxL0MRqkAAAAASUVORK5CYII=';
			},
			// Bind events
			bindEvents : function() {
				$( '#wpbody-content .widget-liquid-right' ).on( 'click', '.image-widget-select, .image-widget-preview', this.uploader );
				$( '#wpbody-content .widget-liquid-right' ).on( 'click', '.image-widget-remove-image', this.removeImage );
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
			// Output image preview and populate widget form.
			update : function( container, attachment ) {
				var title = container.find( '.image-widget-title' ),
					description = container.find( '.image-widget-description' );
				container.find( '.image-widget-preview img' ).attr( 'src', attachment.url );
				container.find( '.image-widget-image' ).val( attachment.id );
				container.find( '.image-widget-remove-image' ).removeClass( 'hidden' );
				if ( title.val() === '' ) title.val( attachment.title );
				if ( description.val() === '' ) description.val( attachment.description );
			},
			// Remove the image
			removeImage : function() {
				var container = $( this ).parents( '.image-widget-container' );
				// Remove preview and value
				$( this ).addClass( 'hidden' );
				container.find( '.image-widget-image' ).val( 0 );
				container.find( '.image-widget-preview img' ).attr( 'src', ImageWidget.placeholder );
			}
		};

		ImageWidget.init();

	});
}(jQuery));