$(function () {
    $("select[name=role]").on("change", function () {
        const val = $(this).find(":selected").val();
        if (val == 2) {
            $("select[name=iipc]").closest(".form-group").removeClass("d-none");
        } else {
            $("select[name=iipc]").val(null);
            $("select[name=iipc]").closest(".form-group").addClass("d-none");
        }
    }).trigger("change");

    $("form#createform").validate({
        ignore: '',
        errorElement: 'span',
        errorClass: 'is-invalid help-block help-block-error text-danger',
        focusInvalid: true,
        rules: {
            address: {
                required: true
            },
            email: {
                required: true
            },
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            gender: {
                required: true
            },
            password: {
                required: true
            },
            phone_number: {
                required: true
            },
            photo: {
                required: true
            },
            role: {
                required: true
            },
            status: {
                required: true
            },
            username: {
                required: true
            },
            iipc: {
                required: function () {
                    let role = $("select[name=role]").find("option:selected").val();
                    if (role == 2) return true;
                    return false;
                }
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