/**
 * Created by Pop on 2/7/2016.
 */

jQuery(document).ready(function($) {
    $('.modal-trigger').leanModal();

    /**
     * Change classes of the logout submenu so we can show and hide it
     */
    $('.at-logout a').click(function() {
        $(this).next().toggleClass('ta-inactive ta-active');
    });
    $('at_changed').on('change', function() {
        console.log('sfaffs');
    });
    /**
     * Ajax save parents and partners frontend form data
     */
    $('#at_save_settings').ajaxForm({
        url: ajax_front.ajaxurl,
        beforeSubmit: function () {
            $('#output').html('Saving ...');
        },
        success: function(response){
            //TODO: put timeout here
            $('#output').html('Saved');
            $('#ta-partner-logo').attr('src', response);
        },
        error: function() {
            $('#output').html('Something went wrong');
        }
    });

});