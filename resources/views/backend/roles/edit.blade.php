@extends('skeleton')

@section('breadcrumbs')
    @foreach ($breadcrumbs as $key => $items)
        <!--begin::Item-->
        <li class="text-gray-600 breadcrumb-item">{{ __($items) }}
    @endforeach
@endsection

@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card card-flush h-md-100">
            <div class="pt-6 card-body">
                <form action="{{ url('admin/'. Request::segment(2)) . '/' . Request::segment(3) }}" method="POST" id="createform">
                    @method('PUT')
                    @csrf
                    @foreach ($forms as $form)
                        <div class="mb-8 form-group row">
                            <div class="col-xl-2 col-lg-2 col-form-label">
                                <label
                                    class="{{ isset($form['required']) && $form['required'] == true ? 'required' : '' }} form-label">{{ __($form['label']) }}</label>
                            </div>
                            @component('_forms.' . $form['type'], ['data' => $form])
                            @endcomponent
                        </div>
                    @endforeach
                    <div class="accordion" id="kt_accordion_1">
                        @foreach ($priveleges as $key => $values)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="{{ str_replace(' ', '', $key) }}_1">
                                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#{{ str_replace(' ', '', $key) }}_body"
                                        aria-expanded="false" aria-controls="{{ str_replace(' ', '', $key) }}_body">
                                        {{ $key }}
                                    </button>
                                </h2>
                                <div id="{{ str_replace(' ', '', $key) }}_body" class="accordion-collapse collapse"
                                    aria-labelledby="{{ str_replace(' ', '', $key) }}_1" data-bs-parent="#kt_accordion_1">
                                    <div class="accordion-body">
                                        <div class="mb-8 form-group row gy-5">
                                            <?php $no = 1; ?>
                                            @foreach ($values as $k => $items)
                                                <div class="col-lg-4">
                                                    <div class="mb-5 card card-stretch card-bordered">
                                                        <div class="card-header">
                                                            <h3 class="card-title">{{ $k }}</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="mb-3 form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="select-all" onclick="toggle(this)" />
                                                                <label class="form-check-label" for="select-all">
                                                                    {{ __('Check All') }}
                                                                </label>
                                                            </div>
                                                            @foreach ($items as $v)
                                                                <div
                                                                    class="mb-3 form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $v['value'] }}"
                                                                        id="flexCheckDefault_{{ $no }}"
                                                                        name="priveleges[]"
                                                                        {{ in_array($v['value'], $permission) ? 'checked' : '' }} />
                                                                    <label class="form-check-label"
                                                                        for="flexCheckDefault_{{ $no }}">
                                                                        {{ $v['name'] }}
                                                                    </label>
                                                                </div>
                                                                <?php $no++; ?>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ __(url('admin/'. Request::segment(2))) }}" type="button" class="btn btn-light">{{ __('Cancel') }}</a>

                <button type="button" id="kt_btn_1" class="btn btn-primary btn-submit"
                    onclick="$('#createform').submit()">
                    <span class="indicator-label">{{ __('Submit') }}</span>
                    <span class="indicator-progress">{{ __('Please wait') }} ...
                        <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                </button>
                <!--end::Button-->
                <!--begin::Button-->
            </div>
        </div>
    </div>
@endsection
@section('customjs')
    <script src="{{ asset('assets/js/custom/pages/roles/toggle.js') }}"></script>
@endsection
