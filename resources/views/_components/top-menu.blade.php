<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
    <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
        <div class="px-2 my-5 menu menu-rounded menu-column menu-lg-row my-lg-0 align-items-stretch fw-semibold px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                <span class="menu-link">
                    <span class="menu-title">{{ __(ucwords(str_replace("_", " ", request()->segment(2)))) }}</span>
                    <span class="menu-arrow d-lg-none"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="flex-shrink-0 app-navbar">
        <div class="app-navbar-item ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
            <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                <img src="{{ Auth::getImage() }}" alt="user" />
            </div>
            <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold fs-6 w-275px" data-kt-menu="true">
                <div class="px-3 menu-item">
                    <div class="px-3 menu-content d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <img alt="Logo" src="{{ Auth::getImage() }}" />
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bold d-flex align-items-center fs-5">{{ ucwords(Auth::user()->first_name) . ' ' . ucwords(Auth::user()->last_name) }}</div>
                            <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                        </div>
                    </div>
                </div>
                <div class="my-2 separator"></div>
                <div class="px-5 menu-item">
                    <a href="{{ url('admin/user/profile') }}" class="px-5 menu-link">My Profile</a>
                </div>
                <div class="my-2 separator"></div>
                <div class="px-5 menu-item" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                    <?php
                        $flags = [
                            'en' => 'assets/media/flags/united-states.svg',
                            'id' => 'assets/media/flags/indonesia.svg'
                        ];
                    ?>
                    <a href="#" class="px-5 menu-link">
                        <span class="menu-title position-relative">{{ __('Language') }}
                        <span class="px-3 py-2 rounded fs-8 bg-light position-absolute translate-middle-y top-50 end-0">{{ strtoupper(App::getLocale()) }}
                        <img class="w-15px h-15px rounded-1 ms-2" src="{{ asset($flags[App::getLocale()]) }}" alt="" /></span></span>
                    </a>
                    <div class="py-4 menu-sub menu-sub-dropdown w-175px">
                        @foreach (Config::get('languages') as $lang => $language)
                            <div class="px-3 menu-item">
                                <a href="{{ url('admin/lang', $lang) }}" class="menu-link d-flex px-5 {{ $lang == App::getLocale() ? "active" : "" }}">
                                <span class="symbol symbol-20px me-4">
                                    <img class="rounded-1" src="{{ asset($flags[$lang]) }}" alt="" />
                                </span>{{ $language }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <form action="{{ url('admin/logout') }}" class="px-5 menu-item" id="logout-form" method="POST">
                    @method("POST")
                    @csrf
                    <a class="px-5 menu-link" onclick="$('#logout-form').submit()">Sign Out</a>
                </form>
            </div>
        </div>
    </div>
    </div>
