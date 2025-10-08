@extends('web.components.main')

@section('content')
<section id="contact-us">
    <div class="container py-5">
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