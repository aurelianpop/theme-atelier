/**
 * Created by Pop on 2/7/2016.
 */

jQuery(document).ready(function($) {
    $('.modal-trigger').leanModal();
    $('select').material_select();


    /**
     * Lightbox for Galleries
     * @type {{rel: string, width: string, height: string, maxWidth: string, maxHeight: string, title: cbSettings.title}}
     */
    //Settings for lightbox
    var cbSettings = {
        rel: 'cboxElement',
        width: '95%',
        height: 'auto',
        maxWidth: '660',
        maxHeight: 'auto'
    };

    //Initialize jQuery Colorbox
    $('.gallery a[href$=".jpg"], .gallery a[href$=".jpeg"], .gallery a[href$=".png"], .gallery a[href$=".gif"]').colorbox(cbSettings);

    //Keep lightbox responsive on screen resize
    $(window).on('resize', function() {
        $.colorbox.resize({
            width: window.innerWidth > parseInt(cbSettings.maxWidth) ? cbSettings.maxWidth : cbSettings.width
        });
    });

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
     * Input field for phone number
     */
    $(".at-phone-type-field").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39  ) {
            if (!((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105))) {
                event.preventDefault();
            }
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
        success: function(response){
            //TODO: put timeout here
            Materialize.toast('Setarile au fost salvate!', 4000, 'green accent-4');
            $('#ta-partner-logo').attr('src', response);
        },
        error: function() {
            Materialize.toast('Setarile nu au fost salvate!', 4000, 'red accent-4');
        }
    });

    /**
     * Ajax save parents and partners frontend form data
     */
    $('#at_save_news').ajaxForm({
        url: ajax_front.ajaxurl,
        success: function(response){
            $('#post_title, #post_content, .file-path').val('');
            Materialize.toast('Stirea a fost salvata cu success!', 4000, 'large green accent-4');
            $('.at-pending-news-list').prepend(response);
        },
        error: function() {
            Materialize.toast('Stirea nu a fost salvata!', 4000, 'large red accent-4');
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
                Materialize.toast('Stirea a fost stearsa!', 4000, 'large red accent-4');
            }
        });
    });

    /**
     * Ajax send email to a partner
     */
    $('#at_send_email_partner').ajaxForm({
        url: ajax_front.ajaxurl,
        success: function(response){
            $('#first_name, #last_name, #email, #subject, #mesaj').val('');
            Materialize.toast('Mesajul a fost trimis!', 4000, 'large green accent-4');
        },
        error: function() {
            Materialize.toast('Mesajul nu a fost trimis!', 4000, 'large red accent-4');
        }

    });

    /**
     * Ajax send email to admins for a new child enqury
     */
    $('#at_send_email_admin').ajaxForm({
        url: ajax_front.ajaxurl,
        success: function(response){
            //TODO: put timeout here
            Materialize.toast('Mesajul a fost trimis!', 4000, 'large green accent-4');
        },
        error: function() {
            Materialize.toast('Mesajul nu a fost trimis!', 4000, 'large red accent-4');
        }
    });

    $("#ta-carousel").owlCarousel({

        // Most important owl features
        items : 4,
        itemsDesktopSmall : [980,3],
        itemsTablet: [768,2],
        itemsTabletSmall: false,
        itemsMobile : [479,1],
        singleItem : false,
        itemsScaleUp : false,

        //Basic Speeds
        slideSpeed : 200,
        paginationSpeed : 800,
        rewindSpeed : 1000,

        //Autoplay
        autoPlay : true,
        stopOnHover : true,

        // Navigation
        navigation : false,
        navigationText : ["prev","next"],
        rewindNav : true,
        scrollPerPage : false,

        //Pagination
        pagination : true,
        paginationNumbers: false,

        // Responsive
        responsive: true,
        responsiveRefreshRate : 200,
        responsiveBaseWidth: window,

        // CSS Styles
        baseClass : "owl-carousel",
        theme : "owl-theme",

        //Lazy load
        lazyLoad : false,
        lazyFollow : true,
        lazyEffect : "fade",

        //Auto height
        autoHeight : false,

        //JSON
        jsonPath : false,
        jsonSuccess : false,

        //Mouse Events
        dragBeforeAnimFinish : true,
        mouseDrag : true,
        touchDrag : true,

        //Transitions
        transitionStyle : false,

        // Other
        addClassActive : false,

        //Callbacks
        beforeUpdate : false,
        afterUpdate : false,
        beforeInit: false,
        afterInit: false,
        beforeMove: false,
        afterMove: false,
        afterAction: false

    });

});