{{-- BREAKING NEWS SECTION WITH FEATURED IMAGE & TICKER (BBC Editorial Layout) --}}
<div class="w-full bg-white rounded-none">
    @if($this->hasBreaking())
        {{-- FEATURED CARD (Primary Breaking News Item) --}}
        @php
            $featuredItem = $breakingItems?->first();
            $isUrgent = $featuredItem?->is_urgent ?? false;
            $isLive = $featuredItem?->is_live ?? false;
        @endphp

        @if($featuredItem)
        <div class="bg-red-700 text-white border-b-2 border-red-900 rounded-none shadow-none">
            <div class="px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col sm:flex-row items-start gap-6">
                    
                    {{-- FLAT IMAGERY MEDIA ASSET --}}
                    @if($featuredItem->image_url)
                    <div class="shrink-0 w-full sm:w-36 h-36 bg-neutral-900 border border-white/20 rounded-none overflow-hidden relative">
                        <img src="{{ $featuredItem->image_url }}"
                             alt="{{ $featuredItem->title }}"
                             loading="lazy"
                             class="w-full h-full object-cover rounded-none block">
                    </div>
                    @endif

                    {{-- TEXT COMPOSITION ENGINE --}}
                    <div class="flex-1 min-w-0">
                        {{-- STARK METADATA BADGE MATRIX --}}
                        <div class="flex items-center gap-2 mb-2.5 flex-wrap">
                            @if($isUrgent)
                            <span class="inline-block px-2 py-0.5 bg-neutral-950 text-white text-[10px] font-black uppercase tracking-widest rounded-none">
                                Urgent
                            </span>
                            @endif

                            @if($isLive)
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 bg-white text-red-700 text-[10px] font-black uppercase tracking-widest rounded-none">
                                <span class="w-1.5 h-1.5 bg-red-600 rounded-none block animate-pulse" aria-hidden="true"></span>
                                <span>Live</span>
                            </span>
                            @endif

                            <time class="text-[11px] font-bold text-red-100 uppercase tracking-wider">
                                {{ $featuredItem->created_at?->diffForHumans() ?? 'Recently' }}
                            </time>
                        </div>

                        {{-- EDITORIAL HERO TITLE --}}
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black text-white leading-tight tracking-tight mb-4">
                            @php
                                $isInternal = str_starts_with($featuredItem->url, config('app.url'));
                            @endphp
                            <a href="{{ $featuredItem->url }}" 
                               @if($isInternal) wire:navigate @else target="_blank" rel="noopener noreferrer" @endif
                               class="hover:underline transition-none">
                                {{ $featuredItem->display_title }}
                            </a>
                        </h2>

                        {{-- GEOMETRIC BLOCK BUTTON INTERACTIVE --}}
                        <a href="{{ $featuredItem->url }}"
                           @if($isInternal) wire:navigate @else target="_blank" rel="noopener noreferrer" @endif
                           wire:click="trackClick({{ $featuredItem->id }})"
                           class="inline-flex items-center gap-1.5 px-4 py-2 bg-neutral-950 text-white text-xs font-black uppercase tracking-wider rounded-none border border-neutral-900 hover:bg-neutral-900 transition-none focus:outline-none focus:ring-1 focus:ring-white">
                            <span>Read Full Story</span>
                            <svg class="w-3 h-3 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        @endif

        {{-- LOWER CRAWL TICKER BANNER (All Secondary Items) --}}
        <div wire:key="breaking-ticker"
             x-data
             class="bg-neutral-950 text-white text-sm font-bold flex items-center overflow-hidden border-b border-neutral-900 rounded-none">

            {{-- HIGH-CONTRAST STATIC BLOCK LABEL --}}
            <div class="px-4 py-2.5 bg-red-600 text-white uppercase tracking-widest font-black shrink-0 z-20 flex items-center gap-2 rounded-none border-r border-red-700">
                <span class="w-1.5 h-1.5 bg-white rounded-none block" aria-hidden="true"></span>
                <span>More News</span>
            </div>

            {{-- SCROLLING RUNNING TRACK --}}
            <div class="flex-1 overflow-hidden whitespace-nowrap flex items-center relative z-10 py-1.5">
                <div class="flex animate-ticker hover:[animation-play-state:paused] w-max min-w-full items-center">
                    @for ($i = 0; $i < 10; $i++)
                    <div class="flex items-center gap-12 px-6">
                        @foreach ($breakingItems as $item)
                        {{-- Skip featured item in runner row --}}
                        @if($item->id !== $featuredItem?->id ?? null)
                        
                        @php
                            $isInternal = str_starts_with($item->url, config('app.url'));
                        @endphp

                        <div class="flex items-center gap-2" wire:key="breaking-{{ $item->id }}-{{ $i }}">
                            <span class="text-red-500 font-black select-none text-sm" aria-hidden="true">•</span>

                            <a href="{{ $item->url }}"
                               @if($isInternal) wire:navigate.hover @else target="_blank" rel="noopener noreferrer" @endif
                               wire:click="trackClick({{ $item->id }})"
                               class="text-neutral-200 hover:text-white font-extrabold tracking-tight uppercase text-xs hover:underline transition-none truncate">
                                {{ $item->display_title }}
                            </a>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endfor
                </div>
            </div>

        </div>
    @endif
</div>