@extends('skeleton')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="datatable-url" content="{{ url('api/admin/' . Request::segment(2) . '/datatable') }}">
    <meta name="first-segment" content="{{ url('admin/'. Request::segment(2)) }}">
    <meta name="first-segment-api" content="{{ url('api/admin/' . Request::segment(2)) }}">
    <meta name="permission" restore="{{ Auth::allowedUri(Request::segment(2).'.restore') ? true : false }}" delete="{{ Auth::allowedUri(Request::segment(2).'.delete') ? true : false }}">
    <meta name="status" content="2">
@endsection

@section('toolbar')
    <a href="{{ url()->previous() }}" class="btn btn-light-success">
        <span class="svg-icon svg-icon-success svg-icon-2">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24"/>
                    <rect fill="currentColor" opacity="0.3" transform="translate(12.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-12.000000, -12.000000) " x="11" y="5" width="2" height="14" rx="1"/>
                    <path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="currentColor" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) "/>
                </g>
            </svg>
        </span>
        {{ __('Back') }}
    </a>
@endsection

@section('content')
    <?php
    $column = [['data' => 'id']];
    ?>

    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="mb-5 row g-5 g-xl-10 mb-xl-10">
            <div class="col-xl-12">
                <div class="card card-flush h-md-100">
                    <div class="card-header pt-7">
                        <!--begin::Title-->
                        <div class="my-1 d-flex align-items-center position-relative">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-user-table-filter="search"
                                class="form-control form-control-solid w-250px ps-14"
                                placeholder="{{ __('Search') }} {{ __($segmentName) }}" />
                        </div>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-user-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                                <span class="me-2"
                                    data-kt-user-table-select="selected_count"></span>{{ __('Selected') }}
                            </div>
                            <button type="button" class="btn btn-danger"
                                data-kt-user-table-select="delete_selected">{{ __('Delete Selected') }}</button>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <div class="pt-6 card-body">
                        <div class="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                    id="kt_datatable_example_1">
                                    <thead>
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                        data-kt-check-target="#kt_datatable_example_1 .form-check-input"
                                                        value="1" />
                                                </div>
                                            </th>
                                            @foreach ($forms as $key => $items)
                                                @if ($items['display'])
                                                    <th class="text-nowrap">{{ __($items['label']) }}</th>
                                                    <?php
                                                    if ($items['type'] == 'sysparam') {
                                                        $column[] = ['data' => $items['name'] . '.' . $items['options']['display']];
                                                    } else {
                                                        $column[] = ['data' => $items['name']];
                                                    }
                                                    ?>
                                                @endif
                                            @endforeach
                                            <?php $column[] = ['data' => null]; ?>
                                            <th class="text-end min-w-100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-semibold">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $columns = json_encode($column, true); ?>
    <input type="hidden" name="data-columns" value="{{ $columns }}">
@endsection

@section('customjs')
    <script>
        "use strict";

