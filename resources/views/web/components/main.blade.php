<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | {{ ucwords(str_replace(['_'], ' ', request()->segment(1))) }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap5.3/bootstrap.min.css')}}">
    <script src="{{asset('assets/js/bootstrap5.3/bootstrap.min.js')}}"></script>
    @yield('meta')

    <style>
        #home {
            margin: 0;
            min-height: 100vh;
            background-image: url('{{ asset('assets/media/sync-indonesia-assets/MainBG.png') }}');
            background-size: 100% auto;
            background-position: center top;
            background-repeat: no-repeat;
            background-color: #000;
            background-attachment: fixed;
        }

        @media (max-width: 768px) {
            #home {
                background-size: cover;
                background-position: center;
            }
        }
        .navbar-for-blur{
            backdrop-filter: blur(10px);
            background-color: rgba(27, 27, 27, 0.733);
        }

        .nav-link {
          position: relative;
          color: #fff; /* biar teks tetap putih */
          text-decoration: none;
        }

        .nav-link::after {
          content: "";
          position: absolute;
          bottom: 4px;
          left: 50%;
          transform: translateX(-50%) scaleX(0);
          width: 100%;
          height: 2px;
          background-color: #fff;
          transform-origin: center;
          transition: transform 0.4s ease;
        }

        /* Saat hover: garis muncul + animasi pulse */
        .nav-link:hover::after {
          transform: translateX(-50%) scaleX(1);
        }

        /* Saat active: garis permanen */
        .nav-link.active::after {
          transform: translateX(-50%) scaleX(1);
        }

        .logo-img {
            max-width: 120px;
            height: auto;
            object-fit: contain;
            filter: grayscale(100%);
            transition: filter 0.3s ease;
        }
        .logo-img:hover {
            filter: grayscale(0);
        }

        @media (max-width: 576px) {
          .logo-img {
            max-width: 80px;
          }
        }

        @media (min-width: 992px) {
          .logo-img {
            max-width: 150px;
          }
        }
    </style>
</head>
<body>
    @include('web.components.header')
    @yield('content')
    @include('web.components.footer')
</body>
<script>
    (function () {
    const scroller = document.getElementById('scrollRow');
    const btnL = document.getElementById('btnScrollLeft');
    const btnR = document.getElementById('btnScrollRight');

    function step() {
      return Math.max(200, Math.floor(scroller.clientWidth * 0.8));
    }

    function scrollRowLeft() {
      scroller.scrollBy({ left: -step(), behavior: 'smooth' });
    }

    function scrollRowRight() {
      scroller.scrollBy({ left: step(), behavior: 'smooth' });
    }

    btnL.addEventListener('click', scrollRowLeft);
    btnR.addEventListener('click', scrollRowRight);
  })();
</script>
</html>
