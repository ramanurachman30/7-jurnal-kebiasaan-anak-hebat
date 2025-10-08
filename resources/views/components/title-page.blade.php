@props([
    'title',
    'shortDesc' => '',
    'textColor' => 'text-gray-700',
    'subColor' => 'text-gray-700'
])

<div class="py-6">
    <h1 class="text-[2.25rem] {{ $textColor }} font-semibold">{{ $title }}</h1>
    @if ($shortDesc)
        <p class="text-xl font-medium {{ $subColor }}">{{ $shortDesc }}</p>
    @endif
</div>
