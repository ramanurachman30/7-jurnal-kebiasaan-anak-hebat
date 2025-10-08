var DatePicker = function () {

    return {
        init: function (obj = null) {
            var element = $('.input-group.date.flatpickr');

            if (obj) {
                element = $(obj).find('.input-group.date.flatpickr');
            }

            element.each(function (e) {
                var input = $(this).find('input[type="text"]');
                var input_hidden = $(this).find('input[type="hidden"]');

                input.flatpickr({
                    dateFormat: $(this).attr('date-format'),
                    onChange: function (selectedDates, dateStr, instance) {
                        input_hidden.val(moment(selectedDates[0]).format('YYYY-MM-DD'));
                    }
                });
            });
        }

    };

}();

var DatePicker = function () {

    return {
        init: function (obj = null) {
            var element = $('.input-group.date.flatpickr');

            if (obj) {
                element = $(obj).find('.input-group.date.flatpickr');
            }

            element.each(function (e) {
                var input = $(this).find('input[type="text"]');
                var input_hidden = $(this).find('input[type="hidden"]');

                input.flatpickr({
                    dateFormat: $(this).attr('date-format'),
                    onChange: function (selectedDates, dateStr, instance) {
                        input_hidden.val(moment(selectedDates[0]).format('YYYY-MM-DD'));
                    }
                });
            });
        }
    };
}();

var DateTimePicker = function () {
    return {
        init: function (obj = null) {
            var element = $('.input-group.date.datetime');

            if (obj) {
                element = $(obj).find('.input-group.date.datetime');
            }

            element.each(function (e) {
                var input = $(this).find('input[type="text"]');
                var input_hidden = $(this).find('input[type="hidden"]');

                input.flatpickr({
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    // dateFormat: $(this).attr('date-format'),
                    onChange: function (selectedDates, dateStr, instance) {
                        input_hidden.val(moment(selectedDates[0]).format('YYYY-MM-DD HH:mm'));
                    }
                });
            });
        }
    };
}();

jQuery(document).ready(function () {
    DatePicker.init();
    DateTimePicker.init();
});

jQuery(document).ready(function () {
    DatePicker.init();
    DateTimePicker.init();
});
