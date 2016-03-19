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

        // ADD IMAGE LINK
        $('.upload-custom-img').on( 'click', function(e){
            e.preventDefault();

            var frame;
            var link = $(e.target);
            var containerId = '#' + link.parent().attr('data-metaboxid');

            // If the media frame already exists, reopen it.
            if ( frame ) {
                frame.open();
                return;
            }

            // Create a new media frame
            frame = wp.media({
                title: 'Select or Upload Media',
                button: {
                    text: 'Use this media'
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });

            // When an image is selected in the media frame...
            frame.on( 'select', function() {
                var imgContainer = $('.custom-img-container', containerId);
                var delImgLink = $('.delete-custom-img', containerId);
                var imgURLInput = $('.logo-url', containerId);

                // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').first().toJSON();

                // Send the attachment URL to our custom image input field.
                $(imgContainer).append( '<img src="' + attachment.url + '" alt="" style="max-width:100%;"/>' );

                // Send the attachment url to our hidden input
                imgURLInput.val(attachment.url);

                // Hide the add image link
                link.addClass('hidden');

                // Unhide the remove image link
                delImgLink.removeClass('hidden');
            });

            // Finally, open the modal on click
            frame.open();
        });


        // DELETE IMAGE LINK
        $('.delete-custom-img').on( 'click', function(e){
            e.preventDefault();

            var containerId = '#' + $(e.target).parent().attr('data-metaboxid');

            // Clear out the preview image
            $('.custom-img-container', containerId).html('');

            // Un-hide the add image link
            $('.upload-custom-img', containerId).removeClass('hidden');

            // Hide the delete image link
            $(e.target).addClass('hidden');

            // Delete the image id from the hidden input
            $('.logo-url', containerId).val( '' );

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