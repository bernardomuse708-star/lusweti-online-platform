<div class="w-full bg-white text-neutral-900 antialiased font-sans">
    @if($this->category)

    <section id="{{ $this->category->slug }}" class="w-full py-10 border-b border-neutral-200">

        {{-- SECTION EDITORIAL HEADER --}}
        <div class="mx-auto flex items-end justify-between border-b-2 border-neutral-900 pb-3 mb-8">

            <div class="flex items-start gap-3">
                {{-- Sharp Block Color Indicator --}}
                <div class="w-3 h-8 shrink-0 rounded-none block"
                     style="background-color: {{ $this->category->bg_color }}"></div>

                <div class="space-y-1">
                    <h2 class="text-2xl lg:text-3xl font-black tracking-tight text-neutral-900 uppercase">
                        {{ $this->category->name }}
                    </h2>
                    <p class="text-xs font-normal text-neutral-500">
                        Latest updates and featured stories
                    </p>
                </div>
            </div>

            {{-- Index Feed Link --}}
            <a href="/ms/{{ $this->category->slug }}"
               wire:navigate
               class="hidden md:flex items-center gap-1 text-xs font-black uppercase tracking-wider text-neutral-600 hover:text-neutral-950 hover:underline">
                View All
                <svg class="w-3 h-3 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
            </a>

        </div>

        {{-- ARTICLES GEOMETRIC GRID --}}
        <div class="mx-auto grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

            @foreach($this->gridArticles as $article)
            <article wire:key="grid-teaser-{{ $article->id }}"
                     class="group bg-white border border-neutral-200 rounded-none shadow-none text-neutral-900 flex flex-col">

                <a href="/ms/{{ $this->category->slug }}/{{ $article->slug }}"
                   wire:navigate
                   class="block w-full h-full flex flex-col focus:outline-none">

                    {{-- MEDIA CONTAINER --}}
                    @if($article->featured_image_url)
                        <div class="relative w-full aspect-[16/10] bg-neutral-100 border-b border-neutral-200 overflow-hidden">
                            <img src="{{ $article->featured_image_url }}" 
                                 alt="{{ $article->title }}" 
                                 loading="lazy"
                                 class="w-full h-full object-cover rounded-none block">
                            
                            {{-- Flat Category Metadata Overlap --}}
                            <div class="absolute bottom-0 left-0 text-[10px] font-black tracking-wider uppercase px-2.5 py-1 rounded-none shadow-none"
                                 style="background: {{ $this->category->bg_color }}; color: {{ $this->category->text_color }};">
                                {{ $article->topic_label ?? $this->category->name }}
                            </div>
                        </div>
                    @endif

                    {{-- TEXT & COMPLIANCE DATA --}}
                    <div class="p-5 flex flex-col flex-1 justify-between min-h-[220px] space-y-4">

                        <div class="space-y-2">
                            <h3 class="text-lg font-extrabold text-neutral-900 group-hover:text-neutral-800 group-hover:underline leading-snug line-clamp-2">
                                {{ $article->title }}
                            </h3>

                            <p class="text-xs leading-relaxed text-neutral-600 font-normal line-clamp-3">
                                {{ $article->summary }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-neutral-100 flex items-center justify-between text-[11px] font-medium tracking-tight text-neutral-400">
                            
                            <span class="font-normal text-neutral-500">
                                {{ $article->published_at->diffForHumans() }}
                            </span>

                            <span class="inline-flex items-center gap-1 text-xs font-black text-red-700 uppercase tracking-wide">
                                Read Story
                                <svg class="w-2.5 h-2.5 text-neutral-400 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>

                        </div>

                    </div>

                </a>

            </article>
            @endforeach

        </div>

        {{-- MOBILE DIRECTORY CTA BAR --}}
        <div class="mt-8 px-4 text-center md:hidden">
            <a href="/ms/{{ $this->category->slug }}"
               wire:navigate
               class="inline-flex w-full items-center justify-center gap-1 px-5 py-3 rounded-none bg-neutral-900 hover:bg-neutral-950 text-white text-xs font-black uppercase tracking-wider transition-colors shadow-none">
                View All {{ $this->category->name }}
                <svg class="w-3 h-3 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

    </section>

    @endif
</div>