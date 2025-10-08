@if (Auth::allowedUri('user.list') ||
        Auth::allowedUri('roles.list') ||
        Auth::allowedUri('priveleges.list') ||
        Auth::allowedUri('sysparams.list'))
    <div class="pt-5 menu-item">
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">{{ __('User Management') }}</span>
        </div>
    </div>
    @if (Auth::allowedUri('event.list'))
        <div class="menu-item position-relative">
            <!--begin:Menu link-->
            <a class="menu-link" href="{{ url('admin/event') }}">
                <span class="menu-icon">
                    <i class="bi bi-arrows-fullscreen"></i>
                </span>
                <span class="menu-title">{{ __('Event') }}</span>
            </a>
            <!--end:Menu link-->
        </div>
    @endif
@endif
