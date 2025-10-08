$(document).ready(function() {
    const isCurrentCheckbox = $('input[name="is_current"]');
    const endPeriodField = $('input[name="end_period"]');
    const endPeriodFieldContainer = endPeriodField.closest('.form-group.row');

    function toggleEndPeriodVisibility() {
        if (isCurrentCheckbox.is(':checked')) {
            endPeriodFieldContainer.hide();
            endPeriodField.val(''); // Clear the value when hidden
        } else {
            endPeriodFieldContainer.show();
        }
    }

    // Initial check on page load
    toggleEndPeriodVisibility();

    // Attach event listener to the checkbox
    isCurrentCheckbox.on('change', toggleEndPeriodVisibility);
});
