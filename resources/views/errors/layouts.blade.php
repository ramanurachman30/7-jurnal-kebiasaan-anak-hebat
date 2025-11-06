<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/frontend/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/Montserrat/stylesheet.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/frontend/dist/css/bundle.css') . '?' . filemtime(public_path('assets/frontend/dist/css/bundle.css')) }}"
        defer async>
    <title>Page no found</title>
</head>

<body>
    <div class="container">
        <div class="d-flex align-items-center justify-content-center h-100">
            <div class="text-center">
                <img alt="Logo" src="{{ asset('assets/media/pkm/LogoSekolah.jpg') }}" height="110" />
                <h1 class="my-4">@yield('code')</h1>
                <h3 class="mb-4">@yield('title')</h3>
                {{-- <p>@yield('message')</p> --}}
                {{-- @yield('button') --}}
                <a href="{{ url('/') }}" class="btn bg-warning text-dark">{{ __('Kembali') }}</a>
            </div>
        </div>
    </div>
</body>

</html>
