$(function () {
    var columns = $("#fieldRequired").val();
    const isrequired = {}
    const messages = {}
    if (columns) {
        let column = JSON.parse(columns);
        for (const key in column) {
            isrequired[key] = { required: true }
            messages[key] = `Field ${column[key]} is required !`
        }
    }

    $("form#createform").validate({
        ignore: '',
        errorElement: 'span',
        errorClass: 'is-invalid help-block help-block-error text-danger',
        focusInvalid: true,
        rules: isrequired,
        messages: messages,
        invalidHandler: function (event, validator) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Some fields is required !'
            }).then(() => {
                const btn = $(".btn-submit");
                btn.attr('data-kt-indicator', 'off');
                btn.removeAttr('disabled');
            });
        },
        errorPlacement: function (error, element) {
            if (element.hasClass('fileupload-content')) {
                error.insertAfter(element.closest('.fileupload-content'));
            } else if (element.hasClass('select2-hidden-accessible')) {
                error.insertAfter(element.siblings('.select2-container')).focus();
            } else if (element.hasClass('thumbnail-image')) {
                error.insertAfter(element.closest('.image-input'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form, e) {
            form.submit();
        }
    });
});