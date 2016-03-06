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
        success: function(response){
            console.log(response);
            $('#post_title, #post_content, .file-path').val('');
            Materialize.toast('Saved!', 4000, 'green accent-4');
            $('.at-pending-news-list').prepend(response);
        },
        error: function() {
            Materialize.toast('Saved!', 4000, 'red accent-4');
            //$('#output').html('Something went wrong');
        }
    });

    $('.delete-item-modal').on('click', function() {
        var id = $(this).data('id');
        $('#ta-delete-news').attr('data-id', id);
    } );

    /**
     * Ajax Delete news
     */
    $( "#ta-delete-news" ).on('click', function() {
        var id = $(this).attr('data-id'),
            data = {
            'action': 'delete_post',
            'post_id': id
        };

        $.post(ajax_front.ajaxurl, data, function(response) {
            if(response) {
                var item = '.at-news-item-' + id;
                $(item).remove();
                Materialize.toast('Deleted!', 4000, 'red accent-4');
            }
        });
    });

});