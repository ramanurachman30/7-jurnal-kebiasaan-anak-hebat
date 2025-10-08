@extends('skeleton-tailwind')

@section('content')
<section id="home">
    <div class="container py-5">
        <div class="row">
            <div class="text-start col-12" style="padding-top: 23vh;">
                <p class="text-white fw-semibold" style="font-size: 96px;">Sync Digital Indonesia</p>
                <p class="text-white fs-24" style="padding-right: 60%;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
                <a href="#" class="btn btn-secondary rounded-pill">Read More</a>
            </div>
        </div>
    </div>
</section>
<section id="about" style="background-color: #1E1E1E">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 col-sm-auto">
                <img class="img-fluid" src="{{ asset('assets/media/sync-indonesia-assets/isaac-sloman-OwRaecyNiYM-unsplash 1.png') }}" alt="logo MPK" class="logo-nav">
            </div>
            <div class="my-3 col-md-6 col-sm-auto text-end">
                <h2 class="text-white">About Us</h2>
                <hr class="text-white" style="width: 25%; margin-left: auto;">
                <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis fuga voluptatibus facere expedita similique nesciunt vel aliquam ex fugiat optio doloremque, omnis, dicta sunt eius. Ipsam libero sed natus! Tempore, velit reprehenderit. Deserunt, illo labore debitis molestias dicta, error dolorem, facilis eaque corrupti eligendi alias quo non possimus sit corporis.</p>
                <a href="#" class="btn btn-secondary rounded-pill">Read More</a>
            </div>
        </div>
    </div>
</section>
<section id="services">
    <div class="container py-5">
        <div class="text-center title">
            <h1>Our Services</h1>
            <hr class="mx-auto" style="width: 10%;">
        </div>
        <div id="servicesCarousel" class="py-5 carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row align-items-center">
                <div class="mb-3 col-md-6 mb-md-0">
                    <img class="rounded img-fluid" src="{{asset('assets/media/sync-indonesia-assets/ken-suarez-dqRdtm2spBk-unsplash 1.png')}}" alt="">
                </div>
                <div class="text-center col-md-6 text-md-start">
                    <p class="fs-1 fw-bold">First Services</p>
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
                        <p class="fs-1 fw-bold">Second Services</p>
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
                    <p class="fs-1 fw-bold">Third Services</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, dolore fuga! Placeat laudantium ullam vel deleniti.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, commodi velit earum fugit iusto ab eveniet.</p>
                </div>
                </div>
            </div>
    
            </div>
            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#servicesCarousel" data-bs-slide="prev" style="margin-left: auto">
                <span class="p-3 carousel-control-prev-icon bg-light rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#servicesCarousel" data-bs-slide="next" style="padding-top: auto">
                <span class="p-3 carousel-control-next-icon bg-light rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button> --}}
        </div>
    </div>
</section>
<section id="contact-us">
    <div class="container">
        <div class="row">
            <div class="text-center col-12">
                <h1>Contact Us</h1>
                <hr class="mx-auto" style="width: 10%;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-auto">
                <img class="img-fluid" src="{{ asset('assets/media/sync-indonesia-assets/Digital Service Call Center Streamline Dhaka.png') }}" alt="">
            </div>
            <div class="mt-5 col-md-6 col-sm-auto">
                <div class="container mt-4">
                    <form action="">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="text" class="form-control" id="firstname" placeholder="Firstname">
                                <label for="firstname">Firstname*</label>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="text" class="form-control" id="lastname" placeholder="Lastname">
                                <label for="lastname">Lastname*</label>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="text" class="form-control" id="address" placeholder="Address">
                                <label for="address">Address*</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="text" class="form-control" id="email" placeholder="Email">
                                <label for="email">Email*</label>
                                </div>
                            </div>
                        
                            <div class="col-12">
                                <div class="form-floating">
                                <textarea type="text" class="form-control" id="message" placeholder="Message"></textarea>
                                <label for="message">Message*</label>
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <button class="btn btn-dark w-100 rounded-pill">Send Message</button>
                            </div>
                        </div>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</section>
@endsection