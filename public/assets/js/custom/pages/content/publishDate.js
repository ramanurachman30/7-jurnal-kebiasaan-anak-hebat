$(function () {
    $("#modal_publish").on('show.bs.modal', function (e) {
        const data = $(e.relatedTarget);
        const modal = $(this);
        modal.find("#modal-body").load(data.data('remote'));
    });

    $("#modal_draft").on('show.bs.modal', function (e) {
        const data = $(e.relatedTarget);
        const modal = $(this);
        modal.find("#modal-body").load(data.data('remote'));
    });
});