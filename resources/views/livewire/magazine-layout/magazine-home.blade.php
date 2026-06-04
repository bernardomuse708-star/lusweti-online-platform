<div class="bg-white text-slate-900 antialiased font-sans">

    <section class="">
        <div class="grid grid-cols-1 gap-8 items-start xl:grid-cols-12">

            {{-- LEFT CONTENT (MAIN STORIES) --}}
            <div class="xl:col-span-8 space-y-8">

                {{-- HERO STORY (BBC/REUTERS STYLE SPLIT) --}}
                @foreach($featuredLargeLeft->take(1) as $article)
                <a
                    href="/ms/{{ $article->category->slug }}/{{ $article->slug }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    wire:key="hero-{{ $article->id }}"
                    class="group block border-b border-slate-200 pb-6 transition-all duration-300">
                    
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-center">
                        
                        {{-- CONTENT --}}
                        <div class="order-2 lg:order-1 lg:col-span-5 flex flex-col justify-between h-full py-1">
                            <div>
                                <div class="mb-3 flex items-center gap-3">
                                    <span
                                        class="inline-block px-2 py-0.5 text-[11px] font-extrabold uppercase tracking-wider text-white"
                                        style="background: {{ $article->category->bg_color ?? '#D9381E' }}">
                                        {{ $article->category->name }}
                                    </span>

                                    <span class="text-xs font-medium text-slate-500">
                                        {{ $article->published_at->diffForHumans() }}
                                    </span>
                                </div>

                                <h2 class="text-2xl font-black tracking-tight leading-tight text-slate-900 group-hover:underline group-hover:text-slate-800 md:text-3xl">
                                    {{ $article->title }}
                                </h2>

                                <p class="mt-3 line-clamp-4 text-sm leading-relaxed text-slate-600">
                                    {{ $article->summary ?? 'Soma zaidi hapa...' }}
                                </p>
                            </div>

                            <div class="mt-4 flex items-center gap-1 text-xs font-bold uppercase tracking-wider text-red-600">
                                <span>Soma zaidi</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        {{-- IMAGE --}}
                        <div class="order-1 lg:order-2 lg:col-span-7 overflow-hidden bg-slate-100">
                            <div class="relative aspect-[16/10] w-full">
                                <img
                                    src="{{ $article->featured_image_url ?? asset('images/placeholders/article-default.jpg') }}"
                                    alt="{{ $article->title }}"
                                    loading="lazy"
                                    class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-102">
                            </div>
                        </div>

                    </div>
                </a>
                @endforeach

                {{-- SECONDARY STORIES --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- TEXT STORIES --}}
                    <div class="divide-y divide-slate-200">
                        @foreach($textTeasers as $article)
                        <a
                            href="/ms/{{ $article->category->slug }}/{{ $article->slug }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            wire:key="text-{{ $article->id }}"
                            class="group block py-4 first:pt-0 last:pb-0">
                            
                            <div class="mb-2 flex items-center gap-2">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-red-600">
                                    {{ $article->category->name }}
                                </span>
                                <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                <span class="text-[11px] text-slate-500">
                                    {{ $article->published_at->diffForHumans() }}
                                </span>
                            </div>

                            <h3 class="line-clamp-3 text-base font-bold leading-snug text-slate-900 group-hover:underline">
                                {{ $article->title }}
                            </h3>
                        </a>
                        @endforeach
                    </div>

                    {{-- IMAGE THUMBNAILS --}}
                    <div class="divide-y divide-slate-200">
                        @foreach($rightThumbnails as $article)
                        <a
                            href="/ms/{{ $article->category->slug }}/{{ $article->slug }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            wire:key="thumb-{{ $article->id }}"
                            class="group flex gap-4 py-4 first:pt-0 last:pb-0">
                            
                            <div class="h-20 w-20 flex-shrink-0 overflow-hidden bg-slate-100 sm:h-24 sm:w-24">
                                <img
                                    src="{{ $article->featured_image_thumb_url ?? asset('images/placeholders/article-default.jpg') }}"
                                    alt="{{ $article->title }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover">
                            </div>

                            <div class="flex flex-1 flex-col justify-between">
                                <div>
                                    <div class="mb-1 flex items-center gap-2">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">
                                            {{ $article->category->name }}
                                        </span>
                                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                        <span class="text-[10px] text-slate-400">
                                            {{ $article->published_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <h3 class="line-clamp-2 text-sm font-bold leading-snug text-slate-900 group-hover:underline">
                                        {{ $article->title }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>

                </div>

            </div>

            {{-- ASIDE / SIDEBAR --}}
            <aside class="xl:col-span-4 border-t border-slate-200 pt-6 xl:border-t-0 xl:pt-0">
                <div class="sticky top-6 space-y-8 max-h-[calc(100vh-3rem)] overflow-y-auto pr-1">
                    
                    {{-- LATEST VIDEO WIDGET --}}
                    @if($activeVideo)
                    <section class="border-t-2 border-slate-900 pt-3">
                        <div class="mb-3">
                            <h2 class="text-xs font-black uppercase tracking-widest text-slate-900">Latest Video</h2>
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
                        <div class="mt-2 py-1">
                            <h3 class="text-[10px] font-bold uppercase tracking-wider text-red-600">{{ $activeVideo->category?->name ?? 'Video' }}</h3>
                            <p class="mt-1 text-sm font-bold text-slate-900 leading-snug">{{ $activeVideo->title }}</p>
                        </div>
                    </section>
                    @endif

                    @php
                    $imageItems = $latestFeed->filter(fn($item) => !empty($item->featured_image_thumb_url))->take(3);
                    $externalItems = $latestFeed->filter(fn($item) => !empty($item->external_url))->take(3);
                    @endphp

                    {{-- LATEST IMAGES FEED --}}
                    @if($imageItems->isNotEmpty())
                    <section class="border-t-2 border-slate-900 pt-3">
                        <div class="mb-3">
                            <h2 class="text-xs font-black uppercase tracking-widest text-slate-900">Latest Images</h2>
                        </div>
                        <div class="space-y-3">
                            @foreach($imageItems as $item)
                            <a href="/ms/{{ $item->category->slug }}/{{ $item->slug }}" target="_blank" rel="noopener noreferrer" wire:key="image-item-{{ $item->id }}" class="group flex gap-3 items-start border-b border-slate-100 pb-3 last:border-0 last:pb-0">
                                <div class="h-14 w-20 flex-shrink-0 overflow-hidden bg-slate-100">
                                    <img src="{{ $item->featured_image_thumb_url ?? asset('images/placeholders/article-default.jpg') }}" alt="{{ $item->title }}" loading="lazy" class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-900 line-clamp-2 group-hover:underline leading-snug">{{ $item->title }}</p>
                                    <p class="mt-1 text-[10px] text-slate-400">{{ $item->published_at->diffForHumans() }}</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    {{-- EXTERNAL LINKS FEED --}}
                    @if($externalItems->isNotEmpty())
                    <section class="border-t-2 border-slate-900 pt-3">
                        <div class="mb-3">
                            <h2 class="text-xs font-black uppercase tracking-widest text-slate-900">External Links</h2>
                        </div>
                        <div class="space-y-3">
                            @foreach($externalItems as $item)
                            <a href="{{ $item->external_url }}" target="_blank" rel="noopener noreferrer" wire:key="external-{{ $item->id }}" class="group block border-b border-slate-100 pb-2 last:border-0 last:pb-0">
                                <p class="text-xs font-bold text-slate-900 line-clamp-2 group-hover:underline leading-snug">{{ $item->title }}</p>
                                <span class="mt-1 flex items-center gap-1.5 text-[10px] font-medium tracking-wide text-slate-400">
                                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                    Open external source
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    {{-- RELATED STORIES WIDGET (CNN/BLOOMBERG PERMANENT ANCHOR STYLE) --}}
                    @if($relatedArticles->isNotEmpty())
                    <section class="border-t-2 border-red-600 pt-3">
                        <div class="mb-3">
                            <h2 class="text-xs font-black uppercase tracking-widest text-red-600">Related Stories</h2>
                        </div>
                        <div class="space-y-3">
                            @foreach($relatedArticles as $relatedArticle)
                            <a href="/ms/{{ $relatedArticle->category->slug }}/{{ $relatedArticle->slug }}" target="_blank" rel="noopener noreferrer" wire:key="related-{{ $relatedArticle->id }}" class="group block border-b border-slate-100 pb-2 last:border-0 last:pb-0">
                                <p class="text-xs font-bold text-slate-900 line-clamp-2 group-hover:underline leading-snug">{{ $relatedArticle->title }}</p>
                                <p class="mt-1 text-[10px] text-slate-400">{{ $relatedArticle->published_at->diffForHumans() }}</p>
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