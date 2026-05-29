<div class="">
   @if($this->category)

<section class="w-full py-10">

    {{-- --}}
    <a name="{{ $this->category->slug }}"></a>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="hidden sm:block bg-slate-100 rounded-xl h-24 flex items-center justify-center text-slate-400 text-sm">
            Desktop Ad Slot
        </div>
        <div class="sm:hidden bg-slate-100 rounded-xl h-20 flex items-center justify-center text-slate-400 text-sm">
            Mobile Ad Slot
        </div>
    </div>

     {{-- --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="flex items-center justify-between border-b border-slate-200 pb-3">
            
             {{-- --}}
            <a href="/ms/{{ $this->category->slug }}"
               wire:navigate
               class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold shadow-sm"
               style="background: {{ $this->category->bg_color }}; color: {{ $this->category->text_color }};">
                {{ $this->category->name }}
            </a>

             {{-- --}}
            <a href="/ms/{{ $this->category->slug }}"
               wire:navigate
               class="text-sm font-medium text-slate-600 hover:text-slate-900 flex items-center gap-1 transition">
                All {{ $this->category->name }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

     {{-- --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 grid grid-cols-1 lg:grid-cols-12 gap-6">

         {{-- --}}
        <div class="lg:col-span-4">
            @if($this->rowLayouts['featured'])
                @php $featuredItem = $this->rowLayouts['featured']; @endphp

                <a href="/ms/{{ $this->category->slug }}/{{ $featuredItem->slug }}"
                   wire:navigate
                   class="group block rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-md transition">

                    @if($featuredItem->hasMedia('cover'))
                        <div class="aspect-[16/10] overflow-hidden bg-slate-100">
                            <img src="{{ $featuredItem->getFirstMediaUrl('default') }}" alt="{{ $featuredItem->title }}" loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            
                                
                        </div>
                    @endif

                    <div class="p-4 space-y-3">
                        <h3 class="text-lg font-bold leading-snug text-slate-900">
                            @if($featuredItem->is_prime)
                                <span class="inline-block text-xs px-2 py-0.5 bg-black text-white rounded-md mr-2">
                                    PRIME
                                </span>
                            @endif
                            {{ $featuredItem->title }}
                        </h3>

                        @if($featuredItem->summary)
                            <p class="text-sm text-slate-600 line-clamp-3">
                                {{ $featuredItem->summary }}
                            </p>
                        @endif

                        <div class="flex items-center justify-between text-xs text-slate-500 pt-2">
                            <span class="font-medium text-slate-700">
                                {{ $this->category->name }}
                            </span>
                            <span>
                                {{ $featuredItem->published_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </a>
            @endif
        </div>

        <div class="lg:col-span-4 space-y-4">
            @foreach($this->rowLayouts['thumbnails'] as $thumbItem)
                <a href="/ms/{{ $this->category->slug }}/{{ $thumbItem->slug }}"
                   wire:navigate
                   class="flex gap-4 p-3 rounded-xl bg-white shadow-sm hover:shadow-md transition group">

                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-slate-900 group-hover:text-black leading-snug">
                            @if($thumbItem->is_prime)
                                <span class="text-[10px] px-2 py-0.5 bg-black text-white rounded mr-1">
                                    PRIME
                                </span>
                            @endif
                            {{ $thumbItem->title }}
                        </h3>

                        <div class="mt-2 text-xs text-slate-500 flex items-center gap-2">
                            <span class="font-medium text-slate-700">
                                {{ $this->category->name }}
                            </span>
                            <span>•</span>
                            <span>{{ $thumbItem->published_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    @if($thumbItem->hasMedia('cover'))
                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-slate-100 shrink-0">
                            <img src="{{ $thumbItem->getFirstMediaUrl('cover', 'thumbnail') }}"
                                 class="w-full h-full object-cover"
                                 alt="{{ $thumbItem->title }}">
                        </div>
                    @endif
                </a>
            @endforeach
        </div>

        <div class="lg:col-span-4 space-y-4">
            @foreach($this->rowLayouts['textOnly'] as $textItem)
                <a href="/ms/{{ $this->category->slug }}/{{ $textItem->slug }}"
                   wire:navigate
                   class="block p-4 rounded-xl bg-white shadow-sm hover:shadow-md transition">

                    <h3 class="text-sm font-semibold text-slate-900 leading-snug">
                        @if($textItem->is_prime)
                            <span class="text-[10px] px-2 py-0.5 bg-black text-white rounded mr-1">
                                PRIME
                            </span>
                        @endif
                        {{ $textItem->title }}
                    </h3>

                    <div class="mt-2 text-xs text-slate-500 flex items-center gap-2">
                        <span class="font-medium text-slate-700">
                            {{ $this->category->name }}
                        </span>
                        <span>•</span>
                        <span>{{ $textItem->published_at->diffForHumans() }}</span>
                    </div>
                </a>
            @endforeach
        </div>

    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="flex justify-end border-t border-slate-200 pt-4">
            <a href="/ms/{{ $this->category->slug }}"
               wire:navigate
               class="text-sm font-medium text-slate-600 hover:text-slate-900 flex items-center gap-1 transition">
                All {{ $this->category->name }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

</section>

@endif
</div>