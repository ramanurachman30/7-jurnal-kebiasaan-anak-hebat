$(function () {
    $(".menu-link").each(function () {
        var href = window.location.href.replace(/\?.*/g, "");
        if ($(this).attr('href') == href || href.indexOf($(this).attr('href') + '/') > -1) {
            $(this).addClass('active');
            $(this).closest('.menu-accordion').addClass('here show');
            $(this).closest('.parent').addClass('here show');
        }
    })
});
