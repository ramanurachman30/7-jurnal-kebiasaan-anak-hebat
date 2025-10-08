<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <select
        class="form-select"
        data-model="{{ $data['options']['model'] }}"
        data-key="{{ $data['options']['key'] }}"
        data-display="{{ $data['options']['display'] }}"
        name="{{ __($data['name']) }}"
        readonly
    >
    @if(isset($data['value']))
    <option value="{{ $data['value'][$data['options']['key']] }}" selected>{{ $data['value'][$data['options']['display']] }}</option>
    @endif
    </select>
</div>