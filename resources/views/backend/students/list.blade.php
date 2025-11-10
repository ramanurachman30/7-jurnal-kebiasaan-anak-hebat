@extends('skeleton')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="datatable-url" content="{{ url('api/admin/' . Request::segment(2) . '/datatable') }}">
    <meta name="first-segment" content="{{ url('admin/' . Request::segment(2)) }}">
    <meta name="first-segment-api" content="{{ url('api/admin/' . Request::segment(2)) }}">
    <meta name="permission"
        update="{{ Auth::allowedUri(Request::segment(2) . '.edit') ? 'true' : 'false' }}"
        trash="{{ Auth::allowedUri(Request::segment(2) . '.trash') ? 'true' : 'false' }}">
@endsection

@section('toolbar')
    @if (Auth::allowedUri(url('admin/' . Request::segment(2) . '/trashed')))
        <a href="{{ url('admin/' . Request::segment(2) . '/trashed') }}" class="btn btn-lg btn-light-youtube">
            <span class="svg-icon svg-icon-danger svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                    <g fill="none" fill-rule="evenodd">
                        <rect width="24" height="24" />
                        <path
                            d="M6,8 L18,8 L17.106535,19.615 C17.04642,20.3965 16.3948,21 15.611,21 L8.389,21 C7.605,21 6.9536,20.3965 6.8935,19.615 L6,8 Z"
                            fill="currentColor" />
                        <path
                            d="M14,4.5 L14,3.5 C14,3.2239 13.7761,3 13.5,3 L10.5,3 C10.2239,3 10,3.2239 10,3.5 L10,4.5 L5.5,4.5 C5.2239,4.5 5,4.7239 5,5 L5,5.5 C5,5.7761 5.2239,6 5.5,6 L18.5,6 C18.7761,6 19,5.7761 19,5.5 L19,5 C19,4.7239 18.7761,4.5 18.5,4.5 L14,4.5 Z"
                            fill="currentColor" opacity="0.3" />
                    </g>
                </svg>
            </span>
            {{ __('Trash') }}
        </a>
    @endif
@endsection

@section('content')
    @php
        $column = [['data' => 'id']];
    @endphp

    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card card-flush h-md-100">
            <div class="card-header pt-7">
                {{-- Toolbar utama --}}
                <div class="row align-items-end g-3" data-kt-user-table-toolbar="base">
                    <div class="col-md-3">
                        <label>Dari Tanggal:</label>
                        <input type="date" id="startDate" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label>Sampai Tanggal:</label>
                        <input type="date" id="endDate" class="form-control" />
                    </div>
                    <div class="col-md-2">
                        <button id="filterBtn" class="btn btn-primary w-100">Filter</button>
                    </div>

                    <!-- 🔹 Container export -->
                    <div class="col-md-2 {{ auth()->user()->role == 2 ? 'd-none' : '' }}" id="exportContainer"></div>

                    <!-- 🔹 Tombol Add sejajar -->
                    <div class="col-md-6 text-end">
                        <a href="{{ url('admin/' . Request::segment(2) . '/create') }}" 
                            class="btn btn-primary {{ auth()->user()->role == 1 ? 'd-none' : '' }}">
                            <span class="svg-icon svg-icon-2 me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                        transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                    <rect x="4.364" y="11.364" width="16" height="2" rx="1"
                                        fill="currentColor" />
                                </svg>
                            </span>{{ __('Add') }} {{ __(humanizeSegmentName($segmentName)) }}
                        </a>
                    </div>
                </div>

                {{-- Toolbar ketika ada checkbox yang dipilih --}}
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                    <div class="fw-bold me-3">
                        <span data-kt-user-table-select="selected_count">0</span> {{ __('Selected') }}
                    </div>
                    <button type="button" class="btn btn-danger" id="deleteSelected">
                        {{ __('Delete Selected') }}
                    </button>
                </div>
            </div>

            {{-- Table --}}
            <div class="card-body pt-6">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                        id="kt_datatable_example_1">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2"></th>
                                @foreach ($forms as $key => $items)
                                    @if ($items['display'])
                                        <th class="text-nowrap">{{ __($items['label']) }}</th>
                                        @php
                                            $column[] = $items['type'] == 'sysparam'
                                                ? ['data' => $items['name'] . '.' . $items['options']['display']]
                                                : ['data' => $items['name']];
                                        @endphp
                                    @endif
                                @endforeach
                                @php $column[] = ['data' => null]; @endphp
                                <th class="text-end min-w-100px"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @php $columns = json_encode($column); @endphp
    <input type="hidden" name="data-columns" value="{{ $columns }}">
@endsection

@section('customjs')
<!-- ✅ DataTables Buttons JS dan dependencies -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- ✅ File export dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script>
"use strict";

