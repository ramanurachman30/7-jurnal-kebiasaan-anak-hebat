@extends('skeleton')

@section('breadcrumbs')
    @foreach ($breadcrumbs as $key => $items)
        <!--begin::Item-->
        <li class="text-gray-600 breadcrumb-item">{{ __(ucwords(str_replace('_', ' ', $items))) }}
    @endforeach
@endsection

@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card card-flush h-md-100">
            <div class="pt-6 card-body">
            @section('forms')
                @php
                    $fieldRequired = [];
                @endphp
                <form action="{{ url('admin/'. Request::segment(2) . '/' . Request::segment(3)) }}" method="POST" id="updateform"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    @foreach ($forms as $form)
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
                <a href="{{ url('admin/'. Request::segment(2)) }}" type="button" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i>
                    {{ __('Cancel') }}
                </a>
                <button type="submit" id="kt_btn_1" class="btn btn-primary btn-submit"
                    onclick="$('#updateform').submit()">
                    <i class="fas fa-save"></i>
                    <span class="indicator-label">{{ __('Update') }}</span>
                    <span class="indicator-progress">{{ __('Please wait') }} ...
                        <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                </button>
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
