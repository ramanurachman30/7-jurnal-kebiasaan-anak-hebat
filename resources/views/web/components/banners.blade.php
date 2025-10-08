<div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-800px">
    <div id="kt_carousel_1_carousel" class="carousel carousel-custom slide w-100" data-bs-ride="carousel" data-bs-interval="8000">
        <div class="carousel-inner">
            @foreach($banners as $key => $item)
            <div class="carousel-item w-100 min-h-350px min-h-lg-800px {{ $key == 0 ? 'active' : '' }}" style="background-image: url({{ asset('storage/image/origin/' . $item['banner_image']['original_name']) }})">
                <div class="d-flex align-items-center justify-content-{{ !empty($item['banner_position']) ? $item['banner_position'] : 'center' }} w-100 min-h-350px min-h-lg-800px backdrop-filter-brightness">
                    <div class="card shadow-sm mx-20 backdrop-filter-blur mw-25">
                        @if(!empty($item['banner_title']))
                        <div class="card-header">
                            <h3 class="card-title">{{ $item['banner_title'] }}</h3>
                            <div class="card-toolbar">
                                
                            </div>
                        </div>
                        @endif
                        <div class="card-body">{{ $item['banner_description'] }}</div>
                        @if(!empty($item['banner_link']))
                        <div class="card-footer">
                            <a href="{{ $item['banner_link'] }}" target="_blank" class="btn btn-lg btn-light-primary">Clik here</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            <div class="d-flex align-items-center justify-content-between flex-wrap p-10 w-100 position-absolute bottom-0">
                <span class="fs-4 fw-bold pe-2"></span>
                <ol class="carousel-indicators carousel-indicators-dots">
                    @for($i = 0; $i < count($banners); $i++)
                    <li data-bs-target="#kt_carousel_1_carousel" data-bs-slide-to="{{ $i }}" class="ms-2 {{ $i < 1 ? 'active' : '' }}"></li>
                    @endfor
                </ol>
            </div>
        </div>
    </div>
</div>