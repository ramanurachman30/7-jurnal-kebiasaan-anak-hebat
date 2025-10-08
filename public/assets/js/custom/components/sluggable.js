var Sluggable = (function () {
  var autoSlug = function () {
    $("input[name=slug]").attr("readonly", true);
    $(
      "input[name=country], input[name=title], input[name=name], input[name=minister_name], select[name=title]"
    ).change(function (e) {
      var data = $(this);
      let url = `${hostUrl}/api/${firstSegmentUrl}/check-slug`;
      let title = data.val();
      $.ajax({
        url: url,
        type: "GET",
        headers: {
          Authorization: `Bearer ${personalToken}`,
        },
        data: {
          title: title,
        },
        success: function (res) {
          const { slug } = res;
          $("input[name=slug]").val(slug);
          $("input[name=slug]").attr("readonly", true);
          // data.closest('.row').find('.slug').val(slug);
        },
        error: function (err) {
          console.log(err);
        },
      });
    });
    // .trigger("change");
  };
  return {
    init: function () {
      autoSlug();
    },
  };
})();

jQuery(document).ready(function () {
  Sluggable.init();
});
