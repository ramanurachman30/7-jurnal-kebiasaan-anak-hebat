<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
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

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

        {{-- Logo + Heading --}}
        <div class="flex flex-col items-center mb-8 text-center">
            <img 
                src="{{ asset('assets/media/pkm/LogoSekolah.jpg') }}" 
                alt="Logo Sekolah" 
                class="w-24 h-24 rounded-full shadow"
            >
            <h1 class="text-2xl font-semibold text-gray-800 mt-4">Halaman Login</h1>
        </div>

        {{-- Form --}}
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            @method('POST')

            {{-- Email --}}
            <div>
                <input 
                    type="text" 
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    placeholder="Email"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300 focus:outline-none"
                >
            </div>

            {{-- Password --}}
            <div class="relative">
                <input 
                    type="password" 
                    name="password"
                    id="password"
                    placeholder="Kata Sandi"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-300 focus:outline-none"
                >
                <button 
                    type="button"
                    onclick="togglePassword()"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 4.5C7 4.5 3 9 3 12s4 7.5 9 7.5 9-4.5 9-7.5-4-7.5-9-7.5z" />
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>

            {{-- Submit --}}
            <button 
                type="submit"
                class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition"
            >
                Login
            </button>

            {{-- Register --}}
            <p class="text-center text-gray-700 mt-4">
                Belum punya akun?  
                <a href="{{ route('createRegister') }}" class="text-blue-700 hover:underline font-semibold">
                    Daftar disini
                </a>
            </p>
        </form>
    </div>

    {{-- Toast Error --}}
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    {{-- Password Toggle --}}
    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>

</body>
</html>
