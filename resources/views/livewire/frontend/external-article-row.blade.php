<section class="my-10">
    @if($this->category && $this->collectionItems->isNotEmpty())

    <div class="flex items-center justify-between mb-8 border-b-2 border-slate-100 pb-3">
        <h2 class="text-xl font-extrabold uppercase tracking-widest text-slate-900 flex items-center gap-3">
            <span class="w-1.5 h-6 bg-red-600 rounded-full block" aria-hidden="true"></span>
            {{ $this->category->name }}
        </h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 xl:gap-8">
        @foreach($this->collectionItems as $article)

        <article wire:key="external-{{ $article->id }}" class="group relative flex flex-col bg-white rounded-xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:border-slate-200 transition-all duration-300 focus-within:ring-2 focus-within:ring-red-500 focus-within:ring-offset-2">

            <a href="{{ $article->external_url ?? '#' }}"
                target="_blank"
                rel="noopener noreferrer"
                class="absolute inset-0 z-10"
                aria-label="Open {{ $article->title }}">
                <span class="sr-only">Read {{ $article->title }}</span>
            </a>

            <div class="relative aspect-[16/9] w-full overflow-hidden bg-slate-100 border-b border-slate-100">
                @php
                    $imageUrl = $article->featured_image_thumb_url ?? asset('images/placeholders/article-default.jpg');
                    $isOgMissing = !$article->hasMedia('featured_image');
                @endphp
                <img src="{{ $imageUrl }}"
                    alt="{{ $article->title }}"
                    loading="lazy"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                @if($isOgMissing)
                    <div class="absolute inset-x-0 bottom-0 bg-red-600/90 px-3 py-2 text-[10px] font-semibold uppercase tracking-[0.2em] text-white">
                        Debug: OG image not extracted yet
                    </div>
                @endif

                @if($article->external_url)
                    <div class="absolute top-3 right-3 inline-flex items-center gap-1 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider text-slate-700">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        External
                    </div>
                @endif
            </div>

            <div class="flex flex-col flex-1 p-5 relative z-20 pointer-events-none">

                <h3 class="text-base font-bold text-slate-900 leading-snug line-clamp-2 group-hover:text-red-600 transition-colors duration-200">
                    {{ $article->title }}
                </h3>

                @if($article->summary)
                <p class="mt-2.5 text-sm text-slate-600 leading-relaxed line-clamp-2 flex-1">
                    {{ $article->summary }}
                </p>
                @endif

                <div class="mt-4 pt-4 border-t border-slate-50 flex flex-col gap-2">
                    <time datetime="{{ $article->published_at->toIso8601String() }}" class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        {{ $article->published_at->diffForHumans() }}
                    </time>
                    @if($article->external_url)
                    <p class="text-[10px] text-slate-500 break-all line-clamp-1">
                        {{ parse_url($article->external_url, PHP_URL_HOST) }}
                    </p>
                    @endif
                </div>

            </div>

        </article>

        @endforeach
    </div>

    @endif
</section>