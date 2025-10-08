$(function () {
    $("#kt_modal_3").on('show.bs.modal', function (e) {
        const data = $(e.relatedTarget);
        const modal = $(this);
        modal.find("#modal-body").load(data.data('remote'));
    });

    $("#kt_modal_3").on('shown.bs.modal', function (e) {
        Thumbnail.init();
        Sluggable.init();
        quillEditor.init();
        var randomString = s4();

        $("form#modalForm").validate({
            ignore: '',
            errorElement: 'span',
            errorClass: 'help-block help-block-error text-danger',
            focusInvalid: true,
            rules: {
                'label': {
                    required: true
                },
                'short_desc': {
                    required: true
                },
                'image_desc': {
                    required: false
                },
            },
            errorPlacement: function (error, element) {
                if (element.hasClass('fileupload-content')) {
                    error.insertAfter(element.closest('.fileupload-content'));
                } else {
                    error.insertAfter(element);
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
            submitHandler: function (form, e) {
                const formData = $(form).serializeArray();

                var dom = `<tr class="trancient-data">`;
                for (i = 0; i < formData.length; i++) {
                    var data = formData[i].value;
                    if (i < 1) {
                        var imageUrl = "#";
                        if (data) {
                            let dataJson = JSON.parse(data);
                            imageUrl = assetDir + 'storage/avatar/' + dataJson.filename;
                        }
                        data = `
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(${imageUrl})">
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url(${imageUrl})"></div>
                            </div>
                        `;
                    }

                    dom += `<td>
                        <input type="hidden" name="trancient[sub_investment_outlooks][${randomString}][${formData[i].name}]" value='${formData[i].value}'>
                        ${data}
                    </td>`;
                }
                dom += `<td class="text-end">
                    <a class="btn btn-icon btn-sm btn-danger remove-row">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>`;
                dom += `</tr>`;
                $("table#trancient").find("tbody").append(dom);

                $("#kt_modal_3").modal('hide');
            }
        });
    });

    $(document).on("click", ".remove-row", function (e) {
        e.preventDefault();
        $(this).closest("tr").remove();
    });

    $("form#updateform").validate({
        ignore: '',
        errorElement: 'span',
        errorClass: 'help-block help-block-error text-danger',
        focusInvalid: true,
        rules: {
            file: {
                required: false
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
            document: {
                required: false,
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
            if (element.hasClass('fileupload-content')) {
                error.insertAfter(element.closest('.fileupload-content'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form, e) {
            form.submit();
        }
    });
});