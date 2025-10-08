<div class="col-lg-9 col-xl-9">
    <!--begin::Image Gallery Repeater-->
    <div id="gallery_files_container_{{ $data['name'] }}" class="gallery-files-container">
        <div class="gallery-files-list">
            @if(isset($data['value']) && is_array($data['value']) && count($data['value']) > 0)
                @foreach($data['value'] as $index => $item)
                    <div class="gallery-file-item border rounded p-3 mb-3" data-index="{{ $index }}">
                        <div class="row">
                            <div class="col-md-5">
                                <label class="form-label">{{ __('Image') }}:</label>
                                <input type="file" name="gallery_files[{{ $index }}][file]" class="form-control gallery-file-input" accept="image/*" />
                                <input type="hidden" name="gallery_files[{{ $index }}][existing_file]" value="{{ $item['file'] ?? '' }}" />
                                @if(isset($item['file']) && $item['file'])
                                    <div class="mt-2">
                                        <small class="text-muted">Current: {{ $item['file'] }}</small>
                                        <div class="mt-1">
                                            <img src="{{ asset('storage/images/' . $item['file']) }}" alt="Current Image" class="img-thumbnail" style="max-width: 80px; max-height: 80px;" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">{{ __('Image Description') }}:</label>
                                <textarea rows="3" name="gallery_files[{{ $index }}][image_desc]" class="form-control" placeholder="{{ __('Image Description') }}">{{ $item['image_desc'] ?? '' }}</textarea>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-sm btn-light-danger remove-gallery-file">
                                    <i class="la la-trash-o"></i>{{ __('Delete') }}
                                </button>
                            </div>
                        </div>
                        <div class="image-preview mt-2"></div>
                    </div>
                @endforeach
            @else
                <div class="gallery-file-item border rounded p-3 mb-3" data-index="0">
                    <div class="row">
                        <div class="col-md-5">
                            <label class="form-label">{{ __('Image') }}:</label>
                            <input type="file" name="gallery_files[0][file]" class="form-control gallery-file-input" accept="image/*" />
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">{{ __('Image Description') }}:</label>
                            <textarea rows="3" name="gallery_files[0][image_desc]" class="form-control" placeholder="{{ __('Image Description') }}"></textarea>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-sm btn-light-danger remove-gallery-file">
                                <i class="la la-trash-o"></i>{{ __('Delete') }}
                            </button>
                        </div>
                    </div>
                    <div class="image-preview mt-2"></div>
                </div>
            @endif
        </div>
        
        <div class="mt-3">
            <button type="button" id="add_gallery_file_{{ $data['name'] }}" class="btn btn-light-primary">
                <i class="la la-plus"></i>{{ __('Add Image') }}
            </button>
        </div>
    </div>
    <!--end::Image Gallery Repeater-->

    @if ($errors->has($data['name']))
    <small id="form-error-{{$data['name']}}" class="form-text text-danger">
        {{ $errors->first($data['name']) }}
    </small>
    @endif
</div>
