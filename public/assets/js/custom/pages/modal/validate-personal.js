$(document).ready(function () {
    $('input[name="download_as"]').change(function () {
        if (this.id === "flexRadioDefault1") {
            // $('#individu').removeClass('d-none');
            // $('#company').addClass('d-none');
            $('#name-label').text('Nama Lengkap');
        } else if (this.id === "flexRadioDefault2") {
            $('#name-label').text('Nama perusahaan');
            // $('#individu').addClass('d-none');
            // $('#company').removeClass('d-none');
        }
    });

    $('#personalData').submit(function (e) {
        e.preventDefault();

        // Reset error message
        //$('#error-message').text('');

        // Reset info message
        $('#info-container').hide().text('');

        // Validate inputs
        var name = $('#name').val().trim();
        var email = $('#email').val().trim();
        var phone = $('#phone').val().trim();

        // Additional validation for phone number
        if (!/^\d{8,13}$/.test(phone)) {
            // Set custom error message for phone number
            $('#info-container').text(infoMessage).fadeIn();
            return;
        }

        if (name === '' || email === '' || phone === '') {
            // Set custom error message
            $('#error-message').text('Please fill in all fields.');
            return;
        }

        // Add your additional validation logic here

        // If all inputs are valid, show "Sending" animation on the button
        var sendButton = $('#btn-btn');
        sendButton.html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...'
        );
        sendButton.prop('disabled', true);

        // Submit the form
        $('#personalData').get(0).submit();

        $('#staticBackdrop').modal('hide'); // Close the modal
    });
});

// $(document).ready(function () {
//     const individuForm = $('#individu');
//     const companyForm = $('#company');
//     const sendButton = $('#btn-btn');

//     // Memeriksa status tombol saat halaman dimuat
//     checkButtonStatus();

//     // Menambahkan event listener untuk memeriksa status saat input berubah
//     individuForm.find('input').on('input', checkButtonStatus);
//     companyForm.find('input').on('input', checkButtonStatus);

//     $('#btn-btn').on('click', function (e) {
//         e.preventDefault();
//         $('#staticBackdrop').modal('hide');
//     });

//     $('input[name="flexRadioDefault"]').change(function () {
//         if (this.id === "flexRadioDefault1") {
//             $('#individu').removeClass('d-none');
//             $('#company').addClass('d-none');
//         } else if (this.id === "flexRadioDefault2") {
//             $('#individu').addClass('d-none');
//             $('#company').removeClass('d-none');
//         }
//         checkButtonStatus();
//     });

//     // Fungsi untuk memeriksa status tombol
//     function checkButtonStatus() {
//         const individuInputs = individuForm.find('input');
//         const companyInputs = companyForm.find('input');
//         const isIndividuFormValid = isFormValid(individuInputs);
//         const isCompanyFormValid = isFormValid(companyInputs);

//         if (isIndividuFormValid || isCompanyFormValid) {
//             sendButton.prop('disabled', false);
//         } else {
//             sendButton.prop('disabled', true);
//         }
//     }

//     // Fungsi untuk memeriksa apakah semua input dalam suatu form sudah diisi
//     function isFormValid(inputs) {
//         let isValid = true;
//         inputs.each(function () {
//             if ($(this).val().trim() === '') {
//                 isValid = false;
//                 return false; // Keluar dari loop jika ada input yang kosong
//             }
//         });
//         return isValid;
//     }

//     // Fungsi untuk memeriksa validitas format email
//     function isValidEmail(email) {
//         const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
//         return emailPattern.test(email);
//     }

//     // Menambahkan validasi format email pada input email
//     individuForm.find('#email').on('input', function () {
//         const emailInput = $(this).val().trim();
//         const isValid = isValidEmail(emailInput);

//         if (!isValid) {
//             // Tambahkan pesan kesalahan jika email tidak valid
//             $(this).addClass('is-invalid');
//         } else {
//             $(this).removeClass('is-invalid');
//         }

//         checkButtonStatus(); // Periksa status tombol setelah perubahan input email
//     });

//     companyForm.find('#email').on('input', function () {
//         const emailInput = $(this).val().trim();
//         const isValid = isValidEmail(emailInput);

//         if (!isValid) {
//             // Tambahkan pesan kesalahan jika email tidak valid
//             $(this).addClass('is-invalid');
//         } else {
//             $(this).removeClass('is-invalid');
//         }

//         checkButtonStatus(); // Periksa status tombol setelah perubahan input email
//     });

// $("form#personalData").validate({
//     ignore: '',
//     errorElement: 'span',
//     errorClass: 'is-invalid help-block help-block-error text-danger',
//     focusInvalid: true,
//     rules: {
//         email: {
//             required: true,
//             email: true
//         },
//         name: {
//             required: true
//         },
//         phone: {
//             required: true,
//             number: true,
//         }
//     },
//     messages: {
//         phone: {
//             required: "Please enter a value.",
//             number: "Please enter a valid number.",
//         }
//     },
//     invalidHandler: function (event, validator) {
//         Swal.fire({
//             icon: 'error',
//             title: 'Oops...',
//             text: 'Some fields is required !'
//         }).then(() => {
//             const btn = $(".btn-submit");
//             btn.attr('data-kt-indicator', 'off');
//             btn.removeAttr('disabled');
//         });
//     },
//     errorPlacement: function (error, element) {
//         if (element.hasClass('fileupload-content')) {
//             error.insertAfter(element.closest('.fileupload-content'));
//         } else if (element.hasClass('select2-hidden-accessible')) {
//             error.insertAfter(element.siblings('.select2-container')).focus();
//         } else if (element.hasClass('thumbnail-image')) {
//             error.insertAfter(element.closest('.image-input'));
//         } else {
//             error.insertAfter(element);
//         }
//     },
//     submitHandler: function (form, e) {
//         form.submit();
//     }
// });
// });
