<form id="modalForm">
    @foreach ($forms as $form)
        @if ($form['hidden'])
            @continue
        @endif
        <div class="mb-8 form-group row">
            <div class="col-xl-2 col-lg-2 col-form-label text-start">
                <label
                    class="{{ isset($form['required']) && $form['required'] == true ? 'required' : '' }} form-label">{{ __($form['label']) }}</label>
            </div>
            @component('_forms.' . $form['type'], ['data' => $form])
            @endcomponent
        </div>
    @endforeach
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
