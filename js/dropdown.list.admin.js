jQuery(document).ready(function($) {

  var frame;

    $('#upload-button').on('click', function( e ) {
        e.preventDefault();
        if ( frame ) {
            frame.open();
            return;
        }

        frame = wp.media({
            title: 'Choose a Profile Picture',
            button: {
                text: 'Choose picture'
            },
            multiple: false
        });

        frame.on( 'select', function() {

          // Get media attachment details from the frame state
          var attachment = frame.state().get('selection').first().toJSON();

          // Send the attachment URL to our custom image input field.
          $( '#profile-picture' ).val( attachment.url );
          $( '#profile-picture-preview' ).css( 'background-image', 'url(' +attachment.url+ ')');

        });

        // Finally, open the modal on click
        frame.open();

      });

});
