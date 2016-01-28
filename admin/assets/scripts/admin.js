/**
 * Admin widget functions.
 */

(function( $ ) {

	Imacon = {
		/*** Get things started ***/
		init: function () {
			this.events();
			this.placeholder = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAADoUlEQVRo3u1ZTWgTURAOIYRSikjooUgpRXoQEREPHkRERELz/x/yhwnB/CAk9NBDERFKTqWIBykSPIlITyIiIj1J6al4EBFPOXiQ4KEUKUVEpNRvJBvfbt4mb3fzV9iBoZvdefNm3vtm5s2rxWKSSSaZZJIR8vl8m16v98RwIBBwyBzweDzHLpfr2O12/2OjzxKzv/v5jAU/0+GAZMBJYK4D7MqNO6s6IHmI39vgzTHhLT0Qco86sUjk9/sva4bQuDmgGULj5kDfIJTNZq0YfB/y38G/kJPfhUKhhWE40BcIweCacjsx9lssFjs1SAf6AqFqtWrF6wNe8YLC/KB3wDCE8vn8lFphwc6siBgTDoedWh3AsUEMQiIxALlPvB3AJNcFDFmE7BH+3tTqRCaTcWDcNSwUxd9n3VkI23lVghGznfVeBkSj0WkK/FbMfI3H41NanWCpUChYuQ6I1IFIJDILo1ewGmu0qiITQva1Igg3jDjQQYOsxNi1O5y4OeoGO+zYOYzLwdF7tFh4TiHTzXV1wGghg0FOTPakUqm0txdBuwBVh5wj8R/I3+LoiGK3ZHHG2oVv25C5oeqA3qNEMBi8RLHBwiOXy9mgd1flNLnKjqeYgHEvRU6iLUceI7BtMgf0QgirPIfxTUWaewiu8VIuZBuY3C6NTyaTE3i3o7UngBMvisWi1RCEgNXTGPuF15HxftNf4FlW9GDIBq/zwvtXkF0kxnNdRaaqG0KJRMKOce+1NCJQ+zOVSk0y0LtIAc2ThXGPGCeXVPQdQse0ZgiVy2UrNde8otZj298oVr/eRVbmgJocbF/WDCGqAXqaesTFA1aPFDsq8ODugFKeukdNEIIRd5WGijLwfFvSk06nHQqD3+JofkViFMx23sfzDPsN9j5lbN0XhhAM8FMO73at0o2Rw8OMUWcVUHgukjiIIL/KFkUhCJVKJRvsXyYY6GWs3nlJH9LnDAsJrQ4w9h6MrCfGvPvMnHtU+CTGYi0xsE2w3yDbZBqq3ZHdSrCZzEAWqo2sqacDncEs9Bs65jsgNMiLLUBD1tBQxdVbyKBvXcKiUBYRudztxZjrg+LESs1OgyP7A9xo8R5Hzw6OMva2A8O8naYegd0FHAdmYcNHNXlO8dpCRvt/EzLsy106wwC7F1gn0LBMUM9LK99lXBMyZbqfkgXTKP7BgTnXcaayWRQERybxLYhFXaPaAH5GmQbvnDgIdsibZJJJJplkmP4C0NWrxL0MRqkAAAAASUVORK5CYII=';
		},
		/*** Cache the events ***/
		events: function() {
			$( 'body' ).on( 'click', '.imacon-preview', this.selectImage );
			$( 'body' ).on( 'click', '.imacon-remove-image', this.removeImage );
			$( document ).on( 'ready widget-added widget-updated', function(e) {
				Imacon.initSelect( $( '#widgets-right .imacon-select' ) );
				Imacon.initSort( $( '#widgets-right .imacon-sortable' ) );
			} );
		},
		/*** Initilize select2 ***/
		initSelect: function( el ) {
			el.select2( {
				width: '100%',
				templateResult: function( option ) {
					if ( $( option.element ).parent().hasClass( 'imacon-icon' ) ) {
		    			return $( '<span><i class="fa fa-' + option.id + '"></i> ' + option.text + '</span>' );
					} else {
						return option.text;
					}
				}
			} );
		},
		/*** Initilize sortable ***/
		initSort: function( el ) {
			el.sortable( {
				placeholder : 'imacon-sort-gap',
				stop: function( event, ui ) {
					var sort = '',
						container = $( ui.item ).parents( '.imacon' );
					// Update the hidden sort field
					container.find( '.imacon-sortable .imacon-field' ).each( function(index, val) {
						sort += $(this).data( 'id' ) + ',';
					} );
					container.find( '.imacon-sort' ).val( sort );
				}
			} );
		},
		/*** Launch WordPress media manager ***/
		selectImage: function( e ) {
			e.preventDefault();
			var container = $( this ).parents( '.imacon' );
			var frame = wp.media({
				library:  { type : 'image' },
				multiple: false
			});
			// Handle results from media manager.
			frame.on( 'select', function() {
				var attachment = frame.state().get( 'selection' ).toJSON();
				if ( $.isEmptyObject( attachment ) ) {
					return;
				}
				Imacon.addImage( container, attachment[0] );
			});
			frame.open();
			return false;
		},
		/*** Add image to widget ***/
		addImage: function( container, attachment ) {
			container.find( '.imacon-preview img' ).attr( 'src', attachment.url );
			container.find( '.imacon-image' ).val( attachment.id ).trigger( 'change' );
			container.find( '.imacon-remove-image' ).removeClass( 'hidden' );
		},
		/*** Remove the image ***/
		removeImage: function() {
			var container = $( this ).parents( '.imacon' );
			// Remove preview and value
			$( this ).addClass( 'hidden' );
			container.find( '.imacon-image' ).val( 0 ).trigger( 'change' );
			container.find( '.imacon-preview img' ).attr( 'src', Imacon.placeholder );
		}
	};

	Imacon.init();

})( jQuery );
