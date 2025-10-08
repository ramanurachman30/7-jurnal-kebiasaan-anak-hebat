<form action="{{ url()->current() }}" id="modalForm" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-8 form-group row">
        <h3>Are you sure want to set as draft ?</h3>
    </div>
    <div class="p-0 ml-0 mr-0 modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-light close-modal" data-bs-dismiss="modal">
            <i class="fas fa-close"></i> {{ __('Cancel') }}
        </button>
        <button type="submit" class="btn btn-primary btn-submit">
            <i class="fas fa-save"></i>
            <span class="indicator-label">{{ __('Yes, save as draft') }}</span>
            <span class="indicator-progress">{{ __('Please wait') }} ...
                <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
        </button>
    </div>
</form>