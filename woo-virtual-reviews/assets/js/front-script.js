/*Js*/
jQuery(document).ready(function ($) {

    if ($(document).width() > 800) {
        $('.wvr-desktop-style').show();
        $('.wvr-mobile-style').hide();
    } else {
        $('.wvr-desktop-style').hide();
        $('.wvr-mobile-style').show();
    }


    $('.wvr-customer-select').on('change', function () {
        var value = $(this).val() + ' ';
        $('textarea#comment').focus();
        document.execCommand('insertText', false, value);
    });

    $('.wvr-select-sample-cmt').on('click', function () {
        var value = $(this).attr('data-value') + ' ';
        $('textarea#comment').focus();
        document.execCommand('insertText', false, value);
    });

    $('.wvr-clear-comment').click(function () {
        $('textarea#comment').val('');
    });

    if (php_js.auto_rating) {
        setTimeout(function () {
            $('p.stars').addClass('selected');
            $('a.star-5').addClass('active');
        }, 1000);
        $('select#rating option[value="5"]').attr('selected', 'selected');

        if (php_js.first_comment) {
            $('textarea#comment').val(php_js.first_comment + ' ');
        }
    }
});




