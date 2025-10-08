$('#staticBackdrop').on('show.bs.modal', function (e) {
    const data = $(e.relatedTarget);
    let modal = $(this);
    modal.find('.modal-content').load(data.data('remote'));
});