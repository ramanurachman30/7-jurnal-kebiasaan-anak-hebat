$(function () {
    $("form#createform").validate({
        ignore: '',
        errorElement: 'span',
        errorClass: 'help-block help-block-error text-danger',
        focusInvalid: true,
        rules: {
            file: {
                required: true
            },
            title: {
                required: true,
                maxlength: 255
            },
            slug: {
                required: true,
                maxlength: 255
            },
            short_desc: {
                required: true,
                minlength: 50,
            },
            long_desc: {
                required: true,
                minlength: 50
            },
            trancient_validation: {
                required: function () {
                    const dataTrancient = $("tr.trancient-data");
                    if (dataTrancient.length > 0) return false;
                    return true;
                },
            }
        },
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
            if (element.hasClass('thumbnail-image')) {
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