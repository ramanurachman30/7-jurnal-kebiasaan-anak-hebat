@extends('skeleton')

@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card card-flush h-md-100">
            <div class="card-header">
            </div>
            <div class="pt-6 card-body">
            @section('forms')
                @php
                    $fieldRequired = [];
                @endphp
                <form action="{{ url('admin/'. Request::segment(2)) }}" method="POST" id="createform" enctype="multipart/form-data">
                    @csrf
                    @foreach ($forms as $form)
                        @if (isset($form['hidden']) && $form['hidden'] == true)
                            @continue
                        @endif
                        @php
                            if ($form['required']) {
                                $fieldRequired[$form['name']] = __($form['label']);
                            }
                        @endphp
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
            @show
        </div>
        @section('card-button')
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
        @show
    </div>
</div>
<input type="hidden" id="fieldRequired" value='@json($fieldRequired)' />
@endsection

@section('customjs')
<script src="{{ asset('assets/plugins/global/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/components/globalValidation.js') }}"></script>
@endsection
