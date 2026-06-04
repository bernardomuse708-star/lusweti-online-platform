<div>
    <div class="border-b-2 border-gray-900 pb-1 mb-6">
        <span class="bg-[#F5911E] text-white text-xs font-bold uppercase tracking-widest px-3 py-1">Spoti Kenya</span>
    </div>

    @if($articles->isNotEmpty())
    @php $featured = $articles->first(); $list = $articles->skip(1); @endphp
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Large Featured Layout --}}
        <div class="lg:col-span-7 border-b border-gray-200 pb-6 lg:border-0 lg:pb-0">
            <a href="/ms/spoti-kenya/{{ $featured->slug }}" wire:navigate class="group block">
                @if($featured->getFirstMediaUrl('featured_image'))
                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-3">
                    <img src="{{ $featured->getFirstMediaUrl('featured_image') }}" class="w-full h-full object-cover">
                </div>
                @elseif($featured->image_path)
                <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-3">
                    <img src="{{ $featured->image_path }}" class="w-full h-full object-cover">
                </div>
                @endif
                <h2 class="text-xl font-extrabold text-gray-900 group-hover:text-red-600 leading-tight">
                    {{ $featured->title }}
                </h2>
                <p class="text-xs text-gray-600 mt-2 leading-relaxed">{{ $featured->summary }}</p>
            </a>
        </div>

        {{-- Compact Sidebar Split --}}
        <div class="lg:col-span-5 space-y-4">
            @foreach($list->take(4) as $item)
            <a href="/ms/spoti-kenya/{{ $item->slug }}" wire:navigate class="flex gap-4 pb-4 border-b border-gray-100 last:border-0 last:pb-0 group block">
                <div class="flex-1">
                    <h3 class="text-sm font-bold text-gray-900 group-hover:text-red-600 leading-snug">
                        {{ $item->title }}
                    </h3>
                    <span class="text-[10px] text-gray-400 block mt-1">{{ $item->published_at->diffForHumans() }}</span>
                </div>
                @if($item->getFirstMediaUrl('featured_image') || $item->image_path)
                <div class="w-20 h-20 bg-gray-50 shrink-0">
                    <img src="{{ $item->getFirstMediaUrl('featured_image') ?: $item->image_path }}" class="w-full h-full object-cover">
                </div>
                @endif
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
