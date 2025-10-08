<div class="col-lg-4 col-xl-4">
    @if (isset($data['value']))
        <div class="overflow-hidden card overlay">
            <div class="p-0 card-body">
                <div class="overlay-wrapper">
                    <img src="{{ getImageUrl($data['value']['mimetype'], $data['value']['original_name']) }}"
                        alt="" class="rounded w-100 preview" />
                    <figcaption class="text-center font-size-lg figure-caption">{{ $data['value']['description'] }}
                    </figcaption>
                </div>
                <div class="bg-opacity-25 overlay-layer bg-dark">
                    <?php
                    $value = '#';
                    if (isset($data['value'])) {
                        $value = getImageUrl($data['value']['mimetype'], $data['value']['original_name']);
                    }
                    ?>
                    <a href="{{ $value }}" target="_blank"
                        class="btn btn-light-primary btn-shadow ms-2 preview-link">
                        {{ __('Image Preview') }}
                    </a>
                </div>
            </div>
        </div>
    @else
        <span class="text-middle">{{ __('No Image') }}</span>
    @endif
</div>
