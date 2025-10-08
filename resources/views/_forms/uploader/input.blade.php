<div class="col-lg-9 col-xl-9">
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="mb-3 col-lg-12">
                    <input
                        type="file"
                        name="{{ $data['name'] }}"
                        class="form-control @if($errors->has($data['name'])) is-invalid @endif"
                        placeholder="{{ __(isset($data['placeholder'])) ? __($data['placeholder']) : __($data['label']) }}"
                        id="{{ $data['name'] }}_file"
                    >
                    @if ($errors->has($data['name']))
                    <small id="form-error-{{$data['name']}}" class="form-text text-danger">
                        {{ $errors->first($data['name']) }}
                    </small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>