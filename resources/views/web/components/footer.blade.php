<footer class="text-center bg-white text-lg-start text-dark">
  <section class="">
    <div class="container">
      <div class="row">
        <div class="mx-auto bg-white w-fit-content rounded-2">
          <img style="width: 400px; height: 200px;" class="img-fluid" src="{{ asset('assets/media/pkm/LogoSekolah.jpg') }}" alt="logo mpk" class="logo-footer">
        </div>
      </div>
    </div>
  </section>

  <div class="p-4 text-center text-white fs-12 bg-dark">
    <div class="gap-4 my-3 d-flex justify-content-center">
      <img src="{{ asset('assets/media/sync-indonesia-assets/prime_twitter.png') }}" alt="logo mpk" class="logo-footer" style="width: 30.44px; height: 30.44px;">
      <img src="{{ asset('assets/media/sync-indonesia-assets/akar-icons_instagram-fill.png') }}" alt="logo mpk" class="logo-footer" style="width: 30.44px; height: 30.44px;">
      <img src="{{ asset('assets/media/sync-indonesia-assets/akar-icons_linkedin-v1-fill.png') }}" alt="logo mpk" class="logo-footer" style="width: 30.44px; height: 30.44px;">
    </div>
    <div class="gap-4 mb-3 d-flex flex-column align-items-center">
      <div class="gap-5 d-flex flex-column flex-md-row align-items-center" style="font-size: 17px;">

          <a class="text-white text-decoration-none" href="{{ route('home.page') }}">Home</a>
          <a class="text-white text-decoration-none" href="{{ route('aboutUsPage') }}">About Us</a>
          <a class="text-white text-decoration-none" href="{{ route('products') }}">Products</a>
          <a class="text-white text-decoration-none" href="{{ route('contactus') }}">Contact Us</a>          
          <a class="text-white text-decoration-none" href="{{ route('newsNEvents') }}">News & Events</a>
      </div>
    </div>
    © 2025 Sync Indonesia. All rights reserved.
  </div>
</footer>