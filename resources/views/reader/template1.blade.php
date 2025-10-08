<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Template 1</title>

    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/templateMobile.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Playwrite+IT+Moderna:wght@100..400&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Belanosima:wght@400;600;700&family=Playwrite+IT+Moderna:wght@100..400&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair Display&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ruwudu:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


</head>

<body>
    <!-- Overlay Push Up -->

    {{-- <audio hidden id="audio-player">
        <source src="{{ asset('storage/image/origin/' . $data['sound']['original_name'] ?? '') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio> --}}

    {{-- <div class="transition">
          <div class="transitions">
              <div>click anywhere</div>
          </div>
      </div> --}}

    <div id="pushupOverlay" class="pushup-overlay">
        <button class="pushup-btn btn btn-outline-light" id="pushupBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-envelope-heart-fill" viewBox="0 0 16 16">
                <path
                    d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555l-4.2 2.568-.051-.105c-.666-1.3-2.363-1.917-3.699-1.25-1.336-.667-3.033-.05-3.699 1.25l-.05.105zM11.584 8.91l-.073.139L16 11.8V4.697l-4.003 2.447c.027.562-.107 1.163-.413 1.767Zm-4.135 3.05c-1.048-.693-1.84-1.39-2.398-2.082L.19 12.856A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144L10.95 9.878c-.559.692-1.35 1.389-2.398 2.081L8 12.324l-.551-.365ZM4.416 8.91c-.306-.603-.44-1.204-.413-1.766L0 4.697v7.104l4.49-2.752z" />
                <path d="M8 5.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
            </svg> Buka Undangan
        </button>
    </div>
    <div class="smartphone">
        <div class="content">
            {{-- Membuat Transisi sebelum di scroll --}}
            <section id="page1" class="page1">
                <div class="baseBg"
                    style="background-image: url('{{ asset('assets/img/assets_template1/Group38.png') }}')">
                    <div class="images-top-jw">
                        <img src="{{ asset('assets/img/assets_template1/top.png') }}" alt="">
                    </div>
                    <div class="judul" data-aos="zoom-in-up" data-aos-duration="3000">
                        <div class="text">
                            <h2>The Wedding Of</h2>
                            <h1 class="m-4">{{ $data['contentInvitation']['title'] }}</h1>
                            <p>{{ $data['event']['wedding_date'] }}</p>
                        </div>
                        <div class="text" style="margin-top: 6rem">
                            <span>Kepada : </span>
                            <br>
                            <span>{{ $data['guest']['to'] }}</span>
                        </div>
                        <div class="mt-2 btns">
                            <a href="#page2" id="undangan" class="btn rounded-pill"
                                style="background-color: #603912; color: white;">Lihat Undangan</a>
                        </div>
                        <div class="mt-3 btns">
                            <a class="btn rounded-pill" id="barcode-btn"
                                style="background-color: #603912; color: white;">Tampilkan Barcode</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 bingkaiBawah">
                            <img data-aos="zoom-in-up" data-aos-duration="3000"
                                src="{{ asset('assets/img/assets_template1/sideKiri.png') }}" alt="">
                        </div>
                        <div class="col-6"></div>
                    </div>
                </div>
            </section>
            <nav class="navbar fixed-bottom">
                <ul class="nav-list">
                    <li class="nav-item"><a href="#page2"><svg width="30" height="30" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.70711 1.50005C8.31658 1.10952 7.68342 1.10952 7.29289 1.50005L0.646447 8.14649C0.451184 8.34176 0.451184 8.65834 0.646447 8.8536C0.841709 9.04886 1.15829 9.04886 1.35355 8.8536L2 8.20715V13.5C2 14.3285 2.67157 15 3.5 15H12.5C13.3284 15 14 14.3285 14 13.5V8.20715L14.6464 8.8536C14.8417 9.04886 15.1583 9.04886 15.3536 8.8536C15.5488 8.65834 15.5488 8.34176 15.3536 8.14649L13 5.79294V2.50005C13 2.2239 12.7761 2.00005 12.5 2.00005H11.5C11.2239 2.00005 11 2.2239 11 2.50005V3.79294L8.70711 1.50005ZM13 7.20715V13.5C13 13.7762 12.7761 14 12.5 14H3.5C3.22386 14 3 13.7762 3 13.5V7.20715L8 2.20715L13 7.20715Z"
                                    fill="black" />
                            </svg>
                        </a></li>
                    <li class="nav-item"><a href="#page3"><svg width="30" height="30" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.70711 9H11.0714C10.5354 10.5732 13.0991 12.8059 16 8.5C13.0991 4.19407 10.5354 6.4268 11.0714 8H6.70711L4.85355 6.14645C4.65829 5.95118 4.34171 5.95118 4.14645 6.14645C3.95118 6.34171 3.95118 6.65829 4.14645 6.85355L5.29289 8H4.70711L2.85355 6.14645C2.65829 5.95118 2.34171 5.95118 2.14645 6.14645C1.95118 6.34171 1.95118 6.65829 2.14645 6.85355L3.29289 8H2.70711L0.853553 6.14645C0.658291 5.95118 0.341709 5.95118 0.146447 6.14645C-0.0488155 6.34171 -0.0488155 6.65829 0.146447 6.85355L1.79289 8.5L0.146447 10.1464C-0.0488155 10.3417 -0.0488155 10.6583 0.146447 10.8536C0.341709 11.0488 0.658291 11.0488 0.853553 10.8536L2.70711 9H3.29289L2.14645 10.1464C1.95118 10.3417 1.95118 10.6583 2.14645 10.8536C2.34171 11.0488 2.65829 11.0488 2.85355 10.8536L4.70711 9H5.29289L4.14645 10.1464C3.95118 10.3417 3.95118 10.6583 4.14645 10.8536C4.34171 11.0488 4.65829 11.0488 4.85355 10.8536L6.70711 9Z"
                                    fill="black" />
                            </svg>
                        </a></li>
                    <li class="nav-item"><a href="#page4"><svg width="30" height="30" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14 1C14.5523 1 15 1.44772 15 2V10C15 10.5523 14.5523 11 14 11H11.5C10.8705 11 10.2777 11.2964 9.9 11.8L8 14.3333L6.1 11.8C5.72229 11.2964 5.12951 11 4.5 11H2C1.44772 11 1 10.5523 1 10V2C1 1.44772 1.44772 1 2 1H14ZM2 0C0.895431 0 0 0.895431 0 2V10C0 11.1046 0.89543 12 2 12H4.5C4.81476 12 5.11115 12.1482 5.3 12.4L7.2 14.9333C7.6 15.4667 8.4 15.4667 8.8 14.9333L10.7 12.4C10.8889 12.1482 11.1852 12 11.5 12H14C15.1046 12 16 11.1046 16 10V2C16 0.895431 15.1046 0 14 0H2Z"
                                    fill="black" />
                                <path
                                    d="M7.06576 4.7606C6.76869 4.30281 6.25304 4 5.66667 4C4.74619 4 4 4.74619 4 5.66667C4 6.58714 4.74619 7.33333 5.66667 7.33333C5.99594 7.33333 6.30291 7.23785 6.5614 7.07305C6.42994 7.46195 6.1864 7.87672 5.78358 8.29392C5.62374 8.45947 5.62837 8.72324 5.79392 8.88308C5.95947 9.04292 6.22324 9.03829 6.38308 8.87275C7.87032 7.33239 7.67687 5.65853 7.06576 4.7606Z"
                                    fill="black" />
                                <path
                                    d="M11.0658 4.7606C10.7687 4.30281 10.253 4 9.66667 4C8.74619 4 8 4.74619 8 5.66667C8 6.58714 8.74619 7.33333 9.66667 7.33333C9.99594 7.33333 10.3029 7.23785 10.5614 7.07305C10.4299 7.46195 10.1864 7.87672 9.78358 8.29392C9.62374 8.45947 9.62837 8.72324 9.79392 8.88308C9.95947 9.04292 10.2232 9.03829 10.3831 8.87275C11.8703 7.33239 11.6769 5.65853 11.0658 4.7606Z"
                                    fill="black" />
                            </svg>
                        </a></li>
                    <li class="nav-item"><a href="#page5"><svg width="30" height="30" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.56091 11.332L3.09998 9.73047H5.08435L5.62341 11.332H6.34216L4.44373 6H3.74841L1.84998 11.332H2.56091ZM4.10388 6.80469L4.90076 9.17969H3.28357L4.08435 6.80469H4.10388Z"
                                    fill="black" />
                                <path
                                    d="M9.84998 7.22656H9.17419V9.76953C9.17419 10.4219 8.76013 10.793 8.17029 10.793C7.63123 10.793 7.18982 10.5469 7.18982 9.78125V7.22656H6.51404V9.97266C6.51404 10.9141 7.11951 11.3984 7.96716 11.3984C8.62341 11.3984 9.01013 11.1172 9.15466 10.793H9.18201V11.332H9.84998V7.22656Z"
                                    fill="black" />
                                <path
                                    d="M12.1078 12.2734C11.5453 12.2734 11.1976 11.9688 11.1234 11.6367H10.4359C10.5297 12.3203 11.0609 12.8359 12.1039 12.8359C13.0336 12.8359 13.85 12.3086 13.85 11.2578V7.22656H13.2015V7.80469H13.182C12.9906 7.45703 12.5453 7.16406 11.9867 7.16406C11.0219 7.16406 10.3461 7.84375 10.3461 9.05078V9.39062C10.3461 10.6211 11.0297 11.293 11.9867 11.293C12.5453 11.293 12.9945 11 13.1586 10.6445H13.1781V11.25C13.1781 11.8945 12.7562 12.2734 12.1078 12.2734ZM12.1156 7.74219C12.764 7.74219 13.1781 8.26953 13.1781 9.10156V9.35547C13.1781 10.2031 12.7875 10.7188 12.1156 10.7188C11.4242 10.7188 11.0179 10.207 11.0179 9.35547V9.10156C11.0179 8.23438 11.4242 7.74219 12.1156 7.74219Z"
                                    fill="black" />
                                <path
                                    d="M3.5 0C3.77614 0 4 0.223858 4 0.5V1H12V0.5C12 0.223858 12.2239 0 12.5 0C12.7761 0 13 0.223858 13 0.5V1H14C15.1046 1 16 1.89543 16 3V14C16 15.1046 15.1046 16 14 16H2C0.895431 16 0 15.1046 0 14V3C0 1.89543 0.895431 1 2 1H3V0.5C3 0.223858 3.22386 0 3.5 0ZM1 4V14C1 14.5523 1.44772 15 2 15H14C14.5523 15 15 14.5523 15 14V4H1Z"
                                    fill="black" />
                            </svg>
                        </a></li>
                    <li class="nav-item"><a href="#page6"><svg width="30" height="30" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6 3.5C6 2.67157 6.67157 2 7.5 2H8.5C9.32843 2 10 2.67157 10 3.5V4.5C10 5.32843 9.32843 6 8.5 6V7H14C14.2761 7 14.5 7.22386 14.5 7.5V8.5C14.5 8.77614 14.2761 9 14 9C13.7239 9 13.5 8.77614 13.5 8.5V8H8.5V8.5C8.5 8.77614 8.27614 9 8 9C7.72386 9 7.5 8.77614 7.5 8.5V8H2.5V8.5C2.5 8.77614 2.27614 9 2 9C1.72386 9 1.5 8.77614 1.5 8.5V7.5C1.5 7.22386 1.72386 7 2 7H7.5V6C6.67157 6 6 5.32843 6 4.5V3.5ZM8.5 5C8.77614 5 9 4.77614 9 4.5V3.5C9 3.22386 8.77614 3 8.5 3H7.5C7.22386 3 7 3.22386 7 3.5V4.5C7 4.77614 7.22386 5 7.5 5H8.5ZM0 11.5C0 10.6716 0.671573 10 1.5 10H2.5C3.32843 10 4 10.6716 4 11.5V12.5C4 13.3284 3.32843 14 2.5 14H1.5C0.671573 14 0 13.3284 0 12.5V11.5ZM1.5 11C1.22386 11 1 11.2239 1 11.5V12.5C1 12.7761 1.22386 13 1.5 13H2.5C2.77614 13 3 12.7761 3 12.5V11.5C3 11.2239 2.77614 11 2.5 11H1.5ZM6 11.5C6 10.6716 6.67157 10 7.5 10H8.5C9.32843 10 10 10.6716 10 11.5V12.5C10 13.3284 9.32843 14 8.5 14H7.5C6.67157 14 6 13.3284 6 12.5V11.5ZM7.5 11C7.22386 11 7 11.2239 7 11.5V12.5C7 12.7761 7.22386 13 7.5 13H8.5C8.77614 13 9 12.7761 9 12.5V11.5C9 11.2239 8.77614 11 8.5 11H7.5ZM12 11.5C12 10.6716 12.6716 10 13.5 10H14.5C15.3284 10 16 10.6716 16 11.5V12.5C16 13.3284 15.3284 14 14.5 14H13.5C12.6716 14 12 13.3284 12 12.5V11.5ZM13.5 11C13.2239 11 13 11.2239 13 11.5V12.5C13 12.7761 13.2239 13 13.5 13H14.5C14.7761 13 15 12.7761 15 12.5V11.5C15 11.2239 14.7761 11 14.5 11H13.5Z"
                                    fill="black" />
                            </svg>
                        </a></li>
                    <li class="nav-item"><a href="#page7"><svg width="30" height="30" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 15C4.13401 15 1 11.866 1 8C1 4.13401 4.13401 1 8 1C11.866 1 15 4.13401 15 8C15 11.866 11.866 15 8 15ZM8 16C12.4183 16 16 12.4183 16 8C16 3.58172 12.4183 0 8 0C3.58172 0 0 3.58172 0 8C0 12.4183 3.58172 16 8 16Z"
                                    fill="black" />
                                <path
                                    d="M11.3146 10.0135C11.5088 9.96749 11.7118 10.0415 11.831 10.2017C11.9501 10.3619 11.9625 10.5776 11.8625 10.7504C11.0852 12.0941 9.63114 13 7.96487 13C6.29861 13 4.84452 12.0941 4.0672 10.7504C3.96723 10.5776 3.97965 10.3619 4.09878 10.2017C4.21791 10.0415 4.4209 9.96749 4.61516 10.0135L4.62018 10.0146L4.63696 10.0186L4.70379 10.0338C4.76244 10.0471 4.84827 10.0662 4.9557 10.0892C5.17074 10.1352 5.4714 10.1966 5.81327 10.2579C6.50558 10.382 7.33522 10.5 7.96487 10.5C8.59452 10.5 9.42416 10.382 10.1165 10.2579C10.4583 10.1966 10.759 10.1352 10.974 10.0892C11.0815 10.0662 11.1673 10.0471 11.226 10.0338L11.2928 10.0186L11.3096 10.0146L11.3146 10.0135Z"
                                    fill="black" />
                                <path
                                    d="M4.7557 4.56649C5.51871 3.14228 8.77516 4.44588 5.70788 8C1.21232 6.40385 3.35789 3.7017 4.7557 4.56649Z"
                                    fill="black" />
                                <path
                                    d="M11.2443 4.56649C12.6421 3.7017 14.7877 6.40385 10.2921 8C7.22484 4.44588 10.4813 3.14228 11.2443 4.56649Z"
                                    fill="black" />
                            </svg>
                        </a></li>
                    <li class="nav-item"><a href="#page8"><svg width="30" height="30" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 3C1 2.44772 1.44772 2 2 2H14C14.5523 2 15 2.44772 15 3L1 3Z"
                                    fill="black" />
                                <path
                                    d="M8 11C9.10457 11 10 10.1046 10 9C10 7.89543 9.10457 7 8 7C6.89543 7 6 7.89543 6 9C6 10.1046 6.89543 11 8 11Z"
                                    fill="black" />
                                <path
                                    d="M0 5C0 4.44772 0.447715 4 1 4H15C15.5523 4 16 4.44772 16 5V13C16 13.5523 15.5523 14 15 14H1C0.447715 14 0 13.5523 0 13V5ZM3 5C3 6.10457 2.10457 7 1 7V11C2.10457 11 3 11.8954 3 13H13C13 11.8954 13.8954 11 15 11V7C13.8954 7 13 6.10457 13 5H3Z"
                                    fill="black" />
                            </svg>
                        </a></li>
                    <li class="nav-item"><a href="#page9"><svg width="30" height="30" viewBox="0 0 16 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0 4C0 2.89543 0.895431 2 2 2H14C15.1046 2 16 2.89543 16 4V12C16 13.1046 15.1046 14 14 14H2C0.895431 14 0 13.1046 0 12V4ZM2 3C1.44772 3 1 3.44772 1 4V4.2169L4.2347 6.15772C4.09269 6.47863 4.01419 6.82381 4.00168 7.18411L1 5.3831V11.1052L4.45256 8.98056C4.59907 9.25791 4.78174 9.53677 5.00221 9.8165L1.03376 12.2586C1.14774 12.6855 1.53715 13 2 13H14C14.4628 13 14.8523 12.6855 14.9662 12.2586L10.9978 9.81651C11.2183 9.53679 11.4009 9.25793 11.5475 8.98058L15 11.1052V5.3831L11.9983 7.18409C11.9858 6.82379 11.9073 6.47862 11.7653 6.15771L15 4.2169V4C15 3.44772 14.5523 3 14 3H2ZM8 5.99275C9.66439 4.282 13.8254 7.27581 8 11.125C2.17465 7.27581 6.33561 4.282 8 5.99275Z"
                                    fill="black" />
                            </svg>
                        </a></li>
                </ul>
            </nav>
            <section id="page2" class="page2">
                <div class="baseBg"
                    style="background-image: url('{{ asset('assets/img/assets_template1/bgPage3.png') }}')">
                    <div class="row" data-aos="zoom-in">
                        <div class="col-6 kiri" data-aos-duration="3000">
                            <img src="{{ asset('assets/img/assets_template1/hiasanKiri.png') }}" alt="">
                        </div>
                        <div class="col-6 kanan" data-aos-duration="3000">
                            <img src="{{ asset('assets/img/assets_template1/hiasanKanan.png') }}" alt="">
                        </div>
                    </div>
                    <div class="groom" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="text3">
                            <p class="fst-italic"
                                style="font-family: 'Sacramento', serif; font-size: 40px; color: #603912;">The Groom
                            </p>
                        </div>
                    </div>
                    <div class="shape2" style="background-color: #AE865E;">
                        <img class="bingkai" src="{{ asset('assets/img/assets_template1/bingkai.png') }}"
                            alt="">
                        <img class="bride" src="{{ asset($data['contentImage']['groom_image']) }}" alt="">
                    </div>
                    <div class="the-grooms" data-aos="zoom-in-down" data-aos-easing="linear"
                        data-aos-duration="3000">
                        <div class="text3">
                            <p class="mb-0 fs-1 fw-bolder" style="font-family: 'Playfair Display', serif">
                                {{ $data['event']['groom_name'] }}</p>
                            <p class="fs-6 fw-normal" style="font-family: 'Belanosima', serif">Putra
                                {{ $data['contentInvitation']['son'] }} dari bapak
                                {{ $data['contentInvitation']['groom_father'] }} dan ibu
                                {{ $data['contentInvitation']['groom_mother'] }} </p>
                        </div>
                    </div>
                </div>
            </section>
            <section id="page3" class="page3">
                <div class="baseBg"
                    style="background-image: url('{{ asset('assets/img/assets_template1/bgPage3.png') }}')">
                    <div class="row" data-aos="zoom-in">
                        <div class="col-6 kiri" data-aos-duration="3000">
                            <img src="{{ asset('assets/img/assets_template1/hiasanKiri.png') }}" alt="">
                        </div>
                        <div class="col-6 kanan" data-aos-duration="3000">
                            <img src="{{ asset('assets/img/assets_template1/hiasanKanan.png') }}" alt="">
                        </div>
                    </div>
                    <div class="groom" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="text3">
                            <p class="fst-italic"
                                style="font-family: 'Sacramento', serif; font-size: 40px; color: #603912;">The Bride
                            </p>
                        </div>
                    </div>
                    <div class="shape2" style="background-color: #AE865E;">
                        <img class="bingkai" src="{{ asset('assets/img/assets_template1/bingkai.png') }}"
                            alt="">
                        <img class="bride" src="{{ asset($data['contentImage']['bride_image']) }}" alt="">
                    </div>
                    <div class="the-grooms" data-aos="zoom-in-down" data-aos-easing="linear"
                        data-aos-duration="3000">
                        <div class="text3">
                            <p class="mb-0 fs-1 fw-bolder" style="font-family: 'Playfair Display', serif">
                                {{ $data['event']['bride_name'] }}</p>
                            <p class="fs-6 fw-normal" style="font-family: 'Belanosima', serif">Putri
                                {{ $data['contentInvitation']['daughter'] }} dari bapak
                                {{ $data['contentInvitation']['bride_father'] }} dan ibu
                                {{ $data['contentInvitation']['bride_mother'] }} </p>
                        </div>
                    </div>
                </div>
            </section>
            <section id="page4" class="page4">
                <div class="baseBg"
                    style="background-image: url('{{ asset('assets/img/assets_template1/Group38.png') }}')">
                    <div class="images-top-jw">
                        <img src="{{ asset('assets/img/assets_template1/top.png') }}" alt="">
                    </div>
                    <div class="containerResponsive">
                        <div class="shape" style="background-color: #603912;">
                            <div class="quotes" data-aos="zoom-in-up" data-aos-duration="3000">
                                <div class="text2">
                                    <h1>We Found Love</h1>
                                    <p>{!! $data['contentInvitation']['forewords'] !!}</p>
                                    {{-- <p>(QS. Ar-Rum : 21)</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="page5" class="page5">
                <div class="baseBg" style="background-color: #603912;">
                    <div class="row" data-aos="zoom-in">
                        <div class="col-6 kiri" data-aos-duration="3000">
                            <img src="{{ asset('assets/img/assets_template1/hiasanKiriPg4.png') }}" alt="">
                        </div>
                        <div class="col-6 kanan" data-aos-duration="3000">
                            <img src="{{ asset('assets/img/assets_template1/hiasanKananPg4.png') }}" alt="">
                        </div>
                    </div>
                    <div class="datess" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="text4">
                            <p class="fst-italic"
                                style="font-family: 'Sacramento', serif; color: #EAE3DB; font-size: 40px;">Save The
                                Date</p>
                        </div>
                    </div>
                    <div class="containerResponsive">
                        <div class="backgroundInside"
                            style="background-image: url('{{ asset('assets/img/assets_template1/Group6.png') }}')">
                            <div class="contentWrapper" data-aos="zoom-in" data-aos-duration="3000">
                                <div class="schedule">
                                    <p class="m-0"
                                        style="font-size: 32px; font-family: 'Playfair Display', serif; font-weight: bold;">
                                        JUMAT</p>
                                    <p class="m-0" style="font-size: 32px; font-family: 'Belanosima', serif">
                                        {{ $data['event']['wedding_date'] }}</p>
                                    <p class="m-0"
                                        style="font-size: 10px; font-family: 'Ruwudu', serif; color: #633734;">Pukul
                                        o7.00 WIB - Selesai</p>
                                    <p class="m-5"
                                        style="font-size: 10px; font-family: 'Ruwudu', serif; color: #633734; padding: 0px 40px 0px 40px">
                                        Bertempat di:
                                        {{ $data['event']['vanue'] }}</p>

                                    <a href="{{ $data['event']['maps'] }}" target="_blank" class="btn rounded-pill"
                                        style="background: #603912; color: white;">
                                        <svg style="margin-bottom: 5px" width="14" height="14"
                                            viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.1158 0C8.71693 0 7.48688 0.746337 6.80288 1.861H1.01158C0.453105 1.861 0 2.31411 0 2.87259V12.9054L6.91432 5.99107C7.1534 6.36341 7.42946 6.71422 7.69871 7.06808C7.74568 7.1298 7.7924 7.19292 7.83927 7.25535L7.16411 7.9305L9.2549 10.0213C9.30547 10.2224 9.34925 10.4339 9.38465 10.6579C9.38472 10.6584 9.38479 10.6589 9.38486 10.6593C9.40067 10.7576 9.396 10.8666 9.47479 11.0551C9.51419 11.1493 9.59171 11.2733 9.71868 11.36C9.84565 11.4467 9.99675 11.4774 10.1158 11.4774C10.2349 11.4774 10.386 11.4467 10.513 11.36C10.5291 11.349 10.5444 11.3373 10.5589 11.3253L12.139 12.9054V7.59928C12.2685 7.4175 12.4008 7.24177 12.5329 7.06808C13.2424 6.13572 14 5.22481 14 3.88417C14 1.74495 12.2551 0 10.1158 0ZM10.1158 1.02439C11.7016 1.02439 12.9756 2.29845 12.9756 3.88417C12.9756 4.84067 12.441 5.49721 11.7177 6.44774C11.1563 7.18552 10.5158 8.08238 10.1158 9.32993C9.71586 8.08238 9.07532 7.18552 8.51392 6.44774C7.79064 5.49721 7.25605 4.84067 7.25605 3.88417C7.25605 2.29845 8.53011 1.02439 10.1158 1.02439ZM2.86348 2.53536C3.34557 2.53536 3.78287 2.71853 4.11216 3.01884L3.59056 3.54044C3.39562 3.37316 3.14141 3.27034 2.86348 3.27034C2.24573 3.27034 1.74526 3.77089 1.74526 4.38996C1.74526 5.00771 2.24573 5.50819 2.86348 5.50819C3.38245 5.50819 3.74073 5.2013 3.87377 4.77191H2.86348V4.06334L4.61135 4.06593C4.76414 4.78906 4.48623 6.24456 2.86348 6.24456C1.83873 6.24456 1.00898 5.41339 1.00898 4.38996C1.00898 3.36652 1.83873 2.53536 2.86348 2.53536ZM10.1158 2.70402C9.46383 2.70402 8.93568 3.23217 8.93568 3.88417C8.93568 4.53617 9.46383 5.06432 10.1158 5.06432C10.7678 5.06432 11.296 4.53617 11.296 3.88417C11.296 3.23217 10.7678 2.70402 10.1158 2.70402ZM6.0695 9.02512L1.09461 14H11.0444L6.0695 9.02512Z"
                                                fill="white" />
                                        </svg>
                                        Google Maps</a>
                                </div>
                                <div class="countDown">
                                    <div
                                        style="background-image: url('{{ asset('assets/img/assets_template1/Polygon.png') }}'); background-repeat: no-repeat;">
                                        <span style="margin-top: 11px; color: white;" id="days"></span></br>
                                        <span style="margin-top: 11px; color: white;">Hari</span>
                                    </div>
                                    <div
                                        style="background-image: url('{{ asset('assets/img/assets_template1/Polygon.png') }}'); background-repeat: no-repeat;">
                                        <span style="margin-top: 11px; color: white;" id="hours"></span></br>
                                        <span style="margin-top: 11px; color: white;">Jam</span>
                                    </div>
                                    <div
                                        style="background-image: url('{{ asset('assets/img/assets_template1/Polygon.png') }}'); background-repeat: no-repeat;">
                                        <span style="margin-top: 11px; color: white;" id="minutes"></span><br>
                                        <span style="margin-top: 11px; color: white;">Menit</span>
                                    </div>
                                    <div
                                        style="background-image: url('{{ asset('assets/img/assets_template1/Polygon.png') }}'); background-repeat: no-repeat;">
                                        <span style="margin-top: 11px; color: white;" id="seconds"></span> <br>
                                        <span style="margin-top: 11px; color: white;">Detik</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="page6" class="page6">
                <div class="baseBg"
                    style="background-image: url('{{ asset('assets/img/assets_template1/Group17.png') }}')">
                    <div class="row" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="col-6 kiri">
                            <img src="{{ asset('assets/img/assets_template1/hiasanKiriPg4.png') }}" alt="">
                        </div>
                        <div class="col-6 kanan">
                            <img src="{{ asset('assets/img/assets_template1/hiasanKananPg4.png') }}" alt="">
                        </div>
                    </div>

                    <div class="roundown" data-aos="zoom-in-down" data-aos-duration="3000">
                        <div class="text4">
                            <p class="fst-italic"
                                style="font-family: 'Sacramento', serif; color: #FFFFFF; font-size: 32px">Susunan Acara
                            </p>
                        </div>
                    </div>

                    <div class="container py-5">
                        <div class="timeline">

                            @foreach ($data['schedule'] as $sc)
                                <div class="timeline-item-desc">
                                    <div class="timeline-content text-end" data-aos="zoom-in-left"
                                        data-aos-easing="linear" data-aos-duration="3000" style="padding-left: 8px;">
                                        <h6>{{ $sc['title'] }}</h6>
                                        <p>{{ $sc['description'] }}</p>
                                    </div>
                                </div>

                                <div class="timeline-item-times">
                                    <div class="timeline-time text-end" data-aos="zoom-in-right"
                                        data-aos-easing="linear" data-aos-duration="3000">
                                        {{ $sc['event_time'] }} WIB <svg width="27" height="31"
                                            viewBox="0 0 27 31" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect width="27" height="31" fill="url(#pattern0_23_29)" />
                                            <defs>
                                                <pattern id="pattern0_23_29" patternContentUnits="objectBoundingBox"
                                                    width="1" height="1">
                                                    <use xlink:href="#image0_23_29"
                                                        transform="matrix(0.0111111 0 0 0.00967742 0 0.0645161)" />
                                                </pattern>
                                                <image id="image0_23_29" width="90" height="90"
                                                    preserveAspectRatio="none"
                                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFMklEQVR4nO2c34tVVRTHF0ZG/iisLNPA0aweopd8iqKZSSiI3gKtCCWk8sEHH3qop4rMogb8kZb9sh/CFFF/gYhFhQyVkiAjkTZWhBQS+TC/4s4nNncPiJ21z7l37tlnn332By4M9x5mffe+66699t5rb5FEIpGIF2Ax8BTwvX2ZvxdXrSsagLXA28AF/s8F+9naqnXG4L1FSV7eI+8tSvLyHnpvUZKX0xvvLUpzvRz4Ev8ckaYBDFbQ0QPSRPDr1d9IU8GvVzfTmz17dXO92bNXN9ubPXl18mZPXj0oTQe4AXgOOF1iR5v//ayxJQ3t4FeBcfwxaWeHN0nsAFcCL3ju4EsZt1/yIokR4D5gjHA4E1U2AlwODAGtDjrBPHsM2GVX9gaA1cASYL59LbHvDdhndgPHu7DzmtEodQa4Hviqg0YfAjYC18zB5rXAJuBwB51+BLhO6ghwa8FQMQ68AawsQUMfsBeYKBhK1kidAO4AzhXw4Pd8pF3AMuAAMJOj6Q/gdqmRJ/+Z06CTwF0VaLsbGM3Rdi54zwaWA7/kNOQDYGGFGhcBHxeY5CyTgLOLb3NCxVYJBGBbzmD5dZDZiE2vNKaADRIYwKPAtEP3TgkJYJ1joGmF2MmzAI84PNu06QEJAeAq4KzDK7ZK4NgwojEWROkZ8LpD5AGpCbgHyB1Vi1tlV8W0FK6y7KLLbOSU0paJMiZUnYgzk4AsWlXkyXMFuMcx1rxTlagVNpvI4l2pKcBHSpvML3d5FYJecaxd1HY3g/akS1sbecm3mHnAb4qYPVJzgDeVtpk2X+ZTyP2O2FzdoNHbQV7Lrdf5FLJPEXFIIoH2GnW1v1i7dpvFRokE4AmljT/7ErDaETa63hkJDWCpI9UrPzyadQvF+DGJDOBHpa0P+zButuqz2CWRAeypbEoOfKEYf1IiA9iitPUzH8a1Qz33SnNqAkd8GDcbmFn0SWSgD/y/+zD+j2I8moxjFlProbT1bykb4F/F+HyJDOAKpa3TPoxrK3ZN6uhJH8bPp9DBXz46WqvbaNJgeMaH8R8U4/3SnPTuOx/GP1WMN2nCMuzD+IuK8d0SGbSrXLN43lfBSRbHJTKAE0pb1/valNWWSetZzK0X0WvLpCvEB8BPioBNEgnAZqWNoz5FvKWIOCzxb2Xt9V3UqIWPvkjy55bSxgHf5Qa/Vv6NlwSw31HwOM+3mB2KmIlgq+WLD/ZaPeF28Y056usQ9L7UFOCg0qZJb9lGhihztjqLmTpOyXEXOe6retDQlk1H63Temvb9e1raOlX5IO/YFTd8IvUPGYaXQxC4MOdoxTYJHOAZh36zLLxAQgB4KOew0GMSKMDjDu3m/QclJMxRMYdXTIfY2baTXcffhiQ07NUOIw7RrZDCiA0XrrPhR4M80NnBEeXPgasrzi6GczSaatkbJYJD96dMzlqBtn5HCjeL0X6L1OjK4rzOngE+9HEAx06rDxa4RsJovlPqBHBbgTAyO7U1Z0ZWlTSh2u9YKrg0XNTDk5WYPUIxWnYN2FTaL53jzshmeztk0at+jgYfkwtmIzsL/GwvZsYWgZv65Kfttv/Npr7vosurzN1Ja+ztY1vssye6sDMUbHYxh0nNWcJhLLjJSK8AFtgLBovEzLKYtneL1GbBq2uAlbaxPm90nLI3GIR9X1KJadf2kkPKmLXh/xx3aNDegxy0aV7eLV5FGLWHTvu97/HVMC3cYEqvzJq2KSq0N3edtyFgyv592n42bJ9dnzw3kUgkEolEIpFIJKQz/gOgXmJmKIDupAAAAABJRU5ErkJggg==" />
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                            @endforeach



                            {{-- <div class="timeline-item-desc">
                                <div class="timeline-content" data-aos="zoom-in-right" data-aos-easing="linear" data-aos-duration="3000" style="padding-left: 8px;">
                                    <h6>Resepsi Nikah</h6>
                                    <p>Akad dibuka dengan Lorem ipsum dolor sit amet, consectetur adipisicing elit, </p>
                                </div>
                            </div>


                            <div class="timeline-item-times">
                                <div class="timeline-time text-start" data-aos="zoom-in-left" data-aos-easing="linear" data-aos-duration="3000"> <svg width="35" height="26" viewBox="0 0 35 26" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="35" height="26" fill="url(#pattern0_23_38)"/>
                                    <defs>
                                    <pattern id="pattern0_23_38" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_23_38" transform="matrix(0.00825397 0 0 0.0111111 0.128571 0)"/>
                                    </pattern>
                                    <image id="image0_23_38" width="90" height="90" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAACf0lEQVR4nO3dPWsVaRzG4UEXjYsggmAlgiK4nVY2fgAFsbJRIRYWWy7YiOAuFoLamUbsxEJQmy0WBbFTo4jINsI2u6AsayO+LAR8CXrJgYHDgbyck5yZSWbu6wvkmV/+TJInM88pioiIiIiIiGgW1uAnnMAVPMc7PMHuhpe3emErDuM87uOD+U03vd5VAT9iP07hFl4azWzT17AiYQcmMYVH+GSZmr6mFQFrcRx38f9yoyb0HLAFD1Ws6DL8gMdVR05ofq4jckIzndD13DpmErqe0LUpukyNii5Tn/dFl6nP70WXqcd/2FV0mep8LH91PNfb5Su6zvi8xh84Xe7yTTR9bSuKpZkpd/Smyh2+7U1fx4pn+Gm9jV/KaV3X9LpXHfPr3VsPYnPTa2wF82h6Xa0joRO6VWSiE7pVZKITulVkohO6VWSiE7pVZKITulVkohO6VWSiE7pVZKITulVkohO6VWSiE7pVZKJre+1tTjV8+e7Ab3NnTuhxBd6Ja/NFTujlxd2Ls3iKrwtFTujRwq7HIVzFv4uFTejRJ3cbLuPtqHEz0cMFnsClcRz30DPqN7gTek/c48U4Aif0wpFfGbN6R6XDR0AUMRC6905JJYoYmOZRD5Aa1pd07ofuvchTlXcJ3Q99scLQrxK6H/pBhaH/TOh+6H8qDH0zofuh31cY+lxC90PPVhj6SEL3Q7+pKPJnbEro6n8Y3kvkwb8KL1QU+mRCD4beU9GRPBMJXf3tYzKR59692zfM//+GdDuRF4Azlm8aGxN6EeXZRkt1HRsSeUg4Vp59NKxnOJDAS3/E4Chu4K/yUyS+lR/R8Tfu4NfeMx4JHBERERERUdTnO+U5TIh6C+LFAAAAAElFTkSuQmCC"/>
                                    </defs>
                                    </svg>
                                    11.00 WIB</div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </section>
            <section id="page7" class="page7">
                <div class="baseBg"
                    style="background-image: url('{{ asset('assets/img/assets_template1/Group36.png') }}')">
                    <div class="our-moments">
                        <div class="text4">
                            <p class="fst-italic"
                                style="font-family: 'Sacramento', serif; color: #603912; font-size: 40px;">Our Moment
                            </p>
                        </div>
                    </div>
                    <div class="imgGround">
                        <img src="{{ asset($data['contentImage']['banner1']) }}" alt="">
                    </div>

                    <div class="wrapper">
                        @foreach ($data['contentImage']['our_moment'] as $dt_ourmoment)
                            <div class="cards">
                                <img src="{{ asset($dt_ourmoment) }}" alt="">
                            </div>
                        @endforeach
                        {{-- <div class="cards">
                            <img src="{{asset('assets/img/assets_template1/romantic-engagement-happiness-couple-elegance.png')}}" alt="">
                        </div>
                        <div class="cards">
                            <img src="{{asset('assets/img/assets_template1/romantic-engagement-happiness-couple-elegance.png')}}" alt="">
                        </div>
                        <div class="cards">
                            <img src="{{asset('assets/img/assets_template1/romantic-engagement-happiness-couple-elegance.png')}}" alt="">
                        </div>
                        <div class="cards">
                            <img src="{{asset('assets/img/assets_template1/romantic-engagement-happiness-couple-elegance.png')}}" alt="">
                        </div>
                        <div class="cards">
                            <img src="{{asset('assets/img/assets_template1/romantic-engagement-happiness-couple-elegance.png')}}" alt="">
                        </div>
                        <div class="cards">
                            <img src="{{asset('assets/img/assets_template1/romantic-engagement-happiness-couple-elegance.png')}}" alt="">
                        </div>
                        <div class="cards">
                            <img src="{{asset('assets/img/assets_template1/romantic-engagement-happiness-couple-elegance.png')}}" alt="">
                        </div> --}}
                    </div>

                    <div class="imgGround2">
                        <img src="{{ asset($data['contentImage']['banner2']) }}" alt="">
                        <div class="quotes2">
                            <p class="text-center fw-bold"
                                style="font-family: 'Ruwudu', serif; color: #603912; font-size: 12px;">
                                "Creating memories is a priceless gift. Memories last a lifetime; objects last only a
                                short time."
                            </p>
                        </div>
                    </div>


                </div>
            </section>
            <section id="page8" class="page8">
                <div class="baseBg"
                    style="background-image: url('{{ asset('assets/img/assets_template1/Group17.png') }}')">
                    <div class="row" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="col-6 kiri">
                            <img src="{{ asset('assets/img/assets_template1/hiasanKiriPg4.png') }}" alt="">
                        </div>
                        <div class="col-6 kanan">
                            <img src="{{ asset('assets/img/assets_template1/hiasanKananPg4.png') }}" alt="">
                        </div>
                    </div>

                    <div class="datess" data-aos="zoom-in-down" data-aos-duration="3000">
                        <div class="text4">
                            <p class="fs-1 fst-italic"
                                style="font-family: 'Playfair Display', serif; color: #f8e2cc;">Titip Hadiah</p>
                        </div>
                    </div>

                    <div class="restu" data-aos="zoom-in-left" data-aos-duration="3000">
                        <p class="text-center fw-bold"
                            style="font-family: 'Ruwudu', serif; color: #ecd4bc; font-size: 10px;">
                            Doa restu bapak/ibu sekalian merupakan karunia berarti bagi kami. dan jika memberi merupakan
                            tanda kasih, bapak/ibu dapat memberi kado secara cashless. Terima kasih
                        </p>
                    </div>

                    @foreach ($data['gift'] as $dt)
                        <div class="mb-3 row" data-aos="zoom-in-left" data-aos-duration="3000">
                            <div class="mx-auto ml-0 shadow col-6 col-md-6 cards-amplop">
                                <div class="itemss">
                                    <p class="mb-0"
                                        style="font-size: 14px; font-family: 'Montserrat', sans-serif; color: #633734;">
                                        Kirim Amplop</p>
                                    <img src="{{ asset('storage/image/origin/' . $dt['bank_account']['image']['original_name']) }}"
                                        alt="BCA Logo">
                                    <p class="mb-0"
                                        style="font-size: 14px; font-family: 'Montserrat', sans-serif; color: #633734;">
                                        {{ $dt['receiver_name'] }}</p>
                                    <p class="mb-0" id="{{ $dt['no_req'] }}"
                                        style="font-size: 14px; font-family: 'Montserrat', sans-serif; color: #633734;">
                                        {{ $dt['no_req'] }}</p>
                                    <button class="btn" onclick="copyToClipboard({{ $dt['no_req'] }})"
                                        style="background-color: #603912; color: #FFFFFF; width: 95px; height: 18px; border-radius: 3px; font-size: 9px; padding: 2px;">
                                        <svg width="15" height="12" viewBox="0 0 15 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect width="15" height="12" fill="url(#pattern0_19_86)" />
                                            <defs>
                                                <pattern id="pattern0_19_86" patternContentUnits="objectBoundingBox"
                                                    width="1" height="1">
                                                    <use xlink:href="#image0_19_86"
                                                        transform="matrix(0.00888889 0 0 0.0111111 0.1 0)" />
                                                </pattern>
                                                <image id="image0_19_86" width="90" height="90"
                                                    preserveAspectRatio="none"
                                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAACJklEQVR4nO3cMW4TQRiG4RVBOAXhAJAaKRdIR0ETKVGuQQek9EFAuUgKTmAQFfYZSCqqCBC4etHKjhSheHZtr79/dvZ7+vHOvl5t7N/KVpWZmZlZsYB94AL4CvxCYw5MgONqCIBDYEacP8BJNYAreRYYeRixWdwuclFubBb35JyUGRv4GRT096BiE+dVw5v8FzivSkGQ5bGHE5sg944/jNgE+W8P5ccmyAP7KDs2QVbspdzYBEnsp8zYBGnYU3mxCdJiX/nGTo06E2tCtDyf19l9g2wadSbWhVjjvPKJ3WbUmVgbYs3zaxP7OItRZ2JtlOcdx550EnPbUWdibZTxBueZij3fOmQXo87E2ij174XjLq/sTmI2HLzRNmv7wqFFHFrEoUUcWsShRRxaxKFFHFrEoUUcWsShRRxaxKFFHFrEoUUcWsShRRxaxKFFHFrEoUUcWsShRRxaxKFFHFrEoUUcWsShRRxaxKFFHHpIoYGDzB6M0rXbXEK/7Mmjfjb1JZfQpyvWvqcMb3MJ/XHF2hEwpd++AU9yCf0deJz4r9sp/Y38YueR1whde5N4jRHwrr7X9eAPZL2/z/XtQnIlbxD6ZtWnD2thzavhE7DnsLsPXfsAPHLs3YeuXQHPHHv3oWs/lk9GePDTiHUX+s41cAmcAUfAU0fu9orOTtZvMAWpckZBqpz14JtcPqPObXjUKeJRp4hHnUIedQp51GlmZmZmZlaV4R9HKiSqDI7QLgAAAABJRU5ErkJggg==" />
                                            </defs>
                                        </svg>
                                        Salin Rekening
                                    </button>

                                </div>
                            </div>
                        </div>
                    @endforeach


                    <br>
                    <br>
                </div>
            </section>
            <section id="page9" class="page9">
                <div class="baseBg"
                    style="background-image: url('{{ asset('assets/img/assets_template1/Group36.png') }}')">
                    <div class="images-top-jw">
                        <img src="{{ asset('assets/img/assets_template1/top.png') }}" alt="">
                    </div>
                    <div class="wishes" data-aos="zoom-in-left" data-aos-duration="3000">
                        <div class="text4">
                            <p class="fst-italic"
                                style="font-family: 'Playfair Display', serif; color: #603912; font-size: 40px; font-weight: bold; text-align: center;">
                                HARAPAN</p>
                        </div>
                    </div>

                    <div class="container-form-card">
                        <div class="form-card">
                            <form id="message-form">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $data['event']['id'] }}">
                                <div class="mb-3">
                                    <input type="text" name="guest_name" id="guest_name" class="form-control"
                                        placeholder="Nama">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="message" id="message" rows="4" placeholder="Ucapan & Doa"></textarea>
                                </div>
                                <button type="submit" class="btn btn-submit">Kirim</button>
                            </form>
                        </div>

                        <div class="comment">
                            @foreach ($data['messages'] as $message)
                                <div class="card-comment">
                                    <strong>{{ $message->guest_name }}</strong> - <span class="badge bg-dark">{{ $message->created_at->format('H:i') }}</span>
                                    <p>{{ $message->message }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/templates.js') }}"></script>

    <script>
        let weddingDate = `{{ $data['event']['wedding_date'] }}`;
        console.log(weddingDate);

        var countDownDate = new Date(weddingDate).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days;
            document.getElementById("hours").innerText = hours;
            document.getElementById("minutes").innerText = minutes;
            document.getElementById("seconds").innerText = seconds;

            // If the count down is finished, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("days").innerText = "0";
                document.getElementById("hours").innerText = "0";
                document.getElementById("minutes").innerText = "0";
                document.getElementById("seconds").innerText = "0";
            }
        }, 1000);

        let base64_image = `{{ $data['guest']['base64Image'] }}`;
        console.log(base64_image);

        $('#pushupBtn').on('click', function() {
            var audio = document.getElementById("audio-player");
            audio.play();
        });

        $(document).on('click', '#barcode-btn', function(event) {
            var imageUrlBase64 = base64_image;

            swal.fire({
                title: 'Berikut Barcode Anda!',
                text: 'Scan barcode anda pada saat akan memasuki venue!',
                imageUrl: imageUrlBase64,
                imageWidth: 200,
                imageHeight: 200,
                imageAlt: 'Barcode image',
                showCancelButton: true,
                cancelButtonText: 'OK',
                confirmButtonText: 'Unduh Barcode',
                reverseButtons: true,
                didOpen: () => {
                    document.querySelector('.swal2-confirm').addEventListener('click', function() {
                        var link = document.createElement('a');
                        link.href = imageUrlBase64;
                        link.download = 'barcode.png';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    });
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('message-form');
            const commentContainer = document.querySelector('.comment');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                const response = await fetch('/invitation/{{ $data['event']['slug'] }}/message', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                if (response.ok) {
                    const result = await response.json();
                    addMessageToContainer(result.message, true); // Prepend the new message
                    form.reset();
                } else {
                    // Handle errors
                    console.error('Failed to send message');
                }
            });

            function addMessageToContainer(message, prepend = false) {
                const messageElement = document.createElement('div');
                messageElement.classList.add('card-comment');
                messageElement.innerHTML = `
                    <strong>${message.guest_name}</strong> - <span class="badge bg-dark">${new Date(message.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                    <p>${message.message}</p>
                `;
                
                if (prepend) {
                    commentContainer.prepend(messageElement);
                } else {
                    commentContainer.appendChild(messageElement);
                }
            }

            async function fetchMessages() {
                const response = await fetch('/invitation/{{ $data['event']['slug'] }}/messages');
                if (response.ok) {
                    const messages = await response.json();
                    commentContainer.innerHTML = ''; // Clear existing messages
                    messages.forEach(message => {
                        addMessageToContainer(message);
                    });
                }
            }

            // Fetch messages every 5 seconds
            setInterval(fetchMessages, 5000);
        });
    </script>
</body>

</html>
