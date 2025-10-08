@props([
    'href' => '#',
    'image' => 'https://picsum.photos/200/300',
    'title' => 'Judul Berita',
    'description' => 'Deskripsi singkat berita.',
    'date' => 'JAN 24, 2024',
])

<a href="{{ $href }}" id="card-photo" class="cursor-pointer">
    <div class='border border-gray-100 bg-white hover:bg-yellow-300 flex flex-col rounded-2xl overflow-hidden'>
        <div class="relative overflow-hidden">
            <img src="{{ $image }}" alt="Gambar Berita" class="w-full h-[120px] md:h-[250px] object-cover">
            <div class="label-photo">
                FOTO
            </div>
        </div>
        <div class="flex flex-col gap-4 md:gap-8 p-3 md:p-6">
            <div class="flex flex-col gap-3">
                <h3 class="text-[18px] md:text-[22px] text-gray-700 font-semibold line-clamp-4">{{ $title }}</h3>
                <p class="line-clamp-1 text-[16px] md:text-[18px] text-gray-700 font-light">{{ $description }}</p>
            </div>
            <hr class="w-full border-gray-200" />
            <div class="w-full flex items-center justify-between mb-2">
                <small class='text-gray-700 font-semibold text-xs md:text-sm'>{{ $date }}</small>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] md:w-[24px] md:h-[24px]" class='text-gray-700' viewBox="0 0 256 256">
                    <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z" />
                </svg>
            </div>
        </div>
    </div>
</a>
