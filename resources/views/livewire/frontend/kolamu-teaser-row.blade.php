<div class="w-full bg-white text-neutral-900 antialiased font-sans">
    @if($this->category)

    <section class="w-full py-4">

        {{-- Anchor Point --}}
        <a name="{{ $this->category->slug }}"></a>

        {{-- EDITORIAL ADVERTISING SLOTS 
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="hidden sm:flex h-24 w-full items-center justify-center rounded-none border border-neutral-200 bg-neutral-50 text-xs font-mono uppercase tracking-widest text-neutral-400">
                Desktop Advertisement Slot
            </div>
            <div class="flex sm:hidden h-20 w-full items-center justify-center rounded-none border border-neutral-200 bg-neutral-50 text-xs font-mono uppercase tracking-widest text-neutral-400">
                Mobile Advertisement Slot
            </div>
        </div>--}}

        {{-- SECTION EDITORIAL HEADER --}}
        <div class="">
            <div class="flex items-end justify-between border-b-2 border-neutral-900 pb-1.5">
                
                {{-- Category Badge: Sharp Geometric Block --}}
                <a href="/ms/{{ $this->category->slug }}"
                   wire:navigate
                   class="inline-block px-3 py-1 text-xs font-black uppercase tracking-wider rounded-none shadow-none"
                   style="background: {{ $this->category->bg_color }}; color: {{ $this->category->text_color }};">
                    {{ $this->category->name }}
                </a>

                {{-- Index Feed Link --}}
                <a href="/ms/{{ $this->category->slug }}"
                   wire:navigate
                   class="group flex items-center gap-1 text-xs font-extrabold uppercase tracking-wider text-neutral-600 hover:text-neutral-950 hover:underline">
                    All {{ $this->category->name }}
                    <svg class="w-3 h-3 text-red-700 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- THREE-COLUMN EDITORIAL CONTENT GRID --}}
        <div class=" mt-6 grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-8 lg:divide-x lg:divide-neutral-200">

            {{-- COLUMN 1: HERO FEATURED STORY --}}
            <div class="lg:col-span-5 pb-6 lg:pb-0">
                @if($this->rowLayouts['featured'])
                    @php $featuredItem = $this->rowLayouts['featured']; @endphp

                    <a href="/ms/{{ $this->category->slug }}/{{ $featuredItem->slug }}"
                       wire:navigate
                       class="group block space-y-4 rounded-none bg-transparent shadow-none">

                        @if($featuredItem->featured_image_url)
                            <div class="aspect-[16/10] w-full overflow-hidden bg-neutral-100 rounded-none border border-neutral-200">
                                <img src="{{ $featuredItem->featured_image_url }}" 
                                     alt="{{ $featuredItem->title }}" 
                                     loading="lazy"
                                     class="w-full h-full object-cover rounded-none block">
                            </div>
                        @endif

                        <div class="space-y-2">
                            <h3 class="text-xl sm:text-2xl font-black tracking-tight text-neutral-900 group-hover:text-neutral-800 group-hover:underline leading-tight">
                                @if($featuredItem->is_prime)
                                    <span class="inline-block text-[10px] font-black tracking-widest px-1.5 py-0.5 bg-red-700 text-white rounded-none mr-1.5 align-middle uppercase">
                                        PRIME
                                    </span>
                                @endif
                                {{ $featuredItem->title }}
                            </h3>

                            @if($featuredItem->summary)
                                <p class="text-sm leading-relaxed text-neutral-600 font-normal line-clamp-3">
                                    {{ $featuredItem->summary }}
                                </p>
                            @endif

                            <div class="flex items-center gap-2 text-xs font-medium text-neutral-400 pt-1 tracking-tight">
                                <span class="font-bold text-neutral-700">{{ $this->category->name }}</span>
                                <span>•</span>
                                <span>{{ $featuredItem->published_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                @endif
            </div>

            {{-- COLUMN 2: COMPACT THUMBNAIL LIST --}}
            <div class="lg:col-span-4 lg:pl-8 space-y-0 border-t border-neutral-200 pt-6 lg:border-t-0 lg:pt-0 divide-y divide-neutral-200">
                @foreach($this->rowLayouts['thumbnails'] as $thumbItem)
                    <a href="/ms/{{ $this->category->slug }}/{{ $thumbItem->slug }}"
                       wire:navigate
                       class="flex gap-4 py-4 first:pt-0 last:pb-0 bg-transparent rounded-none shadow-none group">

                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-extrabold text-neutral-900 group-hover:underline leading-snug">
                                @if($thumbItem->is_prime)
                                    <span class="inline-block text-[9px] font-black tracking-wider px-1 bg-red-700 text-white rounded-none mr-1 align-middle uppercase">
                                        PRIME
                                    </span>
                                @endif
                                {{ $thumbItem->title }}
                            </h4>

                            <div class="mt-2 text-[11px] font-medium text-neutral-400 flex items-center gap-1.5 tracking-tight">
                                <span class="font-bold text-neutral-600">{{ $this->category->name }}</span>
                                <span>•</span>
                                <span>{{ $thumbItem->published_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        @if($thumbItem->featured_image_thumb_url)
                            <div class="w-24 h-16 rounded-none overflow-hidden bg-neutral-100 border border-neutral-200 shrink-0">
                                <img src="{{ $thumbItem->featured_image_thumb_url }}"
                                     class="w-full h-full object-cover rounded-none"
                                     alt="{{ $thumbItem->title }}"
                                     loading="lazy">
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>

            {{-- COLUMN 3: WIRE-STYLE TEXT-ONLY LIST --}}
            <div class="lg:col-span-3 lg:pl-8 space-y-0 border-t border-neutral-200 pt-6 lg:border-t-0 lg:pt-0 divide-y divide-neutral-200">
                @foreach($this->rowLayouts['textOnly'] as $textItem)
                    <a href="/ms/{{ $this->category->slug }}/{{ $textItem->slug }}"
                       wire:navigate
                       class="block py-4 first:pt-0 last:pb-0 bg-transparent rounded-none shadow-none group">

                        <h4 class="text-sm font-extrabold text-neutral-900 group-hover:underline leading-snug">
                            @if($textItem->is_prime)
                                <span class="inline-block text-[9px] font-black tracking-wider px-1 bg-red-700 text-white rounded-none mr-1 align-middle uppercase">
                                    PRIME
                                </span>
                            @endif
                            {{ $textItem->title }}
                        </h4>

                        <div class="mt-2 text-[11px] font-medium text-neutral-400 flex items-center gap-1.5 tracking-tight">
                            <span class="font-bold text-neutral-600">{{ $this->category->name }}</span>
                            <span>•</span>
                            <span>{{ $textItem->published_at->diffForHumans() }}</span>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>

        {{-- SECTION EDITORIAL FOOTER 
        <div class="px-4 sm:px-6 lg:px-8 mt-8">
            <div class="flex justify-end border-t border-neutral-200 pt-4">
                <a href="/ms/{{ $this->category->slug }}"
                   wire:navigate
                   class="group flex items-center gap-1 text-xs font-extrabold uppercase tracking-wider text-neutral-600 hover:text-neutral-950 hover:underline">
                    All {{ $this->category->name }}
                    <svg class="w-3 h-3 text-red-700 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>--}}

        {{-- FLAT EDITORIAL AD WRAPPER Advertisement--}}
        <div class="mt-4 border-t border-b border-slate-200 py-3 text-center rounded-none bg-transparent">
            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block"></span>
        </div>

    </section>

    @endif
</div>