var columns = @json($columns);
// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;
    var filterPayment;

    var searchAdvance = [];
    // Private functions
    var initDatatable = function () {
        dt = $("#kt_datatable_example_1").DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                url: "{{ url('api/admin/' . Request::segment(2) . '/datatable') }}",
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer {{session('bearer_token')}}',
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: function (data) {
                    data.params = searchAdvance;
                    data.search = data.search.value;
                    data.status = 2; // Trashed records
                },
                complete: function (result) {
                    $("#kt_datatable_example_1").find("th:first-child").removeClass("sorting_asc");
                }
            },
            columns: JSON.parse(columns),
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {
                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: -2,
                    render: function (data) {
                        let color = 'danger';
                        if (data == 'Active') {
                            color = 'success';
                        }

                        return `
                            <span class="badge py-3 px-4 fs-7 badge-light-${color}">${data}</span>
                        `;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        var action = `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                {{ __('Action') }}
                                <span class="m-0 svg-icon svg-icon-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px" data-kt-menu="true">
                        `;

                        @if(Auth::allowedUri(Request::segment(2).'.restore'))
                        action += `
                            <div class="menu-item px-3">
                                <a data-remote="{{ url('api/admin/'.Request::segment(2)) }}/${data.id}/restore" class="menu-link px-3" data-kt-user-table-filter="restore_row">
                                    {{ __('Restore') }}
                                </a>
                            </div>
                        `;
                        @endif

                        @if(Auth::allowedUri(Request::segment(2).'.delete'))
                        action += `
                            <div class="menu-item px-3">
                                <a data-remote="{{ url('api/admin/'.Request::segment(2)) }}/${data.id}" class="menu-link px-3" data-kt-user-table-filter="delete_row">
                                    {{ __('Delete') }}
                                </a>
                            </div>
                        `;
                        @endif

                        action += `</div>`;

                        return action;
                    },
                },
            ],
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            handleRestoreRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    var handleDeleteRows = () => {
        const deleteButtons = document.querySelectorAll('[data-kt-user-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                const url = $(this).data('remote');
                const parent = e.target.closest('tr');
                const customerName = parent.querySelectorAll('td')[1].innerText;

                Swal.fire({
                    text: "{{ __('Are you sure want to permanently delete') }} " + customerName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "{{ __('Yes') }}, {{ __('delete') }}!",
                    cancelButtonText: "{{ __('No') }}, {{ __('cancel') }}",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: "POST",
                            headers: {
                                'Authorization': 'Bearer {{session('bearer_token')}}',
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            success: function (resp) {
                                Swal.fire({
                                    text: "{{ __(ucwords(Request::segment(2))) }} " + "{{ __('Permanently Deleted') }}",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Yes') }}",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    dt.draw();
                                });
                            }
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: customerName + " {{ __('Not deleted') }}.",
                            icon: "info",
                            buttonsStyling: false,
                            confirmButtonText: "{{ __('Yes') }}",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    var handleRestoreRows = () => {
        const restoreButtons = document.querySelectorAll('[data-kt-user-table-filter="restore_row"]');

        restoreButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                const url = $(this).data('remote');
                const parent = e.target.closest('tr');
                const customerName = parent.querySelectorAll('td')[1].innerText;

                Swal.fire({
                    text: "{{ __('Are you sure want to restore') }} " + customerName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "{{ __('Yes') }}, {{ __('restore') }}!",
                    cancelButtonText: "{{ __('No') }}, {{ __('cancel') }}",
                    customClass: {
                        confirmButton: "btn fw-bold btn-success",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: "PUT",
                            headers: {
                                'Authorization': 'Bearer {{session('bearer_token')}}',
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            success: function (resp) {
                                Swal.fire({
                                    text: "{{ __(ucwords(Request::segment(2))) }} " + "{{ __('Restored') }}",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Yes') }}",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    dt.draw();
                                });
                            }
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: customerName + " {{ __('Not restored') }}.",
                            icon: "info",
                            buttonsStyling: false,
                            confirmButtonText: "{{ __('Yes') }}",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = function () {
        const container = document.querySelector('#kt_datatable_example_1');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        const deleteSelected = document.querySelector('[data-kt-user-table-select="delete_selected"]');

        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        if (deleteSelected) {
            deleteSelected.addEventListener('click', function () {
                var selectedId = [];
                var checkbox = $('[type="checkbox"]:checked');
                checkbox.each(function (key, items, data) {
                    if ($(items).val() != 'on') selectedId.push($(items).val());
                });

                var selectedList = selectedId.join(",");

                Swal.fire({
                    text: "{{ __('Are you sure want to permanently delete selected rows') }} ?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "{{ __('Yes, delete permanently') }}!",
                    cancelButtonText: "{{ __('No, Cancel') }}",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    },
                }).then(function (result) {
                    if (result.value) {
                        const url = `{{ url('api/admin/'.Request::segment(2)) }}/${selectedList}`;
                        $.ajax({
                            url: url,
                            type: "POST",
                            headers: {
                                'Authorization': 'Bearer {{session('bearer_token')}}',
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            success: function (resp) {
                                Swal.fire({
                                    text: "{{ __('Selected rows permanently deleted') }}!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Yes') }}",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    dt.draw();
                                });

                                const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                                headerCheckbox.checked = false;
                            }
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "{{ __('Rows are not deleted') }}!",
                            icon: "info",
                            buttonsStyling: false,
                            confirmButtonText: "{{ __('Yes') }}",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            });
        }
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#kt_datatable_example_1');
        const toolbarBase = document.querySelector('[data-kt-user-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-user-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-user-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            handleDeleteRows();
            handleRestoreRows();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
    </script>
@endsection 