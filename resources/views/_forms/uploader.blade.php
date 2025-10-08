<div class="col-lg-9 col-xl-9">
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="mb-3 col-lg-12">
                    @if (isset($data['value']) && !empty($data['value']))
                        @php
                            $ext = explode('/', $data['value']['mimetype']);
                        @endphp
                        <div class="mb-3 form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1"
                                name="remove_{{ $data['name'] }}" />
                            <label class="form-check-label">
                                {{ __('File is exist, check this to remove file') }}
                            </label>
                            <span><a href="{{ asset('storage/file/' . $ext[1] . '/' . $data['value']['original_name']) }}"
                                    target="_blank"> &nbsp; See
                                    File</a></span>
                        </div>
                    @endif
                    <input type="file" name="{{ $data['name'] }}"
                        class="form-control fileupload @if ($errors->has($data['name'])) is-invalid @endif"
                        placeholder="{{ __(isset($data['placeholder'])) ? __($data['placeholder']) : __($data['label']) }}"
                        data-size="{{ isset($data['size']) ? $data['size'] : 5000000 }}" id="{{ $data['name'] }}_file"
                        accept="{{ isset($data['accept']) ? $data['accept'] : '*' }}" id="{{ $data['name'] }}_file">
                    @if ($errors->has($data['name']))
                        <small id="form-error-{{ $data['name'] }}" class="form-text text-danger">
                            {{ $errors->first($data['name']) }}
                        </small>
                    @endif
                    @if (isset($data['info']))
                        <div class="form-text">{{ $data['info'] }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
