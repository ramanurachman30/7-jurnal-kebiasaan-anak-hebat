<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/app.css')

    <style>
        body {
            background-image: url('{{ asset('assets/media/pkm/SDNBINTARO 04 PAGI_Nero_AI_Image_Upscaler_Photo_Face.jpeg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-8">

        {{-- Logo + Title --}}
        <div class="flex flex-col items-center mb-8 text-center">
            <img src="{{ asset('assets/media/pkm/LogoSekolah.jpg') }}"
                 class="w-24 h-24 rounded-full shadow">
            <h1 class="text-2xl font-semibold text-gray-900 mt-4">Daftar Akun Baru</h1>
        </div>

        {{-- Form --}}
        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <input 
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Nama Lengkap"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300 bg-white/70 backdrop-blur"
                >
            </div>

            {{-- Username --}}
            <div>
                <input 
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Username"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300 bg-white/70 backdrop-blur"
                >
            </div>

            {{-- Email --}}
            <div>
                <input 
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Email"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300 bg-white/70 backdrop-blur"
                >
            </div>

            {{-- Gender --}}
            <div>
                <select
                    name="gender"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white/70 backdrop-blur focus:ring focus:ring-blue-300"
                >
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            {{-- Grade --}}
            <div>
                <select
                    name="grade_id"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white/70 backdrop-blur focus:ring focus:ring-blue-300"
                >
                    <option value="">Pilih Kelas</option>
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->grade_name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Address --}}
            <div>
                <textarea 
                    name="address"
                    rows="3"
                    placeholder="Alamat"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white/70 backdrop-blur focus:ring focus:ring-blue-300"
                >{{ old('address') }}</textarea>
            </div>

            {{-- Phone Number --}}
            <div>
                <input 
                    type="text"
                    name="phone_number"
                    value="{{ old('phone_number') }}"
                    placeholder="Nomor Telepon"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white/70 backdrop-blur focus:ring focus:ring-blue-300"
                >
            </div>

            {{-- Password --}}
            <div class="relative">
                <input 
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Kata Sandi"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white/70 backdrop-blur focus:ring focus:ring-blue-300"
                >
                <button 
                    type="button"
                    onclick="togglePassword('password')"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600"
                >
                    👁️
                </button>
            </div>

            {{-- Confirm Password --}}
            <div class="relative">
                <input 
                    type="password"
                    name="password_confirmation"
                    id="password_confirm"
                    placeholder="Konfirmasi Kata Sandi"
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-white/70 backdrop-blur focus:ring focus:ring-blue-300"
                >
                <button 
                    type="button"
                    onclick="togglePassword('password_confirm')"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600"
                >
                    👁️
                </button>
            </div>

            {{-- Submit --}}
            <button 
                type="submit"
                class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition"
            >
                Daftar
            </button>

            {{-- Link to Login --}}
            <p class="text-center mt-2 text-gray-800">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-blue-700 hover:underline">
                    Login di sini
                </a>
            </p>
        </form>
    </div>

    {{-- Toast --}}
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif

        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>
