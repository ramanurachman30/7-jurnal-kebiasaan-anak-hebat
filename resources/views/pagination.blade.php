@if ($paginator->hasPages())
<div>
    <hr>
    <ul class="justify-between pagination p-y-2">
        @if ($paginator->onFirstPage())
            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                <li class="page-item">
                    <a class="page-item" href="#" rel="prev">
                        <span class="icon-olstart"></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-item" href="#" rel="prev">
                        <span class="icon-olprev"></span>
                    </a>
                </li>
            </div>
        @else
            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                <li class="page-item">
                    <a class="page-item" href="{{ request()->url() }}" rel="prev">
                        <span class="icon-olstart"></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-item" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <span class="icon-olprev"></span>
                    </a>
                </li>
            </div>
        @endif

        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                <div class="d-flex justify-content-center">
                    <ul id="pagination" class="gap-2 pagination">
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item justify-content-center fw-semibold" aria-current="page">
                                    <a class="border-0 rounded-5 active" href="#">{{ $page }}</a>
                                </li>
                            @else
                                <li class="border border-success rounded-circle page-item justify-content-center fw-semibold" aria-current="page">
                                    <a class="border-0 rounded-5" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                <li class="page-item">
                    <a class="page-item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <span class="icon-olnext"></span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-item" href="{{ request()->url() . '?page='.$paginator->lastPage() }}" rel="next" aria-label="@lang('pagination.next')">
                        <span class="icon-olend"></span>
                    </a>
                </li>
            </div>
        @else
            <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="" class="page-item">
                        <span class="icon-olnext"></span>
                    </a>
                </li>
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="" class="page-item">
                        <span class="icon-olend"></span>
                    </a>
                </li>
            </div>
        @endif
    </ul>
</div>
@endif
