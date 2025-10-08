<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    {{-- <small class="text-danger text-nowrap">{{ isset($data['info']) ? $data['info'] : '' }}</small> --}}
    <input type="text" name="{{ $data['name'] }}"
        class="form-control @if ($errors->has($data['name'])) is-invalid @endif"
        placeholder="{{ isset($data['placeholder']) ? __($data['placeholder']) : __($data['label']) }}"
        value="{{ isset($data['value']) ? $data['value'] : old($data['name']) }}">
    @if ($errors->has($data['name']))
        <small id="form-error-{{ $data['name'] }}" class="form-text text-danger">
            {{ $errors->first($data['name']) }}
        </small>
    @endif
    @if (isset($data['info']))
        <div class="form-text">{{ $data['info'] }}</div>
    @endif
</div>
