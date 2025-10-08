$(function () {
    var columns = $("#fieldRequired").val();
    const isrequired = {}
    const messages = {}
    if (columns) {
        let column = JSON.parse(columns);
        for (const key in column) {
            isrequired[key] = {
                required: true
            }
            messages[key] = `Field ${column[key]} is required !`
        }
    }

    $("form#createform").validate({
        ignore: '',
        errorElement: 'span',
        errorClass: 'is-invalid help-block help-block-error text-danger',
        focusInvalid: true,
        rules: {
            content_title: {
                required: true
            },
            short_description: {
                required: true
            },
            banner: {
                required: true
            },
            banner_desc: {
                required: true
            },
            trancient_validation: {
                required: function () {
                    const dataTrancient = $("tr.trancient-data");
                    if (dataTrancient.length > 0) return false;
                    return true;
                }
            },
        },
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

    $("#kt_modal_3").on('show.bs.modal', function (e) {
        const data = $(e.relatedTarget);
        const modal = $(this);
        modal.find("#modal-body").load(data.data('remote'));
    });

    $("#kt_modal_3").on('shown.bs.modal', function (e) {
        $("form#modalForm").validate({
            ignore: '',
            errorElement: 'span',
            errorClass: 'is-invalid help-block help-block-error text-danger',
            focusInvalid: true,
            rules: {
                reason_title: {
                    required: true
                },
                description: {
                    required: true
                }
            },
            messages: {
                reason_title: 'Field Title is required!',
                description: 'Field Description is required!',
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
                let data = $(form).serializeArray();
                let code = s4();
                var dom = '<tr class="trancient-data">';
                for (i = 0; i < data.length; i++) {
                    dom += `
                    <td>
                        <input type="hidden" name="trancient[iipc_reasons][${code}][${data[i].name}]" value="${data[i].value}">
                        ${data[i].value}
                    </td>
                `;
                }

                dom += `<td class="text-end">
                    <a class="btn btn-icon btn-sm btn-danger remove-row">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>`;
                dom += '</tr>';
                console.log(dom)
                $("table#trancient").find("tbody").append(dom);
                $("#kt_modal_3").modal('hide');
            }
        });
    });
});