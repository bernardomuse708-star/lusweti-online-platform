<div class="my-8 relative min-h-[200px]" wire:poll.keep-alive.300s>
    {{-- Optional 5-minute fallback poll in case WebSockets drop --}}

    @if($this->category && $this->articles->isNotEmpty())
    
    {{-- BBC EDITORIAL HEADER BLOCK --}}
    <div class="flex items-center justify-between mb-6 border-b-2 border-neutral-900 pb-2">
        <h2 class="text-xl font-black uppercase tracking-tight text-neutral-900 flex items-center gap-2.5">
            {{-- Stark, sharp red rectangle --}}
            <span class="w-3 h-6 bg-red-600 rounded-none block" aria-hidden="true"></span>
            {{ $this->category->name }}
        </h2>

        {{-- Real-time Connection Indicator --}}
        <div class="flex items-center gap-1.5 bg-red-600 text-white px-2 py-0.5 text-[10px] font-black tracking-wider uppercase rounded-none" title="Live Connection Active">
            <span class="w-1.5 h-1.5 rounded-none bg-white animate-pulse"></span>
            <span>Live</span>
        </div>
    </div>

    {{-- FLAT GEOMETRIC CONTENT GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($this->articles as $article)
        
        <article wire:key="article-card-{{ $article->id }}"
                 x-data="{ show: false }"
                 x-init="setTimeout(() => show = true, 50)"
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="group relative flex flex-col bg-white border border-neutral-200 rounded-none shadow-none text-neutral-900 focus-within:ring-2 focus-within:ring-neutral-900 focus-within:ring-offset-0">

            {{-- Absolute Link Layer --}}
            <a href="{{ $article->external_url ?? route('articles.show', $article->slug) }}"
               target="{{ $article->external_url ? '_blank' : '_self' }}"
               rel="{{ $article->external_url ? 'noopener noreferrer' : '' }}"
               class="absolute inset-0 z-10"
               aria-label="Read {{ $article->title }}">
                <span class="sr-only">Read {{ $article->title }}</span>
            </a>

            {{-- FLAT IMAGE MEDIA CONTAINER --}}
            <div class="relative aspect-video w-full overflow-hidden bg-neutral-100 border-b border-neutral-200 rounded-none">
                <img src="{{ $article->getFirstMediaUrl('featured_image', 'thumb') }}" 
                     alt="{{ $article->title }}" 
                     loading="lazy"
                     class="w-full h-full object-cover rounded-none block transition-none">

                {{-- Prime Membership Indicator Badge --}}
                @if($article->is_prime)
                <div class="absolute top-0 left-0 bg-amber-500 text-neutral-950 text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded-none border-b border-r border-amber-600">
                    Prime
                </div>
                @endif

                {{-- External Content Warning Tag --}}
                @if($article->external_url)
                <div class="absolute top-0 right-0 inline-flex items-center gap-1 bg-neutral-950 text-white px-2 py-1 text-[9px] font-black uppercase tracking-wider rounded-none border-b border-l border-neutral-800">
                    <svg class="w-2.5 h-2.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span>External</span>
                </div>
                @endif
            </div>

            {{-- EDITORIAL TEXT & METADATA --}}
            <div class="flex flex-col flex-1 p-4 relative z-20 pointer-events-none justify-between min-h-[160px] space-y-4">
                
                <div class="space-y-1.5">
                    {{-- Section Label Placement --}}
                    @if($article->topic_label)
                    <span class="text-[10px] text-red-600 font-extrabold uppercase tracking-widest block">
                        {{ $article->topic_label }}
                    </span>
                    @endif

                    <h3 class="text-sm font-extrabold text-neutral-900 leading-snug line-clamp-2 group-hover:underline group-hover:text-neutral-800">
                        {{ $article->title }}
                    </h3>

                    @if($article->summary)
                    <p class="text-xs text-neutral-600 leading-relaxed line-clamp-2 font-normal">
                        {{ $article->summary }}
                    </p>
                    @endif
                </div>

                {{-- HARD DIVIDER METADATA BAR --}}
                <div class="pt-3 border-t border-neutral-100 flex items-center justify-between">
                    <time datetime="{{ $article->published_at?->toIso8601String() }}" 
                          class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider">
                        {{ $article->published_at?->diffForHumans() }}
                    </time>
                </div>

            </div>

        </article>
        @endforeach
    </div>
    @endif
</div>