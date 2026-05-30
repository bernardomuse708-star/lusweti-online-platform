<div class="bg-white">
    <section class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-10 xl:grid-cols-12">




            {{-- LEFT CONTENT --}}
            <div class="xl:col-span-8 space-y-6">

                {{-- HERO STORY --}}
                @foreach($featuredLargeLeft->take(1) as $article)
                <a
                    href="/ms/{{ $article->category->slug }}/{{ $article->slug }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    wire:key="hero-{{ $article->id }}"
                    class="group block overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm transition-all duration-500 hover:-translate-y-1 hover:border-orange-200 hover:shadow-[0_20px_50px_rgba(0,0,0,0.12)]">
                    <div class="grid lg:grid-cols-12">

                        {{-- CONTENT --}}
                        <div class="flex flex-col justify-center p-5 sm:p-6 lg:col-span-4 lg:p-8 xl:p-10">
                            <div class="mb-4 flex flex-wrap items-center gap-3">
                                <span
                                    class="inline-flex items-center rounded-full px-3 py-1 text-[10px] font-black uppercase tracking-[0.2em]"
                                    style="background: {{ $article->category->bg_color ?? '#F5911E' }}; color: {{ $article->category->text_color ?? '#fff' }}">
                                    {{ $article->category->name }}
                                </span>

                                <span class="text-xs font-semibold text-slate-400">
                                    {{ $article->published_at->diffForHumans() }}
                                </span>
                            </div>

                            <h2 class="text-xl font-black leading-tight tracking-tight text-slate-900 transition-colors duration-300 group-hover:text-orange-500 sm:text-2xl lg:text-3xl xl:text-[2rem]">
                                {{ $article->title }}
                            </h2>

                            <p class="mt-4 line-clamp-4 text-sm leading-relaxed text-slate-600 sm:text-base">
                                {{ $article->summary ?? 'Soma zaidi hapa...' }}
                            </p>

                            <div class="mt-6 flex items-center gap-2 text-sm font-bold text-orange-500">
                                <span>Soma zaidi</span>

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        {{-- IMAGE --}}
                        <div class="overflow-hidden bg-slate-100 lg:col-span-8">
                            <div class="relative aspect-[16/10] min-h-[260px] sm:min-h-[340px] lg:min-h-[500px]">
                                <img
                                    src="{{ $article->featured_image_url ?? asset('images/placeholders/article-default.jpg') }}"
                                    alt="{{ $article->title }}"
                                    loading="lazy"
                                    class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                            </div>
                        </div>

                    </div>
                </a>
                @endforeach

                {{-- SECONDARY STORIES --}}
                <div class="grid gap-5 lg:grid-cols-2 xl:gap-6">

                    {{-- TEXT STORIES --}}
                    <div class="space-y-5">
                        @foreach($textTeasers as $article)
                        <a
                            href="/ms/{{ $article->category->slug }}/{{ $article->slug }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            wire:key="text-{{ $article->id }}"
                            class="group block rounded-2xl border border-slate-200 bg-white p-5 transition-all duration-300 hover:-translate-y-0.5 hover:border-orange-200 hover:bg-orange-50/30 hover:shadow-xl">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">

                                    <div class="mb-3 flex flex-wrap items-center gap-2">
                                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-500">
                                            {{ $article->category->name }}
                                        </span>

                                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>

                                        <span class="text-[11px] font-semibold text-slate-400">
                                            {{ $article->published_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <h3 class="line-clamp-3 text-base font-extrabold leading-snug text-slate-900 transition-colors duration-300 group-hover:text-orange-500 lg:text-[17px]">
                                        {{ $article->title }}
                                    </h3>

                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    {{-- IMAGE THUMBNAILS --}}
                    <div class="space-y-5">
                        @foreach($rightThumbnails as $article)
                        <a
                            href="/ms/{{ $article->category->slug }}/{{ $article->slug }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            wire:key="thumb-{{ $article->id }}"
                            class="group flex gap-4 rounded-2xl border border-slate-200 bg-white p-4 transition-all duration-300 hover:-translate-y-0.5 hover:border-orange-200 hover:bg-orange-50/30 hover:shadow-xl">
                            <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-xl bg-slate-100 sm:h-28 sm:w-28">
                                <img
                                    src="{{ $article->featured_image_thumb_url ?? asset('images/placeholders/article-default.jpg') }}"
                                    alt="{{ $article->title }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>

                            <div class="flex flex-1 flex-col justify-center">

                                <div class="mb-2 flex flex-wrap items-center gap-2">
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-500">
                                        {{ $article->category->name }}
                                    </span>

                                    <span class="h-1 w-1 rounded-full bg-slate-300"></span>

                                    <span class="text-[11px] font-semibold text-slate-400">
                                        {{ $article->published_at->diffForHumans() }}
                                    </span>
                                </div>

                                <h3 class="line-clamp-3 text-sm font-extrabold leading-snug text-slate-900 transition-colors duration-300 group-hover:text-orange-500 sm:text-base">
                                    {{ $article->title }}
                                </h3>

                            </div>
                        </a>
                        @endforeach
                    </div>

                </div>

            </div>



            {{-- SIDEBAR --}}
            <aside class="xl:col-span-4">
                <div class="sticky top-24 space-y-8">
                    @if($activeVideo)
                    <section class="overflow-hidden rounded-3xl border border-slate-400 bg-white shadow-sm">
                        <div class="border-b border-slate-100 px-6 py-5">
                            <h2 class="text-lg font-black tracking-tight text-slate-900">Latest Video</h2>
                        </div>
                        <div class="aspect-video overflow-hidden bg-black">
                            @if($activeVideo->is_youtube)
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $activeVideo->youtube_id }}" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                            @else
                            <video
                                src="{{ $activeVideo->video_url }}"
                                poster="{{ $activeVideo->image_path }}"
                                preload="metadata"
                                controls
                                muted
                                playsinline
                                class="h-full w-full object-cover bg-black">
                                Your browser does not support embedded videos.
                            </video>
                            @endif
                        </div>
                        <div class="border-t border-slate-100 px-6 py-4">
                            <h3 class="text-sm font-semibold uppercase tracking-[0.22em] text-orange-500">{{ $activeVideo->category?->name ?? 'Video' }}</h3>
                            <p class="mt-2 text-base font-extrabold text-slate-900">{{ $activeVideo->title }}</p>
                        </div>
                    </section>
                    @endif

                    @php
                    $imageItems = $latestFeed->filter(fn($item) => !empty($item->featured_image_thumb_url))->take(3);
                    $externalItems = $latestFeed->filter(fn($item) => !empty($item->external_url))->take(3);
                    @endphp

                    @if($imageItems->isNotEmpty())
                    <section class="overflow-hidden rounded-3xl border border-slate-400 bg-white shadow-sm">
                        <div class="border-b border-slate-100 px-6 py-5">
                            <h2 class="text-lg font-black tracking-tight text-slate-900">Latest Images</h2>
                        </div>
                        <div class="space-y-4 p-5">
                            @foreach($imageItems as $item)
                            <a href="/ms/{{ $item->category->slug }}/{{ $item->slug }}" target="_blank" rel="noopener noreferrer" wire:key="image-item-{{ $item->id }}" class="group block overflow-hidden rounded-3xl border border-slate-200 bg-slate-50 transition-all duration-300 hover:border-orange-200 hover:shadow-xl">
                                <div class="h-28 overflow-hidden bg-slate-100">
                                    <img src="{{ $item->featured_image_thumb_url ?? asset('images/placeholders/article-default.jpg') }}" alt="{{ $item->title }}" loading="lazy" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                                </div>
                                <div class="p-4">
                                    <p class="text-sm font-bold text-slate-900 line-clamp-2">{{ $item->title }}</p>
                                    <p class="mt-2 text-[11px] text-slate-500">{{ $item->published_at->diffForHumans() }}</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    @if($externalItems->isNotEmpty())
                    <section class="overflow-hidden rounded-3xl border border-slate-400 bg-white shadow-sm">
                        <div class="border-b border-slate-100 px-6 py-5">
                            <h2 class="text-lg font-black tracking-tight text-slate-900">External Links</h2>
                        </div>
                        <div class="space-y-3 p-5">
                            @foreach($externalItems as $item)
                            <a href="{{ $item->external_url }}" target="_blank" rel="noopener noreferrer" wire:key="external-{{ $item->id }}" class="group block rounded-2xl border border-slate-200 bg-slate-50 p-4 transition-all duration-300 hover:border-orange-200 hover:bg-orange-50/40">
                                <p class="text-sm font-bold text-slate-900 line-clamp-2">{{ $item->title }}</p>
                                <p class="mt-2 text-[11px] text-slate-500 break-words">{{ \Illuminate\Support\Str::limit($item->external_url, 52) }}</p>
                                <span class="mt-3 inline-flex items-center gap-2 text-[11px] uppercase tracking-[0.22em] text-slate-400">
                                    <span class="inline-block h-2 w-2 rounded-full bg-orange-500"></span>
                                    Open external source
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    @if($relatedArticles->isNotEmpty())
                    <section class="overflow-hidden rounded-3xl border border-slate-400 bg-white shadow-sm">
                        <div class="border-b border-slate-100 px-6 py-5">
                            <h2 class="text-lg font-black tracking-tight text-slate-900">Related Stories</h2>
                        </div>
                        <div class="space-y-3 p-5">
                            @foreach($relatedArticles as $relatedArticle)
                            <a href="/ms/{{ $relatedArticle->category->slug }}/{{ $relatedArticle->slug }}" target="_blank" rel="noopener noreferrer" wire:key="related-{{ $relatedArticle->id }}" class="group block rounded-2xl border border-slate-200 bg-slate-50 p-4 transition-all duration-300 hover:border-orange-200 hover:bg-orange-50/40">
                                <p class="text-sm font-bold text-slate-900 line-clamp-2">{{ $relatedArticle->title }}</p>
                                <p class="mt-2 text-[11px] text-slate-500">{{ $relatedArticle->published_at->diffForHumans() }}</p>
                                <span class="mt-3 inline-flex items-center gap-2 text-[11px] uppercase tracking-[0.22em] text-slate-400">
                                    <span class="inline-block h-2 w-2 rounded-full bg-slate-500"></span>
                                    Read related coverage
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </section>
                    @endif
                </div>
            </aside>

        </div>
    </section>

























</div>