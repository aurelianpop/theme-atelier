/**
 * Created by Pop on 2/7/2016.
 */

jQuery(document).ready(function($) {
    $('.modal-trigger').leanModal();

    /**
     * Change classes of the logout submenu so we can show and hide it
     */
    $('.at-logout a').click(function(e) {
        e.stopPropagation();
        $(this).next().toggleClass('ta-inactive ta-active');
    });

    /**
     * Initialize side navigation
     */
    $(".button-collapse").sideNav();

    /**
     * Hide logout submenu when clicking on the page
     */
    $('body').on('click', function(){
        if($('.logout-menu').hasClass('ta-active')) {
            $('.logout-menu').toggleClass('ta-inactive ta-active');
        }
    });

    /**
     * Hide logout from menu when side nav is visible
     */
    if($('#side_navigation_button').is(':visible'))
    {
        $('.logon-container').hide();
    }
    window.onresize = function(e){
        if($('#side_navigation_button').is(':visible')) {
            $('.logon-container').hide();
        }
        else {
            $('.logon-container').show();
        }
    }

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

    /**
     * Ajax save parents and partners frontend form data
     */
    $('#at_save_news').ajaxForm({
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