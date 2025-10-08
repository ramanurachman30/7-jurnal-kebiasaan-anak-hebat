$("select[name=type]").on('change', function (e) {
    const val = $(this).find(":selected").val();
    if (val == 'Video') {
        $("div#video").removeClass("d-none");
    } else {
        $("input[name=link]").val('');
        $("div#video").addClass("d-none");
    }
}).trigger('change');