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
            section: {
                required: true
            },
            color: {
                required: true
            },
            full_name: {
                required: true
            },
            position: {
                required: true
            },
            display: {
                required: true
            },
            ordering: {
                required: true
            },
            trancient_validation: {
                required: function () {
                    let value = $("select[name=section]").find(":selected").val();
                    var noMember = ['section2', 'section5'];
                    if (noMember.includes(value)) return false;

                    const dataTrancient = $("tr.trancient-data");
                    if (dataTrancient.length > 0) return false;
                    return true;
                }
            },
        },
        messages: {
            section: 'Field section is required!',
            color: 'Field color is required!',
            full_name: 'Field full_name is required!',
            position: 'Field position is required!',
            display: 'Field display is required!',
            ordering: 'Field ordering is required!',
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
                error.insertAfter(element.siblings('.select2-container'));
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
        select2.init();
        $(".form-select").select2();
        $("form#modalForm").validate({
            ignore: '',
            errorElement: 'span',
            errorClass: 'is-invalid help-block help-block-error text-danger',
            focusInvalid: true,
            rules: {
                color: {
                    required: true
                },
                full_name: {
                    required: true
                },
                position: {
                    required: true
                },
                display: {
                    required: true
                },
                ordering: {
                    required: true
                }
            },
            messages: {
                color: 'Field color is required!',
                full_name: 'Field full_name is required!',
                position: 'Field position is required!',
                display: 'Field display is required!',
                ordering: 'Field ordering is required!',
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
                let isHidden = { 'd-block': 'Show', 'd-none': 'Hide' };
                var dom = `<tr class="trancient-data" id="${code}">`;
                for (i = 0; i < data.length; i++) {
                    let values = data[i].value;
                    if (i == 3) values = isHidden[data[i].value];
                    dom += `
                        <td>
                            <input type="hidden" name="trancient[sub_organizations][${code}][${data[i].name}]" value="${data[i].value}">
                            ${values}
                        </td>
                    `;
                }

                dom += `<td class="text-end">
                        <a class="btn btn-icon btn-sm btn-warning update-row" data-target="${code}" data-values='${JSON.stringify(data)}' href="#" data-remote="${hostUrl}/modal/sub_organizations"
                        class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#update_members">
                            <i class="fas fa-pencil"></i>
                        </a>
                        <a class="btn btn-icon btn-sm btn-danger remove-row">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>`;
                dom += '</tr>';
                $("table#trancient").find("tbody").append(dom);
                $("#kt_modal_3").modal('hide');
            }
        });
    });

    $("#update_members").on('show.bs.modal', function (e) {
        const data = $(e.relatedTarget);
        const modal = $(this);
        const values = data.data('values');
        const code = data.data('target');

        $("input#code").val(code);

        let encodeuri = '';

        for (let i = 0; i < values.length; i++) {
            let value = values[i].value;
            let params = `&${values[i].name}=${value.replace(" ", "+")}`;
            if (i == 0) params = `?${values[i].name}=${value.replace(" ", "+")}`;

            encodeuri += params;
        }

        const url = data.data('remote') + encodeuri;
        modal.find("#modal-body").load(url);
    });

    $("#update_members").on('shown.bs.modal', function (e) {
        select2.init();
        $(".form-select").select2();
        $("form#updateForm").validate({
            ignore: '',
            errorElement: 'span',
            errorClass: 'is-invalid help-block help-block-error text-danger',
            focusInvalid: true,
            rules: {
                color: {
                    required: true
                },
                full_name: {
                    required: true
                },
                position: {
                    required: true
                },
                display: {
                    required: true
                },
                ordering: {
                    required: true
                }
            },
            messages: {
                color: 'Field color is required!',
                full_name: 'Field full_name is required!',
                position: 'Field position is required!',
                display: 'Field display is required!',
                ordering: 'Field ordering is required!',
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
                let code = $("input#code").val();
                let isHidden = { 'd-block': 'Show', 'd-none': 'Hide' };
                var dom = ``;
                for (i = 0; i < data.length; i++) {
                    let values = data[i].value;
                    if (i == 3) values = isHidden[data[i].value];
                    dom += `
                        <td>
                            <input type="hidden" name="trancient[sub_organizations][${code}][${data[i].name}]" value="${data[i].value}">
                            ${values}
                        </td>
                    `;
                }

                dom += `<td class="text-end d-flex">
                        <a class="btn btn-icon btn-sm btn-warning update-row me-3" data-target="${code}" data-values='${JSON.stringify(data)}' href="#" data-remote="${hostUrl}/modal/sub_organizations"
                        class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#update_members">
                            <i class="fas fa-pencil"></i>
                        </a>
                        <a class="btn btn-icon btn-sm btn-danger remove-row">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>`;

                $("table#trancient").find("tbody").find(`tr#${code}`).html(dom);
                $("#update_members").modal('hide');
            }
        });
    });

    $("select[name=section]").on("change", function () {
        let value = $(this).find(":selected").val();
        var target = $("div#members");
        var noMember = ['section2', 'section5'];
        if (noMember.includes(value)) {
            target.addClass('d-none');
            $("tr.trancient-data").remove();
        } else {
            target.removeClass('d-none');
        }
    });
});