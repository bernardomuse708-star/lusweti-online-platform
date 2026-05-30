{{-- 1. BREAKING NEWS TICKER (Optimized) --}}
<div class=""
>
    @if($this->hasBreaking())
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
                Breaking
            </p>
        </div>
        {{-- Scrolling Area --}}
        <div class="flex-1 overflow-hidden whitespace-nowrap">
            <div class="flex animate-ticker hover:[animation-play-state:paused] w-max min-w-full">
                {{-- FIX: Swapped Alpine <template> for Blade @for to fix Livewire DOM diffing --}}
                @for ($i = 0; $i < 10; $i++)
                    <div class="flex items-center gap-8 px-4">
                    @foreach ($breakingItems as $item)
                    {{-- FIX: Added -$i to wire:key to prevent duplicate ID crashes --}}
                    <div class="flex items-center gap-2" wire:key="breaking-{{ $item->id }}-{{ $i }}">
                        <button class="py-3 px-1.5">
                            <span class="text-white-300 text-md opacity-70 py-2 px-1.5">•LIVE</span>
                        </button>
                        @php
                        $isInternal = str_starts_with($item->url, config('app.url'));
                        @endphp

                        <a
                            href="{{ $item->url }}"
                            @if($isInternal) wire:navigate.hover @else target="_blank" rel="noopener noreferrer" @endif
                            class="hover:text-yellow-300 transition-colors uppercase tracking-tight">
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