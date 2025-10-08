var FileuploadRepeater = function () {
    var fileImage = function () {
        $(`.fileupload-repeater`).on('change', function (evt) {
            console.log('changed');
            const data = $(this);
            const DataSize = data.data('size');
            const file = data[0].files[0];

            const { size, type } = file;
            console.log(type);
            if (
                type !== 'image/webp' &&
                type !== 'application/pdf' &&
                type !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' &&
                type !== 'application/vnd.ms-excel' &&
                type !== 'image/jpeg' &&
                type !== 'image/png'
            ) {
                Swal.fire({
                    icon: 'error',
                    title: 'File type is not allowed!',
                    text: `File type must be 'image/webp' and Document must be 'application/pdf' `
                });


                data.val(null);
                return false;
            }

            // console.log(type);
            if (size > DataSize) {
                const maxSize = sizeConverter(DataSize);
                Swal.fire({
                    icon: 'error',
                    title: 'File size is too large!',
                    text: `Max File size is ${maxSize}`
                }).then((value) => {
                    data.val(null);
                });
                return false;
            }
        });
    }

    var sizeConverter = function formatBytes(bytes, decimals = 2) {
        if (!+bytes) return '0 Bytes'

        const k = 1024
        const dm = decimals < 0 ? 0 : decimals
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

        const i = Math.floor(Math.log(bytes) / Math.log(k))

        return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
    }
    return {
        init: function () {
            fileImage();
        }
    };

}();

jQuery(document).ready(function () {
    FileuploadRepeater.init();
});