<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <select class="form-select select2ajax" data-model="{{ $data['options']['model'] }}"
        data-key="{{ $data['options']['key'] }}" data-display="{{ $data['options']['display'] }}"
        @if (isset($data['options']['parent'])) data-parent="{{ $data['options']['parent'] }}"
        data-parent-field="{{ $data['options']['parent_field'] ?? 'id' }}"
        data-parent-source-field="{{ $data['options']['parent_source_field'] ?? 'id' }}" @endif
        data-placeholder="{{ __('Select') }} {{ ucwords(str_replace('_', ' ', $data['name'])) }}"
        name="{{ $data['name'] }}">

        @if (isset($data['value']))
            <option value="{{ $data['value'][$data['options']['key']] }}" selected>
                {{ $data['value'][$data['options']['display']] }}</option>
        @endif
    </select>
    @if ($errors->has($data['name']))
        <small id="form-error-{{ $data['name'] }}" class="form-text text-danger">
            {{ $errors->first($data['name']) }}
        </small>
    @endif
</div>
