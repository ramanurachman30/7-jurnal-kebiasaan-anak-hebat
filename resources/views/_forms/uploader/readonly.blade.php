<div class="col-lg-3 col-xl-3">
    <div class="overflow-hidden card">
        <div class="p-0 card-body">
            <?php 
                $value = "";
                $fileIcon = asset('assets/media/icons/duotune/files/fil004.svg'); // Default icon for no file
                if(isset($data['value'])) {
                    $ext = explode('/', $data['value']['mimetype']);
                    $value = asset('storage/file') .'/'.  $ext[1] . '/' . $data['value']['original_name'];
                    $fileIcon = asset('assets/media/icons/duotune/files/fil003.svg'); // Icon when file exists
                }
            ?>
            <div class="overlay-wrapper">
                @if(empty($value))
                    <img src="{{ $fileIcon }}" class="h-100px me-10"/>
                @else
                    <a href="{{ $value }}" target="_blank">
                        <img src="{{ $fileIcon }}" class="h-100px me-10"/>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
