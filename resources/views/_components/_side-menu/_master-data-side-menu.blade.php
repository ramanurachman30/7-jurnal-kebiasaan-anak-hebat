@if (Auth::allowedUri('organizations.list') ||
        Auth::allowedUri('provinces.list') ||
        Auth::allowedUri('head_titles.list') ||
        Auth::allowedUri('vocabularies.list') ||
        Auth::allowedUri('vocabularies.list') ||
        Auth::allowedUri('mailchimps.list') ||
        Auth::allowedUri('privacy_and_terms.list') ||
        Auth::allowedUri('link_collections.list'))
    <div class="pt-5 menu-item">
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">{{ __('Master Data') }}</span>
        </div>
    </div>

    @if (Auth::allowedUri('head_titles.list'))
        <div class="menu-item position-relative">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ url('admin/head_titles') }}">
                <span class="menu-icon">
                    <i class="bi bi-arrows-fullscreen"></i>
                </span>
                <span class="menu-title">{{ __('Head Title') }}</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif

    @if (Auth::allowedUri('link_collections.list'))
        <div class="menu-item position-relative">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ url('admin/link_collections') }}">
                <span class="menu-icon">
                    <i class="bi bi-arrows-fullscreen"></i>
                </span>
                <span class="menu-title">{{ __('Links') }}</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    @if (Auth::allowedUri('link_collections.list'))
        <div class="menu-item position-relative">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ url('admin/menu') }}">
                <span class="menu-icon">
                    <i class="bi bi-arrows-fullscreen"></i>
                </span>
                <span class="menu-title">{{ __('Menu') }}</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    @if (Auth::allowedUri('bank.list'))
        <div class="menu-item position-relative">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ url('admin/bank') }}">
                <span class="menu-icon">
                    <i class="bi bi-bank"></i>
                </span>
                <span class="menu-title">{{ __('Bank') }}</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
    @if (Auth::allowedUri('template.list'))
        <div class="menu-item position-relative">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ url('admin/template') }}">
                <span class="menu-icon">
                    <i class="bi bi-arrows-fullscreen"></i>
                </span>
                <span class="menu-title">{{ __('Template') }}</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
@endif
