$(function(){
    $("select[name=type]").on('change', function () {
        const val = $(this).find(":selected").val();
        const selectror = $('input[name=link]');
        const targetSelectror = $(selectror).closest('.row');
        if (val === 'Link') {
            targetSelectror.removeClass('d-none');
        } else {
            targetSelectror.addClass('d-none');
            selectror.val(null);
        }
    }).trigger('change');
});