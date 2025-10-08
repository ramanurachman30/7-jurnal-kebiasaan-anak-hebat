$(document).ready(function () {
    var outerContent = $('.scrolling-card');
    var innerContent = $('.scrolling-card > div');

    outerContent.scrollLeft((innerContent.width() - outerContent.width()) / 1.5);
    if (count($errors) > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!'
        });
    }

    if (session() == 'success') {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'consultation data has been sent!!'
        });
    }
}); 