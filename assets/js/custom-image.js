/*
 * Adapted from: http://mikejolley.com/2012/12/using-the-new-wordpress-3-5-media-uploader-in-plugins/
 */
jQuery(function ($) {
    $(document).ready(function ($) {

        $('body').on('click', '.custom-image', function (event) {

            event.preventDefault();
            var parentForm = $(this).parent().parent();

            // Create the media frame.
            var file_frame = wp.media({
                title: $(this).attr('data-media-widget-title'),
                library: {
                    type: 'image'
                },
                button: {
                    text: $(this).data('uploader_button_text')
                },
                multiple: false  // Set to true to allow multiple files to be selected
            })
                    // When an image is selected, run a callback.
                    .on('select', function () {
                        // We set multiple to false so only get one image from the uploader
                        var attachment = file_frame.state().get('selection').first().toJSON();

                        // Do something with attachment.id and/or attachment.url here
                        parentForm.find('.current-custom-image').attr('src', attachment.url);
                        parentForm.find('.custom-image-value').val(attachment.id);
                    })
                    .open();

        });

    });

});