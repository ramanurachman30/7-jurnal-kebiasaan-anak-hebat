<section class="p-x-6 p-y-8 bg-blue text-white">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row">
            <div>
                <h2 class="fs-2 fw-bold text-yellow mb-3">{{(__('Need to Connect with Us'))}} ?</h2>
                <p>{{(__('If you need further assistance regarding your investment in Indonesia, our team will be more than happy to assist you further. Please visit our support and help page to connect with us'))}}</p>
            </div>
            <div class="mt-lg-0 mt-3 ms-lg-5 ms-0">
                <a class="btn bg-green text-nowrap" href="{{ url(lang() . '/' . $dataMicrositeDetail[0]['slug']) .'/support' }}">
                    <p class="big">{{__('Support And Help')}}</p>
                    <span class="icon-olarrow"></span>
                </a>
            </div>
        </div>
    </div>
</section>