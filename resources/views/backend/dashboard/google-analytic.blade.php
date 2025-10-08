@extends('skeleton')

@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card shadow-sm" id="#kt_tab_pane_1">
                    <div class="card-header border-0 pt-6">
                        <div class="my-1 d-flex align-items-center position-relative">
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
                            <input type="text" data-kt-user-table-filter="search"
                                class="form-control form-control-solid w-250px ps-14"
                                placeholder="{{ __('Search Page Title') }}" />
                        </div>
                        <div class="card-toolbar">
                            {{-- <button type="button" class="btn btn-sm btn-light">
                            Filter
                        </button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped border table-rounded gy-7 gs-7" id="google-analityc">
                                <thead>
                                    <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                        <th class="text-nowrap">{{ __('Page Title') }}</th>
                                        <th class="text-nowrap">{{ __('Date') }}</th>
                                        <th class="text-nowrap">{{ __('Active Users') }}</th>
                                        <th class="text-nowrap">{{ __('Screen Page Views') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Title</h3>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-sm btn-light">
                            Action
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="container"></div>
                </div>
                <div class="card-footer">
                    Footer
                </div>
            </div>
        </div> --}}
        </div>
    </div>
@endsection

@section('customjs')
    <script src="{{ asset('assets/js/custom/pages/dashboard/dataTable.js') }}"></script>
    {{-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    $(function(){
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Corn vs wheat estimated production for 2020',
                align: 'left'
            },
            subtitle: {
                text:
                    'Source: <a target="_blank" ' +
                    'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
                align: 'left'
            },
            xAxis: {
                categories: ['USA', 'China', 'Brazil', 'EU', 'India', 'Russia'],
                crosshair: true,
                accessibility: {
                    description: 'Countries'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '1000 metric tons (MT)'
                }
            },
            tooltip: {
                valueSuffix: ' (1000 MT)'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'Corn',
                    data: [406292, 260000, 107000, 68300, 27500, 14500]
                },
                {
                    name: 'Wheat',
                    data: [51086, 136000, 5500, 141000, 107180, 77000]
                }
            ]
        });
    });
</script> --}}
@endsection
