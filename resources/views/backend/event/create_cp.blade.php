@extends('skeleton')
@section('customcss')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cdbootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cdbootstrap/css/cdb.min.css" />
    <style>
        .stepper .steps-container .steps .step.active .step-node {
            background-color: rgb(0, 164, 25);
            border: 2px solid #ffffff;
            color: #ffffff;
        }

        i.bi,
        i[class*=" fa-"],
        i[class*=" fonticon-"],
        i[class*=" la-"],
        i[class^=fa-],
        i[class^=fonticon-],
        i[class^=la-] {
            line-height: 1;
            font-size: 1rem;
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="card card-bordered">
        <div class="card-header ribbon ribbon-end">
            <div class="ribbon-label bg-primary">{{ ucwords(str_replace(['.', '_'], ' ', request()->route()->getName())) }}
            </div>
            <div class="card-title">{{ ucwords(str_replace(['.', '_'], ' ', request()->route()->getName())) }}</div>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/' . Request::segment(2)) }}" method="POST" id="createform"
                enctype="multipart/form-data">
                @csrf
                <div class="stepper" id="stepper">
                    <div class="steps-container">
                        <div class="steps">
                            <div class="step" icon="fa fa-pencil-alt" id="1">
                                <div class="step-title">
                                    <span class="step-number">01</span>
                                    <div class="step-text">Event Information</div>
                                </div>
                            </div>
                            <div class="step" icon="fa fa-info-circle" id="2">
                                <div class="step-title">
                                    <span class="step-number">02</span>
                                    <div class="step-text">Invitations Contetn</div>
                                </div>
                            </div>
                            <div class="step" icon="fa fa-book-reader" id="3">
                                <div class="step-title">
                                    <span class="step-number">03</span>
                                    <div class="step-text">Event Shedules</div>
                                </div>
                            </div>
                            <div class="step" icon="fa fa-book-reader" id="4">
                                <div class="step-title">
                                    <span class="step-number">04</span>
                                    <div class="step-text">Our Moment</div>
                                </div>
                            </div>
                            <div class="step" icon="fa fa-check" id="5">
                                <div class="step-title">
                                    <span class="step-number">05</span>
                                    <div class="step-text">E-Gift</div>
                                </div>
                            </div>
                            <div class="step" icon="fa fa-check" id="6">
                                <div class="step-title">
                                    <span class="step-number">06</span>
                                    <div class="step-text">Invitation</div>
                                </div>
                            </div>
                            <div class="step" icon="fa fa-check" id="7">
                                <div class="step-title">
                                    <span class="step-number">07</span>
                                    <div class="step-text">Preview</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="stepper-content-container">
                        <div class="stepper-content fade-in" stepper-label="1">
                            @component('_components.event.event')
                            @endcomponent
                        </div>
                        <div class="stepper-content fade-in" stepper-label="2">
                            @component('_components.event.content', ['data' => $data['templates']])
                            @endcomponent
                        </div>
                        <div class="stepper-content fade-in" stepper-label="3">
                            @component('_components.event.event_schedules')
                            @endcomponent
                        </div>
                        <div class="stepper-content fade-in" stepper-label="4">
                            @component('_components.event.our_memories', [
                                'data' => [
                                    'column' => '12', // lebar kolom bootstrap (col-xl-12)
                                    'name' => 'image_content', // nama input (wajib unik untuk setiap komponen)
                                    'label' => 'Product Gallery', // label di atas field
                                    'value' => old('image_content', isset($product) ? $product->images : []), // nilai default
                                    'upload_size' => 5000000, // optional, max size per file (dalam byte)
                                    'upload_accept' => 'image/*,application/pdf', // optional, tipe file yg diterima
                                    'upload_info' => 'Maksimal 5MB, format: JPG, PNG, PDF', // optional, teks info di bawah upload
                                    'info' => 'Anda bisa mengunggah lebih dari satu file', // optional, info tambahan di bawah tombol
                                ],
                            ])
                            @endcomponent

                        </div>
                        <div class="stepper-content fade-in" stepper-label="5">
                            @component('_components.event.gift', ['bankAccounts' => $data['bankAccounts']])
                            @endcomponent
                        </div>
                        <div class="stepper-content fade-in" stepper-label="6">
                            @component('_components.event.invitation')
                            @endcomponent
                        </div>
                        <div class="stepper-content fade-in" stepper-label="7">
                            @component('_components.event.preview')
                            @endcomponent
                        </div>
                    </div>
                    <input name="xsubmit" value="1" type="hidden">
            </form>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ __(url(Request::segment(1))) }}" type="button" class="btn btn-light">
                <i class="fas fa-arrow-left"></i>
                {{ __('Cancel') }}
            </a>
            <div class="d-flex">
                {{-- <button type="button" id="kt_btn_1" class="btn btn-success btn-submit me-3" data-xsubmit="1">
                    <i class="fas fa-save"></i>
                    <span class="indicator-label">{{ __('Submit and Leave') }}</span>
                    <span class="indicator-progress">{{ __('Please wait') }} ...
                        <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                </button>
                <button type="button" id="kt_btn_1" class="btn btn-primary btn-submit" data-xsubmit="2">
                    <i class="fas fa-save"></i>
                    <span class="indicator-label">{{ __('Submit and Stay') }}</span>
                    <span class="indicator-progress">{{ __('Please wait') }} ...
                        <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                </button> --}}
                <div class="d-flex">
                    <button type="button" id="kt_btn_1" class="btn btn-primary btn-submit"
                        onclick="$('#createform').submit()">
                        <i class="fas fa-save"></i>
                        <span class="indicator-label">{{ __('Submit') }}</span>
                        <span class="indicator-progress">{{ __('Please wait') }} ...
                            <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
    <script src="{{ asset('assets/plugins/global/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/components/form-validation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/cdb.min.js"></script>
    <script>
        const stepperElement = document.querySelector("#stepper");
        const stepper = new CDB.Stepper(stepperElement);
    </script>
@endsection
