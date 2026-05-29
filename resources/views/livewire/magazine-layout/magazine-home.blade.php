<div class="bg-white">
    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-10 xl:grid-cols-12">

            {{-- LEFT CONTENT --}}
            <div class="xl:col-span-8">
                @foreach($featuredLargeLeft->take(1) as $article)
                <a href="/ms/{{ $article->category->slug }}/{{ $article->slug }}" wire:navigate
                    wire:key="hero-{{ $article->id }}"
                    class="group block overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl">
                    <div class="grid gap-0 lg:grid-cols-12">
                        <div class="flex flex-col justify-center p-6 lg:col-span-4 lg:p-8">
                            <div class="mb-4 flex items-center gap-3">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-[10px] font-black uppercase tracking-[0.2em]"
                                    style="background: {{ $article->category->bg_color ?? '#F5911E' }}; color: {{ $article->category->text_color ?? '#fff' }}">
                                    {{ $article->category->name }}
                                </span>
                                <span class="text-xs font-semibold text-slate-400">
                                    {{ $article->published_at->diffForHumans() }}
                                </span>
                            </div>
                            <h2 class="text-2xl font-black leading-tight tracking-tight text-slate-900 transition-colors duration-300 group-hover:text-orange-500 lg:text-3xl">
                                {{ $article->title }}
                            </h2>
                            <p class="mt-4 line-clamp-4 text-sm leading-relaxed text-slate-600">
                                {{ $article->summary ?? 'Soma zaidi hapa...' }}
                            </p>
                        </div>

                        <div class="lg:col-span-8 overflow-hidden bg-slate-100">
                            <img src="{{ $article->getFirstMediaUrl('featured_image', 'hero') }}" alt="{{ $article->title }}" loading="lazy"
                                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </div>
                    </div>
                </a>
                @endforeach

                {{-- THUMBNAIL GRIDS --}}
                <div class="mt-10 grid gap-6 lg:grid-cols-2">
                    <div class="space-y-5">
                        @foreach($textTeasers as $article)
                        <a href="/ms/{{ $article->category->slug }}/{{ $article->slug }}" wire:navigate wire:key="text-{{ $article->id }}"
                            class="group block rounded-2xl border border-slate-200 bg-white p-5 transition-all duration-300 hover:border-orange-200 hover:bg-orange-50/40 hover:shadow-lg">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="mb-3 flex items-center gap-2">
                                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-500">{{ $article->category->name }}</span>
                                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                        <span class="text-[11px] font-semibold text-slate-400">{{ $article->published_at->diffForHumans() }}</span>
                                    </div>
                                    <h3 class="text-base font-extrabold leading-snug text-slate-900 transition-colors duration-300 group-hover:text-orange-500">
                                        {{ $article->title }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    <div class="space-y-5">
                        @foreach($rightThumbnails as $article)
                        <a href="/ms/{{ $article->category->slug }}/{{ $article->slug }}" wire:navigate wire:key="thumb-{{ $article->id }}"
                            class="group flex gap-4 rounded-2xl border border-slate-200 bg-white p-4 transition-all duration-300 hover:border-orange-200 hover:bg-orange-50/40 hover:shadow-xl">
                            <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-xl bg-slate-100">
                                <img src="{{ $article->getFirstMediaUrl('featured_image', 'thumb') }}" alt="{{ $article->title }}" loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>
                            <div class="flex flex-1 flex-col justify-center">
                                <div class="mb-2 flex items-center gap-2">
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-500">{{ $article->category->name }}</span>
                                    <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                    <span class="text-[11px] font-semibold text-slate-400">{{ $article->published_at->diffForHumans() }}</span>
                                </div>
                                <h3 class="line-clamp-3 text-sm font-extrabold leading-snug text-slate-900 transition-colors duration-300 group-hover:text-orange-500">
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
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $activeVideo->youtube_id }}" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </section>
                    @endif
                </div>
            </aside>

        </div>
    </section>
</div>