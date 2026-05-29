<div class="my-8 relative min-h-[200px]" wire:poll.keep-alive.300s>
    {{-- Optional 5-minute fallback poll in case WebSockets drop --}}

    @if($this->category && $this->articles->isNotEmpty())
    <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-2">
        <h2 class="text-xl font-bold uppercase tracking-wider text-gray-900 border-l-4 border-red-600 pl-3">
            {{ $this->category->name }}
        </h2>

        {{-- Real-time Connection Indicator --}}
        <span class="flex h-3 w-3 relative" title="Live Connection Active">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-600"></span>
        </span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($this->articles as $article)
        <a wire:key="article-card-{{ $article->id }}"
            href="{{ $article->external_url ?? route('articles.show', $article->slug) }}"
            target="{{ $article->external_url ? '_blank' : '_self' }}"
            rel="{{ $article->external_url ? 'noopener noreferrer' : '' }}"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 50)"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-8 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            class="group flex flex-col bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-50">

            <div class="relative aspect-video w-full overflow-hidden bg-gray-100">

                <!-- <div class="relative aspect-[16/9] w-full overflow-hidden bg-slate-50"> -->
    <img 
        src="{{ $article->getFirstMediaUrl('featured_image', 'thumb') }}" 
        alt="{{ $article->title }}" 
        loading="lazy"
        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
    >
<!-- </div> -->
                @if($article->is_prime)
                <div class="absolute top-2 left-2 bg-gradient-to-r from-amber-400 to-amber-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow">
                    PRIME
                </div>
                @endif

                @if($article->external_url)
                <div class="absolute top-2 right-2 bg-black/60 backdrop-blur-xs p-1.5 rounded-full text-white shadow-lg">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </div>
                @endif
            </div>

            <div class="flex flex-col flex-1 p-4 bg-white">
                <h3 class="text-sm font-bold text-gray-900 line-clamp-2 group-hover:text-red-600 transition-colors duration-200">
                    {{ $article->title }}
                </h3>
                @if($article->summary)
                <p class="mt-2 text-xs text-gray-600 line-clamp-2 flex-1 leading-relaxed">
                    {{ $article->summary }}
                </p>
                @endif
                <div class="mt-4 flex items-center justify-between border-t border-gray-50 pt-3">
                    <span class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">
                        {{ $article->published_at->diffForHumans() }}
                    </span>
                    @if($article->topic_label)
                    <span class="text-[10px] text-red-600 font-bold uppercase bg-red-50 px-2 py-0.5 rounded">
                        {{ $article->topic_label }}
                    </span>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>