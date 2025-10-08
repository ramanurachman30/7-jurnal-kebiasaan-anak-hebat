<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <div class="row">
        <div class="col-lg-6">
            <input
                data-remote="{{ url('admin/'. Request::segment(2) . '/checkSlug') }}"
                type="text"
                name="{{ $data['name'] }}"
                class="form-control @if($errors->has($data['name'])) is-invalid @endif"
                placeholder="{{ __(isset($data['placeholder'])) ? __($data['placeholder']) : __($data['label']) }}"
                value="{{ isset($data['value']) ? $data['value'] : old($data['name']) }}"
            >
            @if ($errors->has($data['name']))
            <small id="form-error-{{$data['name']}}" class="form-text text-danger">
                {{ $errors->first($data['name']) }}
            </small>
            @endif
        </div>
        <div class="col-lg-6">
            <input
                type="text"
                name="{{ $data['type'] }}"
                class="form-control slug"
                placeholder="{{ $data['type'] }}"
                value="{{ !empty($data['value']) ? $data['value'] : old($data['type']) }}"
            >
            @if ($errors->has('slug'))
            <small id="form-error-{{ 'slug' }}" class="form-text text-danger">
                {{ $errors->first('slug') }}
            </small>
            @endif
        </div>
    </div>
</div>