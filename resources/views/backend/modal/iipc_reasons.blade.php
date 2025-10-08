<form action="#" id="modalForm" method="POST">
    <div class="mb-8 form-group row">
        <div class="col-xl-2 col-lg-2 col-form-label text-start">
            <label class="required form-label">{{ __('Title') }}</label>
        </div>
        @component('_forms.text', ['data' => ['name' => 'reason_title', 'label' => 'Title']])
        @endcomponent
    </div>
    <div class="mb-8 form-group row">
        <div class="col-xl-2 col-lg-2 col-form-label text-start">
            <label class="required form-label">{{ __('Descriptions') }}</label>
        </div>
        @component('_forms.textarea', ['data' => ['name' => 'description', 'label' => 'Descriptions']])
        @endcomponent
    </div>
    <div class="p-0 ml-0 mr-0 modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-light close-modal" data-bs-dismiss="modal">
            <i class="fas fa-close"></i> {{ __('Close') }}
        </button>
        <button type="submit" class="btn btn-primary btn-submit">
            <i class="fas fa-save"></i>
            <span class="indicator-label">{{ __('Save Changes') }}</span>
            <span class="indicator-progress">{{ __('Please wait') }} ...
                <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
        </button>
    </div>
</form>

@section('customjs')
    <script src="{{ asset('assets/plugins/global/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/pages/iipc_reasons/modal.js') }}"></script>
@endsection
