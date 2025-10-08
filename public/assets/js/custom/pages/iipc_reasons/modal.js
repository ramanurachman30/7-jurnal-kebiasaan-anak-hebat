$(function () {
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