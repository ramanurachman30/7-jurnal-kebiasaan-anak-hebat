/**
 * MultiThumbnailManager.js
 * A completely new implementation for handling multiple image thumbnails
 * with add and delete functionality.
 */

var MultiThumbnailManager = function () {
    console.log('masuk sini minimal')
    // Configuration options
    var config = {
        containerSelector: '.multi-thumbnail-container',
        listSelector: '.multi-thumbnails-list',
        addButtonSelector: '.btn-add-multi-thumbnail',
        deleteButtonSelector: '.btn-delete-multi-thumbnail',
        thumbnailWrapperClass: 'multi-thumbnail-wrapper',
        inputNamePrefix: 'image_content',
        defaultImage: '/assets/media/avatars/blank.png',
        uploadUrl: '/api/v1/file_upload',
        bucket: 'avatar',
        path: 'avatar',
        assetUrl: '',
        storageUrl: '/storage/'
    };
    
    // Private functions
    var _initThumbnails = function(container) {
        var thumbnailInputs = container.find('.multi-thumbnail-input');
        console.log('thumbnailInputs', thumbnailInputs);
        thumbnailInputs.each(function() {
            _initSingleThumbnail($(this));
        });
    };
    
    var _getAssetUrl = function(path) {
        // If assetUrl is defined, use it, otherwise use relative path
        return config.assetUrl ? config.assetUrl + path : path;
    };
    
    var _getStorageUrl = function(filename) {
        return config.storageUrl + config.path + '/' + filename;
    };
    
    var _initSingleThumbnail = function(thumbnailInput) {
        // Skip if already initialized
        if (thumbnailInput.data('initialized')) {
            return;
        }
        
        // Mark as initialized
        thumbnailInput.data('initialized', true);
        
        // Set up existing image if available
        var hiddenInput = thumbnailInput.find('input[type="hidden"]');
        var value = hiddenInput.val();
        
        if (value && value !== '') {
            try {
                var data = JSON.parse(value);
                var imageUrl = _getStorageUrl(data.filename);
                thumbnailInput.find('.multi-image-wrapper').css('background-image', 'url(' + imageUrl + ')');
                thumbnailInput.removeClass('image-input-empty').addClass('image-input-changed');
            } catch (e) {
                console.error('Error parsing thumbnail data:', e);
            }
        }
        
        // Set up file input change handler
        thumbnailInput.find('input[type="file"]').on('change', function() {
            var fileInput = $(this);
            var files = fileInput.get(0).files;
            var wrapper = thumbnailInput;
            
            if (files.length === 0) {
                return;
            }
            
            // Start spinner
            _startSpinner(wrapper);
            
            // Get upload URL with bucket if specified
            var uploadUrl = config.uploadUrl;
            if (config.bucket) {
                uploadUrl += '?bucket=' + config.bucket;
            }
            
            // Upload file
            _uploadFile(files, uploadUrl, function(response, error) {
                _stopSpinner(wrapper);
                
                if (error) {
                    Swal.fire({
                        text: error.statusText || 'Upload failed',
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "OK",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                    return;
                }
                
                if (response && response.length > 0) {
                    // Update hidden input with file data
                    hiddenInput.val(JSON.stringify(response[0]));
                    
                    // Update image preview
                    var imageUrl = _getStorageUrl(response[0].filename);
                    wrapper.find('.multi-image-wrapper').css('background-image', 'url(' + imageUrl + ')');
                    wrapper.removeClass('image-input-empty').addClass('image-input-changed');
                }
            });
        });
    };
    
    var _createNewThumbnail = function(container, index) {
        var defaultImageUrl = _getAssetUrl(config.defaultImage);
        
        var html = `
            <div class="col">
                <div class="${config.thumbnailWrapperClass}">
                    <div class="d-flex align-items-center">
                        <div class="image-input image-input-empty multi-thumbnail-input" data-kt-image-input="true"
                             style="background-image: url(${defaultImageUrl})">
                            <div class="multi-image-wrapper w-125px h-125px"></div>
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                   data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change Image">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="hidden" name="${config.inputNamePrefix}[${index}]" value="" />
                                <input type="file" accept=".png, .jpg, .jpeg" />
                            </label>
                            <span class="spinner-border spinner-border-sm text-primary position-absolute top-50 start-50 translate-middle" style="display: none;"></span>
                        </div>
                        <button type="button" class="${config.deleteButtonSelector.substring(1)} btn btn-icon btn-danger ms-3">
                            <i class="bi bi-trash-fill fs-7"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        // Insert before the "Add New" placeholder
        var addButtonCol = container.find('.multi-thumbnail-wrapper-add').closest('.col');
        $(html).insertBefore(addButtonCol);
        
        var newThumbnail = addButtonCol.prev().find('.multi-thumbnail-input');
        _initSingleThumbnail(newThumbnail);
        
        return newThumbnail;
    };
    
    var _uploadFile = function(files, url, callback) {
        // Create FormData
        var formData = new FormData();
        for (var i = 0; i < files.length; i++) {
            formData.append(files[i].name, files[i]);
        }
        
        // Add CSRF token if available
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        if (csrfToken) {
            formData.append('_token', csrfToken);
        }
        
        // Bearer token if available
        var bearerToken = $('meta[name="token"]').attr('content') || '';
        
        // Headers
        var headers = {};
        if (bearerToken) {
            headers['Authorization'] = 'Bearer ' + bearerToken;
        }
        
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: url,
            headers: headers,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (callback) {
                    callback(response, null);
                }
            },
            error: function(error) {
                if (callback) {
                    callback(null, error);
                }
            }
        });
    };
    
    var _startSpinner = function(wrapper) {
        wrapper.find('.spinner-border').show();
    };
    
    var _stopSpinner = function(wrapper) {
        wrapper.find('.spinner-border').hide();
    };
    
    var _initAddButton = function() {
        $(document).on('click', config.addButtonSelector, function() {
            var container = $(this).closest(config.containerSelector);
            var index = container.find('.' + config.thumbnailWrapperClass).length;
            _createNewThumbnail(container, index);
        });
    };
    
    var _initDeleteButton = function() {
        $(document).on('click', config.deleteButtonSelector, function() {
            var button = $(this);
            var wrapper = button.closest('.' + config.thumbnailWrapperClass);
            
            Swal.fire({
                text: "Are you sure you want to delete this image?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function(result) {
                if (result.value) {
                    wrapper.closest('.col').remove();
                    // Reindex the remaining thumbnails to maintain sequential indices
                    _reindexThumbnails(button.closest(config.containerSelector));
                }
            });
        });
    };
    
    var _reindexThumbnails = function(container) {
        var wrappers = container.find('.' + config.thumbnailWrapperClass);
        wrappers.each(function(index) {
            var hiddenInput = $(this).find('input[type="hidden"]');
            var currentName = hiddenInput.attr('name');
            // Only update the index part of the name
            var newName = config.inputNamePrefix + '[' + index + ']';
            hiddenInput.attr('name', newName);
        });
    };
    
    // Public methods
    return {
        // Initialize
        init: function(options) {
            // Merge options with defaults
            if (options) {
                config = {...config, ...options};
            }
            
            // Initialize containers
            $(config.containerSelector).each(function() {
                _initThumbnails($(this));
            });
            
            // Initialize add button event
            _initAddButton();
            
            // Initialize delete button event
            _initDeleteButton();
        },
        
        // Custom initialization for dynamically added containers
        initContainer: function(container, options) {
            var localConfig = {...config};
            
            // Merge options with defaults
            if (options) {
                localConfig = {...localConfig, ...options};
            }
            
            _initThumbnails(container);
        },
        
        // Add a new thumbnail to a specific container
        addThumbnail: function(container) {
            var index = container.find('.' + config.thumbnailWrapperClass).length;
            return _createNewThumbnail(container, index);
        },
        
        // Update configuration
        updateConfig: function(options) {
            config = {...config, ...options};
        },
        
        // Get current configuration
        getConfig: function() {
            return {...config};
        }
    };
}();

// Initialize when document is ready
jQuery(document).ready(function() {
    // Initialize with your site-specific configuration
    MultiThumbnailManager.init({
        // You can override any of the default config options here
        assetUrl: window.location.origin, // Or provide your specific asset URL base
        uploadUrl: window.location.origin + '/api/file_upload'
    });
});