<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ __('Login Page') }}</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

    @vite('resources/css/app.css')
    @include('metronic/css')

    <script src="{{ asset('assets/js/custom/theme-handler.js') }}"></script>
    <style>
        body {
            background-image: url('{{ asset('assets/media/pkm/SDNBINTARO 04 PAGI_Nero_AI_Image_Upscaler_Photo_Face.jpeg.jpg') }}');
        }

        /* [data-theme="dark"] body {
            background-image: url('{{ asset('assets/media/auth/bg4-dark.jpg') }}');
        } */
    </style>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column justify-content-center flex-column-fluid flex-lg-row">
            {{-- <div class="px-10 d-flex flex-center w-lg-50 pt-15 pt-lg-0">
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <a href="#" class="mb-7">
                        <img alt="Logo" src="{{ asset('assets/media/pkm/LogoSekolah.jpg') }}" width="100%" />
                    </a>
                </div>
            </div> --}}
            <div class="p-10 d-flex flex-center w-lg-50">
                <div class="card rounded-3 w-850px w-lg-450px">
                    <div class="px-12 py-16 px-lg-10 py-lg-10 card-body p-lg-16">
                        @section('form')
                            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                                action="{{ route('login') }}" method="POST">
                                @method('POST')
                                @csrf
                                <div class="mb-6 row justify-content-center text-center">
                                    <img alt="Logo" src="{{ asset('assets/media/pkm/LogoSekolah.jpg') }}" class="w-25 h-25" />
                                    <h1>Halaman Login</h1>
                                </div>
                                {{-- <div class="mb-5 fv-row form-floating">
                                    <input type="text" placeholder="Email" name="email" autocomplete="off"
                                        class="bg-transparent form-control" value="{{ old('email') }}"
                                        aria-describedby="inputGroup-sizing-lg" />
                                    <label for="floatingInput">{{ __('Email address') }}</label>
                                </div>
                                <div class="mb-5 fv-row form-floating position-relative">
                                    <input type="password" placeholder="Password" name="password" autocomplete="off"
                                        class="bg-transparent form-control" id="login_password" />
                                    <label for="floatingInput">{{ __('Password') }}</label>
                                    <button type="button"
                                        class="btn btn-sm btn-light position-absolute top-50 end-0 translate-middle-y me-3"
                                        style="z-index:2;" onclick="togglePassword('login_password', this)" tabindex="-1">
                                        <span class="svg-icon svg-icon-muted svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                                <path
                                                    d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z" />
                                                <path
                                                    d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829" />
                                                <path
                                                    d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.708zm.344-.707a6 6 0 0 1 2.306-.61V4c0-.55.45-1 1-1s1 .45 1 1v.152a6 6 0 0 1 2.306.61l.708-.708a7 7 0 0 0-1.894-.943C9.863 2.777 8.95 2.5 8 2.5s-1.863.277-2.756.61a7 7 0 0 0-1.894.943z" />
                                                <path d="m10.97 4.97-.02.022L15.99 10l-.02.022" />
                                            </svg>
                                        </span>
                                    </button>
                                </div> --}}

                                <div class="relative mb-4">
                                    <input
                                        type="text"
                                        name="email"
                                        id="email"
                                        placeholder="{{ __('Email') }}"
                                        autocomplete="off"
                                        value="{{ old('email') }}"
                                        class="w-full border border-gray-300 px-5 py-4 rounded-lg"
                                    />
                                </div>

                                <div class="relative mb-4">
                                    <input 
                                        type="password" 
                                        name="password"
                                        id="login_password" 
                                        placeholder="{{ __('Kata Sandi') }}"
                                        class="w-full border border-gray-300 px-5 py-4 rounded-lg"
                                    />

                                    <button type="button"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                        onclick="togglePassword('login_password', this)" tabindex="-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                            viewBox="0 0 16 16"><path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z" /><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829" /><path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.708z" />
                                        </svg>
                                    </button>
                                </div>


                                {{-- <div class="g-recaptcha" data-sitekey="6LcQL4IrAAAAAAep9gz_ZY9q9S0VBhf7eM2BCfBy"></div> --}}
                                <div class="mb-10 d-grid">
                                    <button type="submit" id="kt_sign_in_submit"
                                        class="sm:px-5 py-4 bg-dark text-white rounded-lg!">
                                        <span class="text-4xl lg:text-lg font-semibold indicator-label">{{ __('Login') }}</span>
                                        <span class="text-4xl lg:text-lg font-semibold indicator-progress">{{ __('Loading') }}...
                                            <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                                    </button>
                                </div>
                                <div class="d-grid text-center">
                                    {{ __('Belum punya akun?') }}
                                    <a 
                                        class="underline text-lg text-blue-600 hover:text-blue-900" 
                                        href="{{ route('createRegister') }}"
                                    >
                                        Daftar disini
                                    </a>
                                </div>
                            </form>
                        @show
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('metronic/javascript')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <script>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const svgIcon = button.querySelector('svg');
            if (input.type === 'password') {
                input.type = 'text';
                svgIcon.innerHTML = `
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                `;
            } else {
                input.type = 'password';
                svgIcon.innerHTML = `
                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                    <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.708zm.344-.707a6 6 0 0 1 2.306-.61V4c0-.55.45-1 1-1s1 .45 1 1v.152a6 6 0 0 1 2.306.61l.708-.708a7 7 0 0 0-1.894-.943C9.863 2.777 8.95 2.5 8 2.5s-1.863.277-2.756.61a7 7 0 0 0-1.894.943z"/>
                    <path d="m10.97 4.97-.02.022L15.99 10l-.02.022"/>
                `;
            }
        }
    </script>
    @yield('js')
</body>

</html>
