{{-- <div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <div class="multi-thumbnail-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="font-weight-bold">{{ isset($data['label']) ? $data['label'] : 'Images' }}</h4>
        </div>
        
        @php
            $thumbnails = [];
            $inputName = isset($data['name']) ? $data['name'] : 'image_content';
            
            // Check if we have existing thumbnails
            if (isset($data['value'])) {
                if (is_string($data['value']) && !empty($data['value'])) {
                    // Single value
                    $thumbnails[] = $data['value'];
                } elseif (is_array($data['value'])) {
                    // Multiple values
                    $thumbnails = array_filter($data['value'], function($item) {
                        return !empty($item);
                    });
                }
            } elseif (old($inputName)) {
                if (is_string(old($inputName)) && !empty(old($inputName))) {
                    $thumbnails[] = old($inputName);
                } elseif (is_array(old($inputName))) {
                    $thumbnails = array_filter(old($inputName), function($item) {
                        return !empty($item);
                    });
                }
            }
            
            // If no thumbnails exist, add at least one empty thumbnail
            if (empty($thumbnails)) {
                $thumbnails[] = '';
            }
        @endphp
        
        <div class="multi-thumbnails-list">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                @foreach($thumbnails as $index => $thumbnail)
                <div class="col">
                    <div class="multi-thumbnail-wrapper">
                        <div class="d-flex align-items-center">
                            <div class="image-input image-input-empty multi-thumbnail-input" data-kt-image-input="true"
                                style="background-image: url('{{ asset('assets/media/avatars/blank.png') }}')">
                                <div class="multi-image-wrapper w-125px h-125px"></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change Image">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="hidden" name="{{ $inputName }}[{{ $index }}]" value="{{ $thumbnail }}" />
                                    <input type="file" accept=".png, .jpg, .jpeg" />
                                </label>
                                <span class="spinner-border spinner-border-sm text-primary position-absolute top-50 start-50 translate-middle" style="display: none;"></span>
                            </div>
                            @if($index > 0 || count($thumbnails) > 1)
                            <button type="button" class="btn-delete-multi-thumbnail btn btn-icon btn-danger ms-3">
                                <i class="bi bi-trash-fill fs-7"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- Add New Button as a Thumbnail -->
                <div class="col">
                    <div class="multi-thumbnail-wrapper-add h-100">
                        <div class="add-thumbnail-placeholder w-125px h-125px border border-dashed border-gray-300 d-flex flex-column align-items-center justify-content-center cursor-pointer btn-add-multi-thumbnail">
                            <i class="bi bi-plus-circle fs-2 text-primary mb-2"></i>
                            <span class="text-gray-600 fs-7">Add New Image</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if (isset($data['name']) && $errors->has($data['name']))
            <div class="fv-plugins-message-container invalid-feedback">
                <div data-field="{{ $data['name'] }}" data-validator="notEmpty">{{ $errors->first($data['name']) }}</div>
            </div>
        @endif
    </div>
</div> --}}
<div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
    <div class="multi-thumbnail-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="font-weight-bold">{{ isset($data['label']) ? $data['label'] : 'Images' }}</h4>
        </div>
        
        @php
            $thumbnails = [];
            $inputName = isset($data['name']) ? $data['name'] : 'image_content';
            
            // Check if we have existing thumbnails
            if (isset($data['value'])) {
                if (is_string($data['value']) && !empty($data['value'])) {
                    // Single value
                    $thumbnails[] = $data['value'];
                } elseif (is_array($data['value'])) {
                    // Multiple values - filter out empty values
                    $thumbnails = array_filter($data['value'], function($item) {
                        return !empty($item);
                    });
                }
            } elseif (old($inputName)) {
                if (is_string(old($inputName)) && !empty(old($inputName))) {
                    $thumbnails[] = old($inputName);
                } elseif (is_array(old($inputName))) {
                    $thumbnails = array_filter(old($inputName), function($item) {
                        return !empty($item);
                    });
                }
            }
            
            // If no thumbnails exist, add at least one empty thumbnail
            if (empty($thumbnails)) {
                $thumbnails[] = '';
            }
        @endphp
        
        <div class="multi-thumbnails-list">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                @foreach($thumbnails as $index => $thumbnail)
                <div class="col">
                    <div class="multi-thumbnail-wrapper">
                        <div class="d-flex align-items-center">
                            @php
                                $backgroundImage = asset('assets/media/avatars/blank.png');
                                $imageClass = 'image-input-empty';
                                
                                if (!empty($thumbnail)) {
                                    // Check if it's a full URL or relative path
                                    if (str_starts_with($thumbnail, 'http')) {
                                        $backgroundImage = $thumbnail;
                                    } else {
                                        $backgroundImage = Storage::url($thumbnail);
                                    }
                                    $imageClass = 'image-input-changed';
                                }
                            @endphp
                            
                            <div class="image-input {{ $imageClass }} multi-thumbnail-input" data-kt-image-input="true"
                                style="background-image: url('{{ $backgroundImage }}')">
                                <div class="multi-image-wrapper w-125px h-125px"></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change Image">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <input type="hidden" name="{{ $inputName }}[{{ $index }}]" value="{{ $thumbnail }}" />
                                    <input type="file" accept=".png, .jpg, .jpeg" />
                                </label>
                                <span class="spinner-border spinner-border-sm text-primary position-absolute top-50 start-50 translate-middle" style="display: none;"></span>
                            </div>
                            @if($index > 0 || count($thumbnails) > 1)
                            <button type="button" class="btn-delete-multi-thumbnail btn btn-icon btn-danger ms-3">
                                <i class="bi bi-trash-fill fs-7"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- Add New Button as a Thumbnail -->
                <div class="col">
                    <div class="multi-thumbnail-wrapper-add h-100">
                        <div class="add-thumbnail-placeholder w-125px h-125px border border-dashed border-gray-300 d-flex flex-column align-items-center justify-content-center cursor-pointer btn-add-multi-thumbnail">
                            <i class="bi bi-plus-circle fs-2 text-primary mb-2"></i>
                            <span class="text-gray-600 fs-7">Add New Image</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if (isset($data['name']) && $errors->has($data['name']))
            <div class="fv-plugins-message-container invalid-feedback">
                <div data-field="{{ $data['name'] }}" data-validator="notEmpty">{{ $errors->first($data['name']) }}</div>
            </div>
        @endif
    </div>
</div>