var KTDatatablesServerSide = function () {
    var dt;
    var searchAdvance = [];

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
                url: "{{ url('api/admin/' . Request::segment(2) . '/dataTableMurid') }}",
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer {{ session('bearer_token') ?? '' }}',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (data) {
                    data.start_date = $('#startDate').val();
                    data.end_date = $('#endDate').val();
                    data.params = searchAdvance;
                    data.search = data.search.value;
                },
                complete: function () {
                    $("#kt_datatable_example_1").find("th:first-child").removeClass("sorting_asc");
                }
            },
            columns: @json($column),
            columnDefs: [{
                targets: 0,
                orderable: false,
                render: function (data) {
                    return "";
                }
            },
            {
                targets: -1,
                data: null,
                orderable: false,
                className: 'text-end',
                render: function (data, type, row) {
                console.log(data);
                
                    let action = `
                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" 
                            data-kt-menu-trigger="click" 
                            data-kt-menu-placement="bottom-end" 
                            data-kt-menu-flip="top-end">
                            {{ __('Action') }}
                            <span class="m-0 svg-icon svg-icon-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                    <path d="M6.7,15.7 C6.3,16.1 5.7,16.1 5.3,15.7 C4.9,15.3 4.9,14.7 5.3,14.3 L11.3,8.3 C11.7,7.9 12.3,7.9 12.7,8.3 L18.7,13.8 C19.1,14.1 19.1,14.8 18.7,15.2 C18.4,15.6 17.7,15.6 17.3,15.2 L12,10.4 L6.7,15.7 Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </a>
                        <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 
                            menu-state-bg-light-primary fw-bold fs-7 w-150px" data-kt-menu="true">
                            <div class="px-3 menu-item">
                                <a href="#" 
                                   class="px-3 menu-link naik-kelas-btn" 
                                   data-id="${row.id}" 
                                   data-name="${row.name ?? ''}">
                                    {{ __('Naik Kelas') }}
                                </a>
                            </div>
                        </div>`;
                    return action;
                },
            }
        ],
        // ✅ Tambahkan DOM dan tombol export di sini
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Export Data - {{ ucfirst(Request::segment(2)) }} - ' + new Date().toLocaleDateString(),
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-success me-2'
            }
        ]
        });

        dt.buttons().container().appendTo('#exportContainer');

        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            if (typeof KTMenu !== 'undefined') KTMenu.createInstances();

            handleNaikKelasRows();
        });

        // 🔹 tombol filter: refresh tabel berdasarkan tanggal
        $('#filterBtn').click(function () {
            dt.ajax.reload();
        });

        // Tombol export (opsional)
        $('#exportBtn').click(function () {
            // Kamu bisa tambahkan URL export Excel dengan parameter tanggal di sini
            let start = $('#startDate').val();
            let end = $('#endDate').val();
            window.location.href = "{{ url('api/admin/' . Request::segment(2) . '/export') }}?start_date=" + start + "&end_date=" + end;
        });
    }

    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
        if (!filterSearch) return;
        filterSearch.addEventListener('keyup', e => dt.search(e.target.value).draw());
    }

    var initToggleToolbar = function () {
        const container = document.querySelector('#kt_datatable_example_1');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');
        checkboxes.forEach(c => {
            c.addEventListener('click', function () {
                setTimeout(toggleToolbars, 50);
            });
        });
    }

    var handleNaikKelasRows = function () {
        const naikKelasButtons = document.querySelectorAll('.naik-kelas-btn');

        naikKelasButtons.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                var table = $('#kt_datatable_example_1').DataTable();

                // ✅ Ambil data row tempat tombol ini berada
                var rowData = table.row($(this).closest('tr')).data();

                // ✅ Ambil field id dan name dari row data
                var id = rowData.id;
                var name = rowData.student_name ?? '';

                console.log(id);
                console.log(name);
                console.log(rowData);
                

                const url = `{{ url('api/admin/' . Request::segment(2)) }}/${id}/naikKelasPerMurid`;

                Swal.fire({
                    text: "{{ __('Kamu yakin untuk menaikkan ') }}" + " " + name + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "{{ __('Ya, Naikkan!') }}",
                    cancelButtonText: "{{ __('Batal') }}",
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
                                'Authorization': 'Bearer {{ session('bearer_token') ?? '' }}',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (resp) {
                                Swal.fire({
                                    text: name + " {{ __('berhasil dinaikkan ke kelas berikutnya!') }}",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "OK",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                }).then(function () {
                                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                                });
                            },
                            error: function () {
                                Swal.fire({
                                    text: "{{ __('Terjadi kesalahan saat memproses data.') }}",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                            }
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: name + " {{ __('tidak dinaikkan kelas.') }}",
                            icon: "info",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        });
                    }
                });
            });
        });
    };

    var toggleToolbars = function () {
        const container = document.querySelector('#kt_datatable_example_1');
        const toolbarBase = document.querySelector('[data-kt-user-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-user-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-user-table-select="selected_count"]');

        // Hindari error jika elemen belum tersedia
        if (!toolbarBase || !toolbarSelected || !selectedCount) return;

        const allCheckBoxes = container.querySelectorAll('tbody [type="checkbox"]');
        let count = 0;
        allCheckBoxes.forEach(c => { if (c.checked) count++; });

        if (count > 0) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
            handleNaikKelasRows();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
</script>
@endsection
