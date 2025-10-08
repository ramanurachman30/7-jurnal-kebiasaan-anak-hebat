$("button#btn-gpr").on("click", function () {
    const remote = $(this).data('remote');
    $("div#content-gpr").load(remote, function () {
        $('.lds-spinner').addClass('d-none');
    });
});