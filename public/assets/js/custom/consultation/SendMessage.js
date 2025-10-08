$(function () {
    const lang = $("#lang");
    const isrequired = {
        subject: { required: true },
        email: { required: true, email: true },
        name: { required: true },
        company: { required: true },
        industry: { required: true },
        job_level: { required: true },
        job_function: { required: true },
        place_of_residence: { required: true },
        phone: { required: true },
        message: { required: true },
        captcha: { required: true },
    }

    const messages = {
        subject: `${lang.data('subject')} ${lang.data('required')}`,
        email: {
            required: `${lang.data('email')} ${lang.data('required')}`,
            email: `${lang.data('emailformat')}`
        },
        name: `${lang.data('name')} ${lang.data('required')}`,
        company: `${lang.data('company')} ${lang.data('required')}`,
        industry: `${lang.data('industry')} ${lang.data('required')}`,
        job_level: `${lang.data('joblevel')} ${lang.data('required')}`,
        job_function: `${lang.data('jobfunction')} ${lang.data('required')}`,
        place_of_residence: `${lang.data('residence')} ${lang.data('required')}`,
        phone: `${lang.data('phone')} ${lang.data('required')}`,
        message: `${lang.data('message')} ${lang.data('required')}`
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