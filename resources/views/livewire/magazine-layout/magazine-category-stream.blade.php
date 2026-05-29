<div class="my-8 relative min-h-[200px]" wire:poll.keep-alive.300s>
    @if($this->category && $this->articles->isNotEmpty())
    <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-2">
        <h2 class="text-xl font-bold uppercase tracking-wider text-gray-900 border-l-4 border-red-600 pl-3">
            {{ $this->category->name }}
        </h2>

        {{-- Connection Pulse --}}
        <span class="flex h-3 w-3 relative" title="Live Connection Active">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-600"></span>
        </span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($this->articles as $article)
        <a wire:key="article-card-{{ $article->id }}"
            href="{{ $article->external_url ?? route('articles.show', $article->slug) }}"
            target="{{ $article->external_url ? '_blank' : '_self' }}"
            rel="{{ $article->external_url ? 'noopener noreferrer' : '' }}"
            x-data="{ show: false }"
            x-init="nextTick(() => show = true)"
            x-show="show"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-4 scale-98"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            class="group flex flex-col bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-50">

            <div class="relative aspect-video w-full overflow-hidden bg-gray-100">
                <img src="{{ $article->getFirstMediaUrl('featured_image', 'thumb') }}" 
                     alt="{{ $article->title }}" 
                     loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                
                @if($article->is_prime)
                <div class="absolute top-2 left-2 bg-gradient-to-r from-amber-400 to-amber-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow">
                    PRIME
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
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>