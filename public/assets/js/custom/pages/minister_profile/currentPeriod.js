$(document).ready(function () {
  function toggleEndPeriod() {
    if ($("#is_current").is(":checked")) {
      $('[name="end_period"]').closest(".form-group").hide();
      $('[name="end_period"]').prop("disabled", true);
    } else {
      $('[name="end_period"]').closest(".form-group").show();
      $('[name="end_period"]').prop("disabled", false);
    }
  }

  toggleEndPeriod();

  $("#is_current").change(function () {
    toggleEndPeriod();
  });
});
