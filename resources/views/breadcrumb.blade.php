@section('container-breadcrumb')
    <div id="breadcrumb" class="container-breadcrumb">
        <div class="container gap-5 d-flex justify-content-center justify-content-md-between align-items-center">
        @section('breadcrumb')
            <nav style="--bs-breadcrumb-divider: '/'" aria-label="breadcrumb"
                class="d-none scrollbar-none d-md-block overflow-auto">
                <ol class="breadcrumb align-items-center flex-nowrap gap-2">
                    <li class="breadcrumb-item btn">
                        <a class="ps-3" href="{{ URL::to('/') }}">{{ __('Home') }}
                        </a>
                    </li>
                    @foreach (request()->segments() as $segment)
                        @if ($segment == 'id' || $segment == 'en')
                            @continue
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">
                            {{-- <a href="{{ url()->current() }}"> --}}
                            {{ ucwords(str_replace('-', ' ', $segment)) }}
                            {{-- </a> --}}
                        </li>
                    @endforeach
                </ol>
            </nav>
        @show

        @section('dropdown-page')
            <div class="dropdown dropdown-page">
                <button class="btn btn-dropdown btn-yellow p-x-2 border-radius-1 dropdown-toggle" type="button"
                    id="dropdown-page" data-bs-toggle="dropdown" aria-expanded="false">
                    <small class="py-1">Dropdown button</small>
                </button>
                <ul class="text-white rounded-md dropdown-menu dropdown-menu-end list-unstyled bg-blue"
                    aria-labelledby="dropdown-page">
                    <h3 class="menu-title">Investment Outlook</h3>
                    <li>
                        <hr class="my-1">
                        <a class="rounded-md dropdown-item d-flex column-gap-md align-items-center justify-content-between"
                            href="#">
                            Option Dropdown Page
                            <span class="icon-olarrow"></span>
                        </a>
                    </li>
                    <li>
                        <hr class="my-1">
                        <a class="rounded-md dropdown-item d-flex column-gap-md align-items-center justify-content-between"
                            href="#">
                            Option Dropdown Page
                            <span class="icon-olarrow"></span>
                        </a>
                    </li>
                    <li>
                        <hr class="my-1">
                        <a class="rounded-md dropdown-item d-flex column-gap-md align-items-center justify-content-between"
                            href="#">
                            Option Dropdown Page
                            <span class="icon-olarrow"></span>
                        </a>
                    </li>
                </ul>
            </div>
        @show
    </div>
</div>
@show
