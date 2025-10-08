@props([
    'items' => [],
    'textColor' => 'text-gray-600',
])

<nav class="w-full text-sm {{ $textColor }}" aria-label="Breadcrumb">
    <ol class="overflow-auto flex items-center space-x-2">
        @foreach ($items as $index => $item)
            <li class="flex items-center space-x-2">
                @if ($index > 0)
                    <span class="{{ $textColor }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 256 256">
                            <path d="M156,128a28,28,0,1,1-28-28A28,28,0,0,1,156,128Z"></path>
                        </svg>
                    </span>
                @endif

                @if ($loop->last && empty($item['url']))
                    <span class="{{ $textColor }} text-nowrap opacity-70">{{ $item['label'] }}</span>
                @else
                    <a href="{{ $item['url'] ?? '#' }}"
                        class="font-regular hover:underline {{ $textColor }}">{{ $item['label'] }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
