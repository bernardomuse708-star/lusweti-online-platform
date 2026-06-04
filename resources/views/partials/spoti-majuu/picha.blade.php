<div>
    <div class="border-b-2 border-gray-900 pb-1 mb-6">
        <span class="bg-[#F5911E] text-white text-xs font-bold uppercase tracking-widest px-3 py-1">Picha Za Kisasa</span>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($galleries->take(4) as $gallery)
        <div class="group relative bg-gray-900 overflow-hidden aspect-square">
            @if($gallery->getFirstMediaUrl('cover'))
            <img src="{{ $gallery->getFirstMediaUrl('cover') }}" class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-300">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-3 flex flex-col justify-end">
                <span class="text-[9px] font-black tracking-wider text-red-500 uppercase">Gallery</span>
                <h4 class="text-xs font-bold text-white line-clamp-2 mt-0.5">{{ $gallery->title }}</h4>
            </div>
        </div>
        @endforeach
    </div>
</div>