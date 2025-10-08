$(document).ready(function () {
    $('[type*="radio"]').change(function () {
        var me = $(this);
        $('#log').html(me.val());
    });
});