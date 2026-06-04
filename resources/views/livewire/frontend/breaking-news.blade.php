{{-- 1. BREAKING NEWS TICKER (BBC Editorial Layout) --}}
<div class="w-full bg-red-700 border-b border-red-800 rounded-none">
    @if($this->hasBreaking())
    <div wire:key="breaking-ticker"
         x-data
         class="text-white text-sm font-bold flex items-center overflow-hidden">

        {{-- STARK GEOMETRIC STATIC BADGE --}}
        <div class="px-5 py-2.5 bg-neutral-950 text-white uppercase tracking-widest font-black shrink-0 z-20 flex items-center gap-2 rounded-none border-r border-neutral-900">
            {{-- Flat block indicator (no soft blurs or glowing ambient circles) --}}
            <span class="w-2 h-2 bg-red-600 rounded-none block animate-pulse" aria-hidden="true"></span>
            <span>Breaking</span>
        </div>

        {{-- EDITORIAL SCROLLING TRACK --}}
        <div class="flex-1 overflow-hidden whitespace-nowrap flex items-center relative z-10 py-2">
            <div class="flex animate-ticker hover:[animation-play-state:paused] w-max min-w-full items-center">
                
                @for ($i = 0; $i < 6; $i++)
                <div class="flex items-center gap-12 px-6">
                    @foreach ($breakingItems as $item)
                    @php
                        $isInternal = str_starts_with($item->url, config('app.url'));
                    @endphp

                    <div class="flex items-center gap-3" wire:key="breaking-{{ $item->id }}-{{ $i }}">
                        {{-- Flat, crisp contextual live badge --}}
                        <span class="bg-white text-red-700 px-1.5 py-0.5 text-[9px] font-black tracking-widest rounded-none uppercase block select-none">
                            Live
                        </span>

                        <a href="{{ $item->url }}"
                           @if($isInternal) wire:navigate.hover @else target="_blank" rel="noopener noreferrer" @endif
                           class="text-white text-sm font-extrabold tracking-tight uppercase hover:underline transition-none">
                            {{ $item->display_title }}
                        </a>
                    </div>
                    @endforeach
                </div>
                @endfor

            </div>
        </div>

    </div>
    @endif
</div>