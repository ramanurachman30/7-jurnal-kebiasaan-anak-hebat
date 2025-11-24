<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ __('Register Page') }}</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

    @vite('resources/css/app.css')
    @include('metronic/css')

    <script src="{{ asset('assets/js/custom/theme-handler.js') }}"></script>
    <style>
        body {
            background-image: url('{{ asset('assets/media/pkm/SDNBINTARO 04 PAGI_Nero_AI_Image_Upscaler_Photo_Face.jpeg.jpg') }}');
        }

        body, html {
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column justify-content-center flex-column-fluid flex-lg-row">
            <div class="p-10 d-flex flex-center w-lg-50">
                <div class="card rounded-3 w-850px w-lg-450px shadow-lg">
                    <div class="px-12 py-16 px-lg-10 py-lg-10 card-body p-lg-16">
                        <form class="form w-100" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-6 row justify-content-center text-center">
                                <img alt="Logo" src="{{ asset('assets/media/pkm/LogoSekolah.jpg') }}" class="w-25 h-25" />
                                <h1>Daftar</h1>
                            </div>

                            <div class="mb-3 fv-row form-floating">
                                <input type="text" name="name" class="form-control bg-transparent" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                                <label>Nama Lengkap</label>
                            </div>

                            <div class="mb-3 fv-row form-floating">
                                <input type="text" name="username" class="form-control bg-transparent" placeholder="Username" value="{{ old('username') }}" required>
                                <label>Username</label>
                            </div>

                            <div class="mb-3 fv-row form-floating">
                                <input type="email" name="email" class="form-control bg-transparent" placeholder="Email" value="{{ old('email') }}" required>
                                <label>Email</label>
                            </div>

                            <div class="mb-3 fv-row form-floating">
                                <select 
                                    id="gender" 
                                    name="gender" 
                                    required
                                    class="form-control bg-transparent"
                                >
                                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <label>Jenis Kelamin</label>
                            </div>

                            <div class="mb-3 fv-row form-floating">
                                <select 
                                    id="grade_id" 
                                    name="grade_id" 
                                    required
                                    class="form-control bg-transparent"
                                >
                                    <option value="">Pilih Kelas</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->grade_name }}</option>
                                    @endforeach
                                </select>
                                <label>Kelas</label>
                            </div>

                            <div class="mb-3 fv-row form-floating">
                                <textarea 
                                    id="address" 
                                    name="address" 
                                    class="form-control bg-transparent"
                                    rows="3"
                                >{{ old('address') }}</textarea>
                                <label>Alamat</label>
                            </div>

                            <div class="mb-3 fv-row form-floating">
                                <input type="text" name="phone_number" class="form-control bg-transparent" placeholder="Nomor Telepon" value="{{ old('phone_number') }}" required>
                                <label>Nomor Telepon</label>
                            </div>

                            <div class="mb-3 fv-row form-floating position-relative">
                                <input type="password" name="password" id="register_password" class="form-control bg-transparent" placeholder="Password" required>
                                <label>Kata Sandi</label>
                                <button type="button"
                                    class="btn btn-sm btn-light position-absolute top-50 end-0 translate-middle-y me-3"
                                    style="z-index:2;"
                                    onclick="togglePassword('register_password', this)" tabindex="-1">
                                    <span class="svg-icon svg-icon-muted svg-icon-2">
                                        <i class="bi bi-eye-slash"></i>
                                    </span>
                                </button>
                            </div>

                            <div class="mb-3 fv-row form-floating position-relative">
                                <input type="password" name="password_confirmation" id="register_password_confirm" class="form-control bg-transparent" placeholder="Konfirmasi Kata Sandi" required>
                                <label>Konfirmasi Kata Sandi</label>
                            </div>

                            <div class="mb-10 d-grid">
                                <button type="submit" class="btn btn-dark text-white py-3 fw-bold">
                                    {{ __('Daftar') }}
                                </button>
                            </div>

                            <div class="d-grid text-center">
                                <a href="{{ route('login') }}" class="underline text-blue-600 hover:text-blue-900">
                                    {{ __('Sudah punya akun? Login di sini') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('metronic/javascript')
    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }

        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif

        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>
</body>
</html>
