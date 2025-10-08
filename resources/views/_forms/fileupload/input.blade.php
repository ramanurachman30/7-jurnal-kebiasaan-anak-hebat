<div class="col-lg-9 col-xl-9">
    <div class="row fileupload-content">
        <div class="col-lg-6">
            <div class="row">
                <div class="mb-3 col-lg-12">
                    <input type="file" name="{{ $data['name'] }}"
                        class="form-control fileupload @if ($errors->has($data['name'])) is-invalid @endif"
                        placeholder="{{ __(isset($data['placeholder'])) ? __($data['placeholder']) : __($data['label']) }}"
                        id="{{ $data['name'] }}_file">
                    @if ($errors->has($data['name']))
                        <small id="form-error-{{ $data['name'] }}" class="form-text text-danger">
                            {{ $errors->first($data['name']) }}
                        </small>
                    @endif
                </div>
                <div class="col-lg-12">
                    <textarea rows="5" name="{{ $data['name'] . '_desc' }}"
                        class="form-control @if ($errors->has($data['name'] . '_desc')) is-invalid @endif"
                        placeholder="{{ __($data['name']) . ' Description' }}">{{ isset($data['value']['description']) ? $data['value']['description'] : old($data['name'] . '_desc') }}</textarea>
                    @if ($errors->has($data['name'] . '_desc'))
                        <small id="form-error-{{ $data['name'] . '_desc' }}" class="form-text text-danger">
                            {{ $errors->first($data['name'] . '_desc') }}
                        </small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="px-4 text-center">
                <div class="overflow-hidden card overlay">
                    <div class="p-0 card-body">
                        <?php
                        $value = '#';
                        if (isset($data['value'])) {
                            $path = public_path('storage/image/origin') . '/' . $data['value']['original_name'];
                            if (file_exists($path)) {
                                // $value = 'data:'.$data['value']['mimetype'].';base64,' . base64_encode(file_get_contents($path));
                                $value = asset('storage/image/origin') . '/' . $data['value']['original_name'];
                            }
                        }
                        ?>
                        <div class="overlay-wrapper">
                            <img src="{{ $value }}" alt="" class="rounded w-100 preview" />
                        </div>
                        <div class="bg-opacity-25 overlay-layer bg-dark">
                            <a href="{{ $value }}" target="_blank"
                                class="btn btn-light-primary btn-shadow ms-2 preview-link">Image Preview</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
