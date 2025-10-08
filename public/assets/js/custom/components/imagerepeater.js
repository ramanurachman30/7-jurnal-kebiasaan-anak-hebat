/**
 * Image Repeater Component
 * Handles multiple image upload functionality for gallery files
 */
document.addEventListener('DOMContentLoaded', function() {
    
    // Gallery file index counter
    let galleryFileIndex = 0;
    
    // Initialize gallery file counters
    $('.gallery-files-container').each(function() {
        var maxIndex = 0;
        $(this).find('.gallery-file-item').each(function() {
            var currentIndex = parseInt($(this).data('index')) || 0;
            if (currentIndex > maxIndex) {
                maxIndex = currentIndex;
            }
        });
        galleryFileIndex = maxIndex + 1;
    });
    
    // Add gallery file button click handler
    $(document).on('click', '[id^="add_gallery_file_"]', function(e) {
        e.preventDefault();
        
        var container = $(this).closest('.gallery-files-container');
        var filesList = container.find('.gallery-files-list');
        
        // Create new gallery file item
        var newItem = `
            <div class="gallery-file-item border rounded p-3 mb-3" data-index="${galleryFileIndex}">
                <div class="row">
                    <div class="col-md-5">
                        <label class="form-label">${translations.image || 'Image'}:</label>
                        <input type="file" name="gallery_files[${galleryFileIndex}][file]" class="form-control gallery-file-input" accept="image/*" />
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">${translations.imageDescription || 'Image Description'}:</label>
                        <textarea rows="3" name="gallery_files[${galleryFileIndex}][image_desc]" class="form-control" placeholder="${translations.imageDescription || 'Image Description'}"></textarea>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-sm btn-light-danger remove-gallery-file">
                            <i class="la la-trash-o"></i>${translations.delete || 'Delete'}
                        </button>
                    </div>
                </div>
                <div class="image-preview mt-2"></div>
            </div>
        `;
        
        // Append new item with animation
        var $newItem = $(newItem);
        $newItem.hide();
        filesList.append($newItem);
        $newItem.slideDown(300);
        
        galleryFileIndex++;
    });
    
    // Remove gallery file button click handler
    $(document).on('click', '.remove-gallery-file', function(e) {
        e.preventDefault();
        
        var item = $(this).closest('.gallery-file-item');
        var container = $(this).closest('.gallery-files-container');
        
        // Don't allow removing the last item if it's the only one
        if (container.find('.gallery-file-item').length <= 1) {
            // Reset the form instead
            item.find('input[type="file"]').val('');
            item.find('textarea').val('');
            item.find('.image-preview').empty();
            return;
        }
        
        if (confirm(translations.confirmDelete || 'Are you sure you want to delete this image?')) {
            item.slideUp(300, function() {
                $(this).remove();
            });
        }
    });

    // Handle file preview for uploads
    $(document).on('change', '.gallery-file-input', function() {
        var input = this;
        var container = $(input).closest('.gallery-file-item');
        var previewContainer = container.find('.image-preview');
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = `
                    <div class="mt-2">
                        <strong>${translations.preview || 'Preview'}:</strong><br>
                        <img src="${e.target.result}" class="img-thumbnail" style="max-width: 120px; max-height: 120px;" />
                    </div>
                `;
                previewContainer.html(preview);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.empty();
        }
    });
    
    // Set up translations
    window.translations = window.translations || {
        image: 'Image',
        imageDescription: 'Image Description', 
        delete: 'Delete',
        confirmDelete: 'Are you sure you want to delete this image?',
        preview: 'Preview'
    };
});
