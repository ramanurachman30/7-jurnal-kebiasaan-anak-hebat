@props([
    'href' => '#',
    'image' => 'https://picsum.photos/200/300',
    'title' => 'Judul Berita',
    'description' => 'Deskripsi singkat berita.',
    'date' => 'JAN 24, 2024',
    'view' => '11.000',
])

<a href="{{ $href }}" id="card-berita" class="cursor-pointer">
    <div class='bg-gray-100 hover:bg-yellow-300 flex flex-col rounded-2xl overflow-hidden'>
        <div class="p-6 flex flex-col gap-3">
            <div class="w-fit px-2 py-1 rounded-md bg-yellow-300 text-slate-800 text-xs font-semibold">
                SIARAN PERS
            </div>
            <h3 class="text-[18px] text-gray-700 font-semibold line-clamp-4">{{ $title }}</h3>
            <p class="text-[16px] text-gray-700 font-regular line-clamp-5">{{ $description }}</p>
            <hr class="w-full border-gray-200" />
            <div class="w-full flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <small class='text-gray-700 font-semibold text-xs'>{{ $date }}</small>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" viewBox="0 0 256 256"><path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"></path></svg>
                        <small class='text-gray-700 font-semibold text-xs'>{{ $view }}</small>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-[16px] h-[16px]" class='text-gray-700' viewBox="0 0 256 256">
                    <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z" />
                </svg>
            </div>
        </div>
    </div>
</a>
