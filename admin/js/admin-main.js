/**
 * Created by Pop on 2/20/2016.
 */

(
    function ( $ ) {
        /**
         * Toggle trough the user rols and show the fields accordingly
         */
        $("select[name='role']").change(function(e) {
            if($(e.target).val() == "partner") {
                $('.ta-table-phone, .ta-table-cnp, .ta-table-address, .ta-table-job, .ta-table-help, .ta-table-children, .ta-table-anonymus, .ta-table-has-children, .ta-table-status').slideUp();
                $('.ta-table-logo, .ta-table-contact-name, .ta-table-contact-surname, .ta-table-contact-phone, .ta-table-contact-function').slideDown();
            } else if ($(e.target).val() == "parent") {
                $('.ta-table-logo, .ta-table-contact-name, .ta-table-contact-surname, .ta-table-contact-phone, .ta-table-contact-function').slideUp();
                $('.ta-table-phone, .ta-table-cnp, .ta-table-address, .ta-table-job, .ta-table-help, .ta-table-children, .ta-table-anonymus, .ta-table-has-children, .ta-table-status').slideDown();
            } else {
                $('.ta-table-phone, .ta-table-cnp, .ta-table-address, .ta-table-job, .ta-table-help, .ta-table-children, .ta-table-anonymus, .ta-table-has-children, .ta-table-status, .ta-table-logo, .ta-table-contact-name, .ta-table-contact-surname, .ta-table-contact-phone, .ta-table-contact-function').slideDown();
            }
        });

        /**
         * Open media library and add logo
         */
        var frame,
            metaBox = $('.ta-table-logo'), // Your meta box id here
            addImgLink = metaBox.find('.upload-custom-img'),
            delImgLink = metaBox.find( '.delete-custom-img'),
            imgContainer = metaBox.find( '.custom-img-container'),
            imgURLInput = metaBox.find( '.partner-logo-url' );

        // ADD IMAGE LINK
        addImgLink.on( 'click', function( event ){

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if ( frame ) {
                frame.open();
                return;
            }

            // Create a new media frame
            frame = wp.media({
                title: 'Select or Upload Media Of Your Chosen Persuasion',
                button: {
                    text: 'Use this media'
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });


            // When an image is selected in the media frame...
            frame.on( 'select', function() {

                // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').first().toJSON();

                // Send the attachment URL to our custom image input field.
                imgContainer.append( '<img src="'+attachment.url+'" alt="" style="max-width:100%;"/>' );

                // Send the attachment url to our hidden input
                imgURLInput.val( attachment.url );

                // Hide the add image link
                addImgLink.addClass( 'hidden' );

                // Unhide the remove image link
                delImgLink.removeClass( 'hidden' );
            });

            // Finally, open the modal on click
            frame.open();
        });


        // DELETE IMAGE LINK
        delImgLink.on( 'click', function( event ){

            event.preventDefault();

            // Clear out the preview image
            imgContainer.html( '' );

            // Un-hide the add image link
            addImgLink.removeClass( 'hidden' );

            // Hide the delete image link
            delImgLink.addClass( 'hidden' );

            // Delete the image id from the hidden input
            imgURLInput.val( '' );

        });

        /**
         * Progresive search for children
         */
        $( ".search_child" ).keyup(function() {
            var data = {
                'action': 'progressive_children_search',
                'q': $(this).val()
            };

            /**
             * Perform ajax call
             */
            if(data.q) {
                $.post(ajaxurl, data, function(response) {
                    $('.child-search-results').empty().append(response);

                    if(response) {
                        var children = '';
                        $.each(JSON.parse(response), function( key, value ) {
                            children += '<li><a href="javascript:void(0)" class="child-result" value="'+ value.id +'">'+ value.title +'</a></li>';
                        });
                        $('.child-search-results').empty().show().append(children);
                    } else {
                        $('.child-search-results').empty().show().append('<li>No results found !</li>');
                    }
                });
            }
        });

        /**
         * Add child to the list
         */
        $('.child-search-results').on('click', '.child-result', function() {
            $('.child-search-results').empty();
            $('.search_child').val('');
            $('.ta-table-added-children').show();
            $('.ta-children-list').append('<li>' + $(this).text() + ' <a href="javascript:void(0)" class="remove-child">[x]</a><input type="hidden" name="children[]" value="' + $(this).attr('value') + '"></li>')
        });

        /**
         * remove child from the list
         */
        $('.ta-children-list').on('click', '.remove-child', function() {

            $(this).parent().remove();
        });


    }
)( jQuery );