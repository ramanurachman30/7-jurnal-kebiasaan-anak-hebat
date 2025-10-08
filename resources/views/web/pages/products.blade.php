@extends('web.components.main')
@section('content')
<section id="products" style="background-color: #1E1E1E;">
    <div class="container py-5 text-white">
        <!-- Title -->
        <div class="text-start title-pages">
            <p class="fs-2 fw-bold">What We Offer</p>
            <hr class="" style="width: 20%;">
        </div>
    
        <div id="productsCarousel" class="py-5 carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
    
            <div class="carousel-item active">
                <div class="row align-items-center">
                <div class="mb-3 col-md-6 mb-md-0">
                    <img class="rounded img-fluid" src="{{asset('assets/media/sync-indonesia-assets/ken-suarez-dqRdtm2spBk-unsplash 1.png')}}" alt="">
                </div>
                <div class="text-center col-md-6 text-md-start">
                    <p class="fs-1 fw-bold">Undangan Digital</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum qui minima quod. Est minus dignissimos debitis, corporis quae magnam ut officiis sapiente?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti iste officia nostrum ipsam aliquid quibusdam commodi expedita et veniam officiis.</p>
                </div>
                </div>
            </div>
    
            <!-- Item 2 -->
            <div class="carousel-item">
                <div class="row align-items-center">
                    <div class="mb-3 col-md-6 mb-md-0">
                        <img class="rounded img-fluid" src="{{asset('assets/media/sync-indonesia-assets/aws-light logo.png')}}" alt="">
                    </div>
                    <div class="text-center col-md-6 text-md-start">
                        <p class="fs-1 fw-bold">Produk Kedua</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, officiis! Nesciunt maiores accusantium doloremque nobis vitae tenetur!</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, nemo aliquid? Dolorem fugit ab alias repellendus!</p>
                    </div>
                </div>
            </div>
    
            <!-- Item 3 -->
            <div class="carousel-item">
                <div class="row align-items-center">
                <div class="mb-3 col-md-6 mb-md-0">
                    <img class="rounded img-fluid" src="{{asset('assets/media/sync-indonesia-assets/Logo.png')}}" alt="">
                </div>
                <div class="text-center col-md-6 text-md-start">
                    <p class="fs-1 fw-bold">Produk Ketiga</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, dolore fuga! Placeat laudantium ullam vel deleniti.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, commodi velit earum fugit iusto ab eveniet.</p>
                </div>
                </div>
            </div>
    
            </div>
    
        </div>
        
    </div>
</section>
<button class="carousel-control-prev" type="button" data-bs-target="#productsCarousel" data-bs-slide="prev" style="padding-top: auto">
    <span class="p-3 carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#productsCarousel" data-bs-slide="next" style="padding-top: auto">
    <span class="p-3 carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>

@endsection