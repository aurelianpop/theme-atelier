/**
 * Created by Pop on 2/7/2016.
 */

jQuery(document).ready(function($) {
    $('.modal-trigger').leanModal();

    $('.at-logout a').click(function() {
        $(this).next().toggleClass('ta-inactive ta-active');
    });
});