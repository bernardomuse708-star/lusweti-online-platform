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

        <article class="group relative flex flex-col bg-white rounded-xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:border-slate-200 transition-all duration-300 focus-within:ring-2 focus-within:ring-red-500 focus-within:ring-offset-2">

            <a href="{{ $article->external_url ?? '#' }}"
                target="_blank"
                rel="noopener noreferrer"
                class="absolute inset-0 z-10">
                <span class="sr-only">Read {{ $article->title }}</span>
            </a>


            <div class="relative aspect-[16/9] w-full overflow-hidden bg-slate-50 border-b border-slate-100">
                <img src="{{ $article->getFirstMediaUrl('default') }}"
                    alt="{{ $article->title }}"
                    loading="lazy"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                @if($article->external_url)
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

                <div class="mt-4 pt-4 border-t border-slate-50 flex items-center">
                    <time datetime="{{ $article->published_at->toIso8601String() }}" class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        {{ $article->published_at->diffForHumans() }}
                    </time>
                </div>

            </div>

        </article>

        @endforeach
    </div>

    @endif
</section>