{{-- BREAKING NEWS SECTION WITH FEATURED IMAGE & TICKER --}}
<div class="">
    @if($this->hasBreaking())
        {{-- FEATURED CARD (Primary Breaking News Item) --}}
        @php
        $featuredItem = $breakingItems?->first();
        $isUrgent = $featuredItem?->is_urgent ?? false;
        $isLive = $featuredItem?->is_live ?? false;
        @endphp

        @if($featuredItem)
        <div class="bg-gradient-to-r from-red-600 to-red-700 text-white border-b-4 border-red-900 shadow-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-start gap-6">
                    {{-- Featured Image --}}
                    @if($featuredItem->image_url)
                    <div class="shrink-0 w-32 h-32 rounded-lg overflow-hidden shadow-lg border-4 border-white/20">
                        <img
                            src="{{ $featuredItem->image_url }}"
                            alt="{{ $featuredItem->title }}"
                            loading="lazy"
                            class="w-full h-full object-cover">
                    </div>
                    @endif

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        {{-- Badges --}}
                        <div class="flex items-center gap-3 mb-2 flex-wrap">
                            @if($isUrgent)
                            <span class="inline-block px-3 py-1 bg-red-900 text-white text-xs font-bold rounded-full uppercase tracking-wider">
                                🚨 URGENT
                            </span>
                            @endif

                            @if($isLive)
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-400 text-red-900 text-xs font-bold rounded-full uppercase tracking-wider">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-600 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-600"></span>
                                </span>
                                LIVE
                            </span>
                            @endif

                            <span class="text-xs text-red-100">
                                {{ $featuredItem->created_at?->diffForHumans() ?? 'Recently' }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h2 class="text-2xl lg:text-3xl font-black text-white mb-4 line-clamp-3">
                            {{ $featuredItem->display_title }}
                        </h2>

                        {{-- CTA Button --}}
                        @php
                        $isInternal = str_starts_with($featuredItem->url, config('app.url'));
                        @endphp

                        <a
                            href="{{ $featuredItem->url }}"
                            @if($isInternal) wire:navigate @else target="_blank" rel="noopener noreferrer" @endif
                            wire:click="trackClick({{ $featuredItem->id }})"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-white text-red-600 font-bold rounded-lg hover:bg-red-50 transition-all duration-300 shadow-lg hover:shadow-xl">
                            Read Full Story
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- SCROLLING TICKER (All Items) --}}
        <div wire:key="breaking-ticker"
            x-data
            class="bg-red-600 text-white text-sm font-semibold flex items-center overflow-hidden border-b border-black/10">

            {{-- Static Label --}}
            <div class="px-4 py-2 bg-white uppercase tracking-wider shrink-0 shadow-lg z-10">
                <p class="text-red-600 flex items-center gap-2">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-600"></span>
                    </span>
                    More News
                </p>
            </div>

            {{-- Scrolling Area --}}
            <div class="flex-1 overflow-hidden whitespace-nowrap">
                <div class="flex animate-ticker hover:[animation-play-state:paused] w-max min-w-full">
                    @for ($i = 0; $i < 10; $i++)
                        <div class="flex items-center gap-8 px-4">
                        @foreach ($breakingItems as $item)
                        {{-- Skip featured item in ticker --}}
                        @if($item->id !== $featuredItem?->id ?? null)
                        <div class="flex items-center gap-2" wire:key="breaking-{{ $item->id }}-{{ $i }}">
                            <button class="py-3 px-1.5">
                                <span class="text-white-300 text-md opacity-70 py-2 px-1.5">•</span>
                            </button>

                            @php
                            $isInternal = str_starts_with($item->url, config('app.url'));
                            @endphp

                            <a
                                href="{{ $item->url }}"
                                @if($isInternal) wire:navigate.hover @else target="_blank" rel="noopener noreferrer" @endif
                                wire:click="trackClick({{ $item->id }})"
                                class="hover:text-yellow-300 transition-colors uppercase tracking-tight truncate">
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
    </div>
    @endif
</div>
