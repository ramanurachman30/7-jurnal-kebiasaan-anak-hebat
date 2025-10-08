@props(['images' => []])

<div x-data="{ current: 0 }" class="w-full py-4 md:py-6">
    {{-- Main Slider --}}
    <div class="relative overflow-hidden w-full h-[400px] md:h-[650px] rounded-xl">
        <template x-for="(image, index) in {{ Js::from($images) }}" :key="index">
            <img 
                x-show="current === index" 
                :src="image" 
                alt="Slider Image" 
                class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
        </template>

        <div class="absolute inset-y-0 left-0 flex items-center px-4">
            <button @click="current = current === 0 ? {{ count($images) - 1 }} : current - 1"
                class="bg-white/60 hover:bg-white text-black p-2 rounded-full shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-[48px] h-[48px]" fill="#000000" viewBox="0 0 256 256"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
            </button>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center px-4">
            <button @click="current = current === {{ count($images) - 1 }} ? 0 : current + 1"
                class="bg-white/60 hover:bg-white text-black p-2 rounded-full shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-[48px] h-[48px]" fill="#000000" viewBox="0 0 256 256"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
            </button>
        </div>
    </div>

    <div class="overflow-auto flex justify-start md:justify-center gap-2 mt-4">
        <template x-for="(image, index) in {{ Js::from($images) }}" :key="index">
            <img 
                :src="image" 
                @click="current = index"
                class="w-[100px] h-[80px] object-cover cursor-pointer border-2"
                :class="{ 'border-yellow-400 rounded-lg': current === index, 'border-transparent rounded-lg': current !== index }"
            >
        </template>
    </div>
</div>
