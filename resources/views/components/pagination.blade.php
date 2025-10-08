@props([
    'paginator', // wajib, instance dari LengthAwarePaginator
])

@if ($paginator->hasPages())
<div class="w-full flex items-center justify-center pt-8">
    <nav class="flex items-center justify-center space-x-2 text-gray-700" aria-label="Pagination">

        {{-- First Page --}}
        <a href="{{ $paginator->url(1) }}" class="p-2 hover:bg-gray-200 rounded-full" aria-label="First Page">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256">
                <path d="M232,128a8,8,0,0,1-8,8H91.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L91.31,120H224A8,8,0,0,1,232,128ZM40,32a8,8,0,0,0-8,8V216a8,8,0,0,0,16,0V40A8,8,0,0,0,40,32Z"></path>
            </svg>
        </a>

        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
            <span class="p-2 text-gray-400 rounded-full" aria-label="Previous Page">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path>
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="p-2 hover:bg-gray-200 rounded-full" aria-label="Previous Page">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path>
                </svg>
            </a>
        @endif

        {{-- Page Numbers --}}
        <ul class="flex items-center space-x-1">
            @foreach(range(1, $paginator->lastPage()) as $page)
                @if ($page == $paginator->currentPage())
                    <li>
                        <span class="px-3 py-1 bg-yellow-300 text-sm font-medium rounded-full">{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->url($page) }}" class="px-3 py-1 hover:bg-gray-200 text-sm font-medium rounded-full">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        </ul>

        {{-- Next Page --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="p-2 hover:bg-gray-200 rounded-full" aria-label="Next Page">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
                </svg>
            </a>
        @else
            <span class="p-2 text-gray-400 rounded-full" aria-label="Next Page">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
                </svg>
            </span>
        @endif

        {{-- Last Page --}}
        <a href="{{ $paginator->url($paginator->lastPage()) }}" class="p-2 hover:bg-gray-200 rounded-full" aria-label="Last Page">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256">
                <path d="M189.66,122.34a8,8,0,0,1,0,11.32l-72,72a8,8,0,0,1-11.32-11.32L164.69,136H32a8,8,0,0,1,0-16H164.69L106.34,61.66a8,8,0,0,1,11.32-11.32ZM216,32a8,8,0,0,0-8,8V216a8,8,0,0,0,16,0V40A8,8,0,0,0,216,32Z"></path>
            </svg>
        </a>

    </nav>
</div>
@endif
