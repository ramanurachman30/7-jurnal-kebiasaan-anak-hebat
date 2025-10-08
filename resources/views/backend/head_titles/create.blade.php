@extends('skeleton')

@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card card-flush h-md-100">
            <div class="card-header">
            </div>
            <div class="pt-6 card-body">
                <form action="{{ url('admin/'. Request::segment(2)) }}" method="POST" id="createform" enctype="multipart/form-data">
                    @csrf
                    @foreach ($forms as $form)
                        <div class="mb-8 form-group row">
                            <div class="col-xl-2 col-lg-2 col-form-label text-start">
                                <label
                                    class="{{ isset($form['required']) && $form['required'] == true ? 'required' : '' }} form-label">{{ __($form['label']) }}</label>
                            </div>
                            @component('_forms.' . $form['type'], ['data' => $form])
                            @endcomponent
                        </div>
                    @endforeach
                </form>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ __(url('admin/'. Request::segment(2))) }}" type="button" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('Cancel') }}
                </a>
                <div class="d-flex">
                    <button type="button" id="kt_btn_1" class="btn btn-primary btn-submit"
                        onclick="$('#createform').submit()">
                        <i class="fas fa-save"></i>
                        <span class="indicator-label">{{ __('Submit') }}</span>
                        <span class="indicator-progress">{{ __('Please wait') }} ...
                            <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
    <script src="{{ asset('assets/js/custom/pages/content/selectByLang.js') }}"></script>
@endsection
