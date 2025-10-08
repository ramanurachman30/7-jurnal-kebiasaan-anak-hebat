$(function () {
    $("#kt_modal_3").on('show.bs.modal', function (e) {
        const data = $(e.relatedTarget);
        const modal = $(this);
        modal.find("#modal-body").load(data.data('remote'));
    });

    $("#kt_modal_3").on('shown.bs.modal', function (e) {
        Thumbnail.init();
        var randomString = s4();

        $("form#modalForm").on("submit", function () { }).validate({
            ignore: '',
            errorElement: 'span',
            errorClass: 'help-block help-block-error text-danger',
            focusInvalid: true,
            rules: {
                'image': {
                    required: true
                },
                'image_desc': {
                    required: true
                },
            },
            errorPlacement: function (error, element) {
                if (element.hasClass('fileupload-content')) {
                    error.insertAfter(element.closest('.fileupload-content'));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form, e) {
                const formData = $(form).serializeArray();
                var dom = `<tr class="trancient-data">`;
                for (i = 0; i < formData.length; i++) {
                    var data = formData[i].value;
                    if (i < 1) {
                        let dataJson = JSON.parse(data);
                        var imageUrl = assetDir + 'storage/avatar/' + dataJson.filename;
                        data = `
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(${imageUrl})">
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url(${imageUrl})"></div>
                        </div>
                    `;
                    }

                    dom += `<td>
                    <input type="hidden" name="trancient[galleries][${randomString}][${formData[i].name}]" value='${formData[i].value}'>
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

    $("form#createform").validate({
        ignore: '',
        errorElement: 'span',
        errorClass: 'help-block help-block-error text-danger',
        focusInvalid: true,
        rules: {
            image: {
                required: true
            },
            image_desc: {
                required: true,
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

    $("select[name=type]").on("change", function () {
        let value = $(this).find(":selected").val();
        var target = $("div#galleries");
        var noMember = ['Video'];
        if (noMember.includes(value)) {
            target.addClass('d-none');
            $("tr.trancient-data").remove();
        } else {
            target.removeClass('d-none');
        }
    });
});