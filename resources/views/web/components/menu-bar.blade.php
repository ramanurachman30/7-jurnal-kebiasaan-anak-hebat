<div class="w-100 py-7 bg-light shadow-lg" id="menu"
    data-kt-sticky="true"
    data-kt-sticky-name="docs-sticky-summary"
    data-kt-sticky-offset="@section('menu-offset') {default: false, xl: '700px'} @show"
    data-kt-sticky-width="{lg: '250px', xl: '300px'}"
    data-kt-sticky-left="auto"
    data-kt-sticky-top="96px"
    data-kt-sticky-animation="false"
    data-kt-sticky-zindex="90"
>
    <div class="container">
        <div class="menu menu-column flex-nowrap d-flex justify-content-between menu-rounded menu-lg-row menu-title-gray-600 menu-state-title-primary nav nav-flush fs-5 fw-semibold" id="kt_landing_menu">
            <div class="d-flex justify-content-start">
                <div class="menu-item">
                    <a class="menu-link bg-dark text-muted nav-link active py-3 px-4 px-xxl-6" href="#kt_body" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">{{ __('Home') }}</a>
                </div>
                <div class="menu-item">
                    <a class="text-muted nav-link py-3 px-4 px-xxl-6" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-end">{{ __('Profile') }}</a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3 mt-5" data-kt-menu="true" style="">
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                {{ __('PROFILE') }}
                            </div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Visi, Misi dan Tujuan') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Sejarah Singkat') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Sarana dan Prasarana') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Struktur Organisasi') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Kepala Sekolah') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('kemitraan') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Program Kerja') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Kondisi Siswa') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Prestasi') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="text-muted nav-link py-3 px-4 px-xxl-6" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-end">{{ __('Guru') }}</a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3 mt-5" data-kt-menu="true" style="">
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                {{ __('GURU') }}
                            </div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Direktori Guru') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Kisi Kisi Ujian') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Kalender Akademik') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="text-muted nav-link py-3 px-4 px-xxl-6" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-end">{{ __('Siswa') }}</a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3 mt-5" data-kt-menu="true" style="">
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                {{ __('SISWA') }}
                            </div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Direktori Siswa') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Prestasi Siswa') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Extrakurikuler') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('OSIS') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Beasiswa') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="text-muted nav-link py-3 px-4 px-xxl-6" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-end">{{ __('Alumni') }}</a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3 mt-5" data-kt-menu="true" style="">
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                {{ __('ALUMNI') }}
                            </div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Info Siswa') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Direktori Siswa') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="text-muted nav-link py-3 px-4 px-xxl-6" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-end">{{ __('Jurusan') }}</a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3 mt-5" data-kt-menu="true" style="">
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                {{ __('JURUSAN') }}
                            </div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Akutansi dan Keuangan Lembaga') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Bisnis Daring dan Pemasaran') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Komputer') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="text-muted nav-link py-3 px-4 px-xxl-6" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-end">{{ __('Fitur') }}</a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3 mt-5" data-kt-menu="true" style="">
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                {{ __('FITUR') }}
                            </div>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Berita') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Agenda') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Buku Tamu') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Galery Photo') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Administrasi Keuangan') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Daftar Blog') }}
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">
                                {{ __('Peta Situs') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item">
                    <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#kt_body" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">{{ __('Perpustakaan') }}</a>
                </div>
                <div class="menu-item">
                    <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#kt_body" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">{{ __('PPDB') }}</a>
                </div>
                <div class="menu-item">
                    <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#kt_body" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">{{ __('Blog') }}</a>
                </div>
                <div class="menu-item">
                    <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#kt_body" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">{{ __('Kontak Sekolah') }}</a>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="d-flex align-items-center ms-1 ms-lg-3" data-bs-toggle="tooltip" data-bs-placement="left" title="{{ __('Cari berita') }}">
                    <a href="#" class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="{default:'click', lg: 'click'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-magnifier fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown p-7 w-325px w-md-375px" data-kt-menu="true" style="">
                        <div data-kt-search-element="wrapper">
                            <form data-kt-search-element="form" class="w-100 position-relative mb-3" autocomplete="off">	
                                <i class="ki-duotone ki-magnifier fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" class="search-input  form-control form-control-flush ps-10" name="search" value="" placeholder="{{ __('Search') }}..." data-kt-search-element="input">
                                <span class="search-spinner  position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-1" data-kt-search-element="spinner">
                                    <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            
                <div class="d-flex align-items-center ms-1 ms-lg-3">
                    <a href="#" class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-night-day theme-light-show fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                            <span class="path8"></span>
                            <span class="path9"></span>
                            <span class="path10"></span>
                        </i>
                        <i class="ki-duotone ki-moon theme-dark-show fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu" style="">
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2 active" data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>            </span>
                                <span class="menu-title">
                                    Light
                                </span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-moon fs-2"><span class="path1"></span><span class="path2"></span></i>            </span>
                                <span class="menu-title">
                                    Dark
                                </span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-screen fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>            </span>
                                <span class="menu-title">
                                    System
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>