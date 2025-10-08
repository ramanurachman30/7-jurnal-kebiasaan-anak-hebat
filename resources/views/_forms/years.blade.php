<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <select
        class="form-select @if($errors->has($data['name'])) is-invalid @endif"
        data-control="select2" data-placeholder="{{ __('Select') }} {{ ucwords(str_replace("_", " ", $data['name'])) }}"
        name="{{ __($data['name']) }}"
    >
        <option></option>
        {{-- @foreach($data['options'] as $key => $items) --}}
            @for ($i=date('Y'); $i>=1945; $i--)
                <option value="{{ __($i) }}" {{ isset($data['value']) && $data['value'] == $i || old($data['name']) == $i ? 'selected' : '' }}>{{ __($i) }}</option>
            @endfor
        {{-- @endforeach --}}
    </select>
    @if ($errors->has($data['name']))
    <small id="form-error-{{$data['name']}}" class="form-text text-danger">
        {{ $errors->first($data['name']) }}
    </small>
    @endif
</div>
