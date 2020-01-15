jQuery( document ).ready( function( $ ) {
  'use strict';
  
  $( document ).on( 'click', '.upload-button', function( e ) {
    e.preventDefault();
    var clickedElement = $( this );
    var image = wp.media( { 
      title: 'Upload Image',
      multiple: false
    } ).open()
    .on( 'select', function( e ) {
      // This will return the selected image from the Media Uploader, the result is an object
      var uploaded_image = image.state().get( 'selection' ).first();
      // We convert uploaded_image to a JSON object to make accessing it easier
      var image_url = uploaded_image.toJSON().url;
      // Let's assign the url value to the input field
      clickedElement.prev( '.image-url' ).val( image_url );
    } );
  } );
} );
