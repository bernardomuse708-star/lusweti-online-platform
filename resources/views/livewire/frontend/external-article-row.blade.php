<section class="w-full py-10 bg-white text-neutral-900 antialiased font-sans">
    @if($this->category && $this->collectionItems->isNotEmpty())

    {{-- BBC EDITORIAL HEADER BLOCK --}}
    <div class=" flex items-end justify-between border-b-2 border-neutral-900 pb-2 mb-6">
        <h2 class="text-xl font-black uppercase tracking-tight text-neutral-900 flex items-center gap-2.5">
            {{-- Stark, sharp red rectangle --}}
            <span class="w-3 h-6 bg-red-600 rounded-none block" aria-hidden="true"></span>
            {{ $this->category->name }}
        </h2>
    </div>

    {{-- FLAT GEOMETRIC CONTENT GRID --}}
    <div class=" grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($this->collectionItems as $article)

        <article wire:key="external-{{ $article->id }}" 
                 class="group relative flex flex-col bg-white border border-neutral-200 rounded-none shadow-none text-neutral-900 focus-within:ring-2 focus-within:ring-neutral-900 focus-within:ring-offset-0">

            {{-- Absolute Link Layer --}}
            <a href="{{ $article->external_url ?? '#' }}"
               target="_blank"
               rel="noopener noreferrer"
               class="absolute inset-0 z-10"
               aria-label="Open {{ $article->title }}">
                <span class="sr-only">Read {{ $article->title }}</span>
            </a>

            {{-- FLAT IMAGE MEDIA CONTAINER --}}
            <div class="relative aspect-[16/9] w-full overflow-hidden bg-neutral-100 border-b border-neutral-200 rounded-none">
                @php
                    $imageUrl = $article->featured_image_thumb_url ?? asset('images/placeholders/article-default.jpg');
                    $isOgMissing = !$article->hasMedia('featured_image');
                @endphp
                
                <img src="{{ $imageUrl }}"
                     alt="{{ $article->title }}"
                     loading="lazy"
                     class="w-full h-full object-cover rounded-none block transition-none">

                {{-- Strict Debug Block Ribbon --}}
                @if($isOgMissing)
                    <div class="absolute inset-x-0 bottom-0 bg-red-700 px-3 py-1 text-[9px] font-mono uppercase tracking-wider text-white rounded-none">
                        Debug: OG image missing
                    </div>
                @endif

                {{-- Stark External Domain Badge --}}
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
                
                <div class="space-y-2">
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
                <div class="pt-3 border-t border-neutral-100 flex flex-col gap-1">
                    <time datetime="{{ $article->published_at->toIso8601String() }}" 
                          class="text-[10px] font-bold text-red-700 uppercase tracking-wider">
                        {{ $article->published_at->diffForHumans() }}
                    </time>
                    
                    @if($article->external_url)
                    <p class="text-[10px] font-medium text-neutral-400 uppercase tracking-tight line-clamp-1">
                        Source: {{ parse_url($article->external_url, PHP_URL_HOST) }}
                    </p>
                    @endif
                </div>

            </div>

        </article>
        @endforeach
    </div>

    @endif
</section>