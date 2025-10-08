@extends('skeleton')

@section('meta')
    <meta name="datatable-url" content="{{ url('api/' . env('API_VERSION') . '/' . Request::segment(1) . '/datatable') }}">
    <meta name="first-segment" content="{{ url(Request::segment(1)) }}" page-name="{{ Request::segment(1) }}">
    <meta name="first-segment-api" content="{{ url('api/' . env('API_VERSION') . '/' . Request::segment(1)) }}">
    <meta name="permission" update="{{ Auth::allowedUri(Request::segment(1) . '.edit') ? true : false }}"
        trash="{{ Auth::allowedUri(Request::segment(1) . '.trash') ? true : false }}">
@endsection

@section('toolbar')
    @if (Auth::allowedUri(Request::segment(1) . '.trashed'))
        <a href="{{ url(Request::segment(1) . '/trashed') }}" class="btn btn-lg btn-light-youtube">
            <span class="svg-icon svg-icon-danger svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path
                            d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z"
                            fill="currentColor" fill-rule="nonzero" />
                        <path
                            d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
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
    <div class="card card-flush h-md-100">
        <div class="card-header pt-7">
            <div class="my-1 d-flex align-items-center position-relative">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <input type="text" data-kt-user-table-filter="search"
                    class="form-control form-control-solid w-350px ps-14 me-3"
                    placeholder="{{ __('Search') }} {{ __($segmentName) }}" />
                <a href="javascript:;" class="btn btn-icon btn-secondary switcher"
                    data-cookiename="{{ strtolower($segmentName) }}" data-switcher="card"
                    style="border-radius: 0.5em 0 0 0.5em" data-kt-table="card-view">
                    <i class="ki-duotone ki-element-2 fs-1"><span class="path1"></span><span class="path2"></span><span
                            class="path3"></span><span class="path4"></span></i>
                </a>
                <a href="javascript:;" class="btn btn-icon btn-secondary switcher"
                    data-cookiename="{{ strtolower($segmentName) }}" data-switcher="table"
                    style="border-radius: 0 0.5em 0.5em 0" data-kt-table="table-view">
                    <i class="ki-duotone ki-row-horizontal fs-1"><span class="path1"></span><span
                            class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                </a>
            </div>
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                @if (Auth::allowedUri(Request::segment(1) . '.create'))
                    <div>
                        <a href="{{ url(Request::segment(1) . '/create') }}" class="btn btn-primary">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                        transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                        fill="currentColor" />
                                </svg>
                            </span>{{ __('New Record') }}
                        </a>
                    </div>
                @endif
                <div class="me-0">
                    <button class="btn btn-lg btn-icon btn-bg-transparent btn-active-color-primary"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <span
                            class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Other1.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="currentColor" cx="12" cy="5" r="2" />
                                    <circle fill="currentColor" cx="12" cy="12" r="2" />
                                    <circle fill="currentColor" cx="12" cy="19" r="2" />
                                </g>
                            </svg><!--end::Svg Icon--></span>
                    </button>
                    <!--begin::Menu 3-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                        data-kt-menu="true">
                        <!--begin::Heading-->
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                Tools
                            </div>
                        </div>
                        <!--end::Heading-->
                        <div class="menu-item px-3">
                            <a href="javascript:;" data-remote="{{ url(Request::segment(1) . '/export') }}"
                                class="menu-link px-3" data-kt-export="all">
                                Export to Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-user-table-select="selected_count"></span>{{ __('Selected') }}
                </div>
                <button type="button" class="btn btn-danger"
                    data-kt-user-table-select="delete_selected">{{ __('Delete Selected') }}</button>
            </div>
        </div>
        <div class="card-body pt-6">
            <div class="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                        id="kt_datatable_example_1">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_datatable_example_1 .form-check-input" />
                                    </div>
                                </th>
                                @foreach ($forms as $key => $items)
                                    @if ($items['display'])
                                        <th class="text-nowrap">{{ __($items['label']) }}</th>
                                        @php
                                            $column[] = ['data' => $items['name']];
                                        @endphp
                                    @endif
                                @endforeach
                                @php
                                    $column[] = ['data' => null];
                                @endphp
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
    @php
        $columns = json_encode($column, true);
    @endphp
    <input type="hidden" name="data-columns" value="{{ $columns }}">
@endsection

@section('customjs')
    <script src="{{ asset('assets/js/custom/pages/event/dataTable.js') }}"></script>
@endsection
