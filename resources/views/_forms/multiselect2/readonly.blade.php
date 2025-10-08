<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <select
        class="form-select"
        data-control="select2" data-placeholder="{{ __('Select') }} {{ $data['name'] }}"
        name="{{ __($data['name']) }}[]"
        readonly
    >
    <option></option>
    @foreach($data['options'] as $key => $items)
        <option value="{{ __($key) }}" {{ isset($data['value']) && $data['value'] == $key || old($data['name']) == $key ? 'selected' : '' }}>{{ __($items) }}</option>
    @endforeach
    </select>
</div>