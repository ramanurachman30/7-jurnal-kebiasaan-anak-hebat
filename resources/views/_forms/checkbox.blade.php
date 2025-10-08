<div class="col-lg-7 col-xl-7">
    {{-- Hidden input to ensure false value is sent when checkbox is unchecked --}}
    <input type="hidden" name="{{ $data['name'] }}" value="0">

    <div class="form-check form-switch form-check-custom form-check-solid">
        <input class="form-check-input" type="checkbox" name="{{ $data['name'] }}" id="{{ $data['name'] }}" value="1"
            {{ isset($data['value']) && $data['value'] == 1 ? 'checked' : '' }} />
        <label class="form-check-label" for="{{ $data['name'] }}">
            {{ isset($data['label']) ? __($data['label']) : '' }}
        </label>
    </div>

    @error($data['name'])
        <div class="fv-plugins-message-container invalid-feedback">
            <div class="fv-help-block">
                <span role="alert">{{ $message }}</span>
            </div>
        </div>
    @enderror

    @if (isset($data['info']))
        <div class="form-text">{{ __($data['info']) }}</div>
    @endif
</div>
