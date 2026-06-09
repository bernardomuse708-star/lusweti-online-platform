<div>
    <div class="border-b-2 border-gray-900 pb-1 mb-6">
        <span class="bg-gray-900 text-white text-xs font-bold uppercase tracking-widest px-3 py-1">Burudani na Soka Mashuhuri</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        @php $featuredBurudani = $news->where('is_featured', true)->first() ?? $news->first(); @endphp

        @if($featuredBurudani)
        <div class="lg:col-span-4 border-b lg:border-b-0 lg:border-r border-gray-200 pb-6 lg:pb-0 lg:pr-6">
            <div class="space-y-3">
                @if($featuredBurudani->getFirstMediaUrl('featured_image'))
                <div class="aspect-[16/10] bg-gray-100">
                    <img src="{{ $featuredBurudani->getFirstMediaUrl('featured_image') }}" class="w-full h-full object-cover">
                </div>
                @endif
                <span class="text-[10px] font-bold text-red-600 uppercase tracking-widest">{{ $featuredBurudani->topic }}</span>
                <h3 class="text-lg font-black text-gray-900 leading-tight">{{ $featuredBurudani->title }}</h3>
                <p class="text-xs text-gray-600 leading-relaxed">{{ $featuredBurudani->summary }}</p>
            </div>
        </div>
        @endif

        <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($news->where('id', '!=', $featuredBurudani?->id)->take(4) as $item)
            <div class="flex gap-3 items-start p-2 bg-gray-50 border border-gray-100">
                @if($item->getFirstMediaUrl('featured_image'))
                <div class="w-16 h-16 bg-gray-200 shrink-0">
                    <img src="{{ $item->getFirstMediaUrl('featured_image') }}" class="w-full h-full object-cover">
                </div>
                @endif
                <div class="min-w-0">
                    @if($item->is_prime)
                    <span class="inline-block text-[8px] font-black bg-red-600 text-white px-1 py-0.25 mr-1">PRIME</span>
                    @endif
                    <h4 class="text-xs font-bold text-gray-900 hover:text-red-600 line-clamp-2">
                        {{ $item->title }}
                    </h4>
                    <span class="text-[9px] text-gray-400 mt-1 block">{{ $item->published_at->diffForHumans() }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>