<div class="floating-banner">
    {{-- Diubah oleh Hanif --}}
    <div id="mydiv">
        <div id="mydivheader">
            <div class="floating-banner">
                @foreach ($floatingBanner as $floating)
                    @if (!empty($floating['image']) && is_array($floating['image']) && !empty($floating['link']))
                        <a href="{{ $floating['link'] }}" target="_blank">
                            <img src="{{ getImageUrl($floating['image']['mimetype'], $floating['image']['original_name']) }}"
                                alt="{{ $floating['image']['description'] }}" width="200" class="rounded-circle pulse">
                        </a>
                        <a href="#"
                            class="bottom-0 close-banner bg-red rounded-circle d-inline-block position-absolute end-0">
                            <img src="{{ asset('assets/frontend/image/close.png') }}" alt="Close" width="24"
                                height="24" class="m-2">
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/pages/floating-banners/jquery.draggableTouch.js') }}"></script>
    <script>
        $('.DraggableDiv').draggableTouch();
    </script>
