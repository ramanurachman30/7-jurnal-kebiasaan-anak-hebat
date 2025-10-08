$(function () {

    $('#exampleModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var modal = $(this);
        modal.find('.modal-body').load(button.data("remote"));
    });

    $('#exampleModal').on('shown.bs.modal', function (e) {
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
        }

        const messages = {
            subject: 'Subject is required!',
            email: {
                required: 'Email is required!',
                email: 'The email format is incorrect!'
            },
            name: 'Name is required!',
            company: 'Company is required!',
            industry: 'Industry is required!',
            job_level: 'Job level is required!',
            job_function: 'Job function is required!',
            place_of_residence: 'Place of residence is required!',
            phone: 'Phone is required!',
            message: 'Message is required: Please write your message here!',
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
                const data = $(form).serializeArray();
                const captcha = grecaptcha.getResponse();
                if (!captcha) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Captcha is not validated!'
                    });
                    return false;
                }

                const getUrl = $("meta[name=hosturl]").attr('content');
                const url = getUrl + '/iipc_send_message';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function (resp) {
                        $('.btnclose').click();
                        $('#sendingModal').modal('show');
                    },
                    error: function (err) {
                        console.log(err.responseText)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: err.responseText
                        });
                    }
                });
            }
        });
    });
});