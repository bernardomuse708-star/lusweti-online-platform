<div class="w-full bg-white text-neutral-900 antialiased font-sans">
    @if($this->category)

    <section id="{{ $this->category->slug }}" class="w-full py-10 border-b border-neutral-200">
        
        {{-- SECTION EDITORIAL HEADER --}}
        <div class="mx-auto flex items-end justify-between border-b-2 border-neutral-900 pb-3 mb-8">

            <div class="flex items-start gap-3">
                {{-- Flat Geometric Color Indicator --}}
                <div class="w-3 h-8 shrink-0 rounded-none block"
                     style="background-color: {{ $this->category->bg_color }}"></div>

                <div class="space-y-1">
                    <h2 class="text-2xl lg:text-3xl font-black tracking-tight text-neutral-900 uppercase">
                        {{ $this->category->name }}
                    </h2>
                    <p class="text-xs font-normal text-neutral-500">
                        Explore visual stories and featured photo galleries
                    </p>
                </div>
            </div>

            {{-- Index Directory Link --}}
            <a href="/ms/{{ $this->category->slug }}"
               wire:navigate
               class="hidden md:flex items-center gap-1 text-xs font-black uppercase tracking-wider text-neutral-600 hover:text-neutral-950 hover:underline">
                View All Galleries
                <svg class="w-3 h-3 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
            </a>

        </div>

        {{-- GEOMETRIC GALLERY GRID --}}
        <div class=" grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">

            @foreach($this->collectionItems as $gallery)
            <article wire:key="gallery-teaser-{{ $gallery->id }}"
                     class="group bg-white border border-neutral-200 rounded-none shadow-none text-neutral-900 flex flex-col">

                <a href="/ms/{{ $this->category->slug }}/{{ $gallery->slug }}"
                   wire:navigate
                   class="block w-full h-full flex flex-col focus:outline-none">

                    {{-- FLAT IMAGE MEDIA CONTAINER --}}
                    <div class="relative w-full aspect-[16/10] bg-neutral-100 border-b border-neutral-200 overflow-hidden">

                        @if($gallery->image_path)
                        <img src="{{ $gallery->image_path }}"
                             alt="{{ $gallery->title }}"
                             loading="lazy"
                             class="w-full h-full object-cover rounded-none block">
                        @endif

                        {{-- Flat Editorial Media Type Badge --}}
                        <div class="absolute bottom-0 left-0 bg-neutral-950 bg-opacity-90 text-white text-[10px] font-black tracking-wider uppercase px-2.5 py-1 flex items-center gap-1.5 rounded-none">
                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />
                            </svg>
                            <span>Gallery</span>
                        </div>

                    </div>

                    {{-- CARD METADATA & TYPOGRAPHY --}}
                    <div class="p-4 flex flex-col flex-1 justify-between min-h-[140px] space-y-3">

                        <h3 class="text-sm font-extrabold text-neutral-900 group-hover:text-neutral-800 group-hover:underline leading-snug line-clamp-3">
                            {{ $gallery->title }}
                        </h3>

                        <div class="pt-2 border-t border-neutral-100 flex items-center justify-between text-[11px] font-medium tracking-tight text-neutral-400">
                            
                            <span class="inline-flex items-center gap-1 text-xs font-bold text-red-700 uppercase tracking-wide">
                                View Gallery
                                <svg class="w-2.5 h-2.5 text-neutral-400 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>

                            @if($gallery->published_at)
                            <time class="font-normal text-neutral-500">
                                {{ $gallery->published_at->isoFormat('MMM D') }}
                            </time>
                            @endif

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
                View All Galleries
                <svg class="w-3 h-3 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        {{-- FLAT EDITORIAL AD WRAPPER Advertisement--}}
        <div class="mt-6 border-t border-b border-slate-200 py-3 text-center rounded-none bg-transparent">
            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block"></span>
        </div>

    </section>

    @endif
</div>