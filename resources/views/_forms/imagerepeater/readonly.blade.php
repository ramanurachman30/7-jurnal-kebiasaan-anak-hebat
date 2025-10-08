<div class="col-lg-9 col-xl-9">
    @if(isset($data['value']) && is_array($data['value']) && count($data['value']) > 0)
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">{{ __('Gallery Images') }} ({{ count($data['value']) }})</h5>
            <button type="button" class="btn btn-primary btn-sm" onclick="downloadAllImages()">
                <i class="fas fa-download"></i> {{ __('Download All Images') }}
            </button>
        </div>
        <div class="gallery-files-readonly">
            @foreach($data['value'] as $index => $item)
                <div class="border rounded p-3 mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            @if(isset($item['file']) && $item['file'])
                                <div class="text-center">
                                    <img src="{{ asset('storage/images/' . $item['file']) }}" alt="Gallery Image" class="img-thumbnail" style="max-width: 150px; max-height: 150px;" />
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/images/' . $item['file']) }}" target="_blank" class="btn btn-sm btn-light-primary me-2">
                                            <i class="fas fa-eye"></i> {{ __('View') }}
                                        </a>
                                        <a href="{{ asset('storage/images/' . $item['file']) }}" download="{{ $item['file'] }}" class="btn btn-sm btn-light-success">
                                            <i class="fas fa-download"></i> {{ __('Download') }}
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="text-center text-muted">
                                    <i class="fa fa-image" style="font-size: 48px;"></i>
                                    <p>No image</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <strong>{{ __('Image Description') }}:</strong>
                            <p>{{ $item['image_desc'] ?? __('No description') }}</p>
                            @if(isset($item['file']) && $item['file'])
                                <strong>{{ __('File') }}:</strong>
                                <p class="text-muted">{{ $item['file'] }}</p>
                                <strong>{{ __('File Size') }}:</strong>
                                <p class="text-muted">
                                    @php
                                        $filePath = public_path('storage/images/' . $item['file']);
                                        if (file_exists($filePath)) {
                                            echo number_format(filesize($filePath) / 1024, 2) . ' KB';
                                        } else {
                                            echo __('File not found');
                                        }
                                    @endphp
                                </p>
                            @endif
                            {{-- <div class="mt-3">
                                <strong>{{ __('Actions') }}:</strong><br>
                                @if(isset($item['file']) && $item['file'])
                                    <a href="{{ asset('storage/images/' . $item['file']) }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-external-link-alt"></i> {{ __('Open in New Tab') }}
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-success" onclick="downloadImage('{{ asset('storage/images/' . $item['file']) }}', '{{ $item['file'] }}')">
                                        <i class="fas fa-download"></i> {{ __('Download Image') }}
                                    </button>
                                @endif
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-muted">
            <p>{{ __('No gallery images uploaded') }}</p>
        </div>
    @endif
</div>

<script>
// Store gallery images data for download all functionality
window.galleryImages = [
    @if(isset($data['value']) && is_array($data['value']))
        @foreach($data['value'] as $index => $item)
            @if(isset($item['file']) && $item['file'])
            {
                url: '{{ asset('storage/images/' . $item['file']) }}',
                filename: '{{ $item['file'] }}',
                description: '{{ addslashes($item['image_desc'] ?? '') }}'
            }{{ !$loop->last ? ',' : '' }}
            @endif
        @endforeach
    @endif
];

function downloadImage(imageUrl, filename) {
    // Create a temporary anchor element to trigger download
    const link = document.createElement('a');
    link.href = imageUrl;
    link.download = filename;
    link.style.display = 'none';
    
    // Add to DOM, click, and remove
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Download all images with a delay between downloads
function downloadAllImages() {
    if (!window.galleryImages || window.galleryImages.length === 0) {
        alert('{{ __('No images to download') }}');
        return;
    }
    
    if (confirm('{{ __('Download all') }} ' + window.galleryImages.length + ' {{ __('images? This may take a moment.') }}')) {
        let downloadCount = 0;
        const totalImages = window.galleryImages.length;
        
        // Show progress (optional)
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        
        window.galleryImages.forEach((image, index) => {
            setTimeout(() => {
                downloadImage(image.url, image.filename);
                downloadCount++;
                
                // Update button text to show progress
                button.innerHTML = `<i class="fas fa-spinner fa-spin"></i> ${downloadCount}/${totalImages}`;
                
                // Reset button when done
                if (downloadCount === totalImages) {
                    setTimeout(() => {
                        button.innerHTML = originalText;
                    }, 1000);
                }
            }, index * 500); // 500ms delay between downloads
        });
    }
}

// Alternative download method using fetch for better browser compatibility
function downloadImageWithFetch(imageUrl, filename) {
    fetch(imageUrl)
        .then(response => response.blob())
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = filename;
            link.style.display = 'none';
            
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Clean up the object URL
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.error('Error downloading image:', error);
            // Fallback to direct link
            window.open(imageUrl, '_blank');
        });
}
</script>
