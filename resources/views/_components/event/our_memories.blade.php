<div class="mb-3">
    <label class="form-label fw-semibold fs-6">{{ $data['label'] ?? 'Upload Files' }}</label>

    <div class="row g-3" id="thumbnails-{{ $data['name'] }}">
        {{-- Existing thumbnails --}}
        @if(!empty($data['value']))
            @foreach($data['value'] as $img)
                <div class="col-4 col-md-3 position-relative thumb-item" data-file-id="existing-{{ $img['id'] }}">
                    <div class="border rounded p-1 h-100 d-flex align-items-center justify-content-center">
                        <img src="{{ $img['url'] }}" 
                             alt="{{ $img['name'] }}" 
                             class="img-fluid rounded" 
                             style="max-height:150px; object-fit:cover;">
                    </div>
                    <button type="button" 
                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" 
                            onclick="removeExistingThumb(this, {{ $img['id'] }})">✕</button>
                    {{-- hidden input supaya tetap terkirim --}}
                    <input type="hidden" name="existing_{{ $data['name'] }}[]" value="{{ $img['id'] }}">
                </div>
            @endforeach
        @endif

        {{-- Placeholder upload --}}
        <div class="col-4 col-md-3">
            <label class="border rounded d-flex flex-column align-items-center justify-content-center h-100 p-3"
                   style="cursor:pointer; min-height:150px;">
                <i class="bi bi-plus-lg fs-1"></i>
                <input type="file"
                       name="{{ $data['name'] }}[]"
                       class="fileupload-repeater d-none"
                       data-size="2097152"
                       accept="image/webp,image/jpeg,image/png,application/pdf"
                       onchange="previewThumbs(this, 'thumbnails-{{ $data['name'] }}')"
                       multiple>
            </label>
        </div>
    </div>

    {{-- Hidden container untuk menyimpan input file aktual --}}
    <div id="hidden-inputs-{{ $data['name'] }}" style="display: none;"></div>
</div>

<script>
let fileCounter = 0; // unique id counter

function previewThumbs(input, containerId) {
    const container = document.getElementById(containerId);
    const hiddenContainer = document.getElementById('hidden-inputs-' + containerId.replace('thumbnails-', ''));
    
    if (!input.files) return;

    Array.from(input.files).forEach(file => {
        const uniqueId = ++fileCounter;

        // Buat hidden input untuk file baru
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'file';
        hiddenInput.name = input.name;
        hiddenInput.style.display = 'none';
        hiddenInput.dataset.fileId = uniqueId;

        const dt = new DataTransfer();
        dt.items.add(file);
        hiddenInput.files = dt.files;

        hiddenContainer.appendChild(hiddenInput);

        // Buat thumbnail
        const reader = new FileReader();
        reader.onload = e => {
            const col = document.createElement('div');
            col.className = 'col-4 col-md-3 position-relative thumb-item';
            col.dataset.fileId = uniqueId;
            col.innerHTML = `
                <div class="border rounded p-1 h-100 d-flex align-items-center justify-content-center">
                    ${file.type.startsWith('image/')
                        ? `<img src="${e.target.result}" class="img-fluid rounded" style="max-height:150px; object-fit:cover;">`
                        : `<div class="text-center"><i class="bi bi-file-earmark-text fs-1"></i><p class="small mb-0">${file.name}</p></div>`
                    }
                </div>
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" onclick="removeThumb(this, ${uniqueId})">✕</button>
            `;
            container.insertBefore(col, container.lastElementChild);
        };
        reader.readAsDataURL(file);
    });

    input.value = '';
}

// Hapus thumbnail baru
function removeThumb(button, fileId) {
    const thumbItem = button.closest('.thumb-item');
    thumbItem.remove();

    const hiddenInput = document.querySelector(`input[data-file-id="${fileId}"]`);
    if (hiddenInput) hiddenInput.remove();
}

// Optional: Dapatkan semua file baru
function getSelectedFiles(fieldName) {
    const hiddenContainer = document.getElementById('hidden-inputs-' + fieldName);
    const inputs = hiddenContainer.querySelectorAll('input[type="file"]');
    const files = [];
    inputs.forEach(input => {
        if (input.files && input.files.length > 0) files.push(input.files[0]);
    });
    return files;
}

function removeExistingThumb(button, id) {
    const thumbItem = button.closest('.thumb-item');
    thumbItem.remove();

    // tambahkan hidden input untuk menandai file lama yang dihapus
    const removedInput = document.createElement('input');
    removedInput.type = 'hidden';
    removedInput.name = "removed_image_content[]"; // <--- ini penting
    removedInput.value = id;

    // append ke form utama
    const form = document.getElementById("editform"); // pastikan form punya id="createform"
    form.appendChild(removedInput);
}


</script>