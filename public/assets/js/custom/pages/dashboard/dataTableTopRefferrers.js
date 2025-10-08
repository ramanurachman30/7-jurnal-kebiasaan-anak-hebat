"use strict";
const userToken = $('meta[name="token"]').attr('content');
const csrfToken = $('meta[name="token"]').attr('value');
let columns = $("input[name='data-columns']").val();
let firstSegment = $("meta[name='first-segment']").attr('content');
let firstSegmentApi = $("meta[name='first-segment-api']").attr('content');
let datatableUrl = hostUrl + '/api/google_analytics/top_refferrers';
let isAllowToUpdate = $("meta[name='permission']").attr('update');
let isAllowToTrash = $("meta[name='permission']").attr('trash');
let isAllowToRestore = $("meta[name='permission']").attr('restore');
let isAllowToDelete = $("meta[name='permission']").attr('delete');
let dataStatus = $("meta[name='status']").attr('content');

var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;

    var data = $('form#searchform').serializeArray();
    var searchAdvance = {};
    $.map(data, function (item, value) {
        searchAdvance[item['name']] = item['value'];
    });

    var initDatatable = function () {
        dt = $("#google-analityc").DataTable({
            searchDelay: 1000,
            processing: true,
            serverSide: true,
            order: [[1, 'desc']],
            // stateSave: true,
            ajax: {
                url: datatableUrl,
                headers: {
                    'Authorization': `Bearer ${userToken}`,
                },
                data: function (data) {
                    data.params = searchAdvance;
                    data.search = data.search.value;
                },
                complete: function (result) {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            },
            columns: [
                { "data": "pageReferrer" },
                { "data": "screenPageViews" },
            ],
        });

        table = dt.$;

        dt.on('draw', function () {
            handleSearchDatatable();
            handleFilterDatatable();
            KTMenu.createInstances();
        });
    }

    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    var handleFilterDatatable = () => {
        $('form#searchform').on("change", function () {
            var obj = $('form#searchform').serializeArray();
            searchAdvance = obj;
            dt.draw();
        });
    }

    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
            handleFilterDatatable();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});