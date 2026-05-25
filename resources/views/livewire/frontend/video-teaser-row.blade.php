<div> 
    @if($this->category)

<section
    id="{{ $this->category->slug }}"
    class="relative py-8 lg:py-12"
>

    {{-- Section Header --}}
    <div class="flex items-center justify-between mb-8 mx-auto max-w-7xl">

        <div class="flex items-center gap-4">

            <div
                class="w-2 h-12 rounded-full"
                style="background-color: {{ $this->category->bg_color }}"
            ></div>

            <div>
                <h2
                    class="text-2xl lg:text-4xl font-black tracking-tight "
                    style="color: {{ $this->category->text_color }}"
                >
                    {{ $this->category->name }}
                </h2>

                <p class="text-sm text-slate-500">
                    Watch the latest videos and featured coverage
                </p>
            </div>

        </div>

        <a
            href="/ms/{{ $this->category->slug }}"
            wire:navigate
            class="hidden md:flex items-center gap-2 text-sm font-semibold text-red-600 hover:text-red-700"
        >
            View All Videos

            <svg
                class="w-4 h-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M14 5l7 7m0 0l-7 7m7-7H3"
                />
            </svg>

        </a>

    </div>

    {{-- Video Grid --}}
    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4 mx-auto max-w-7xl">

        @foreach($this->collectionItems as $video)

            <article
                wire:key="video-teaser-{{ $video->id }}"
                class="group bg-white rounded-2xl overflow-hidden border border-slate-200 hover:border-red-300 hover:shadow-2xl transition-all duration-500 hover:-translate-y-1"
            >

                <a
                    href="/ms/{{ $this->category->slug }}/{{ $video->slug }}"
                    wire:navigate
                    class="block h-full"
                >

                    {{-- Thumbnail --}}
                    <div class="relative overflow-hidden">

                        <img
                            src="https://i.ytimg.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg"
                            alt="{{ $video->title }}"
                            loading="lazy"
                            class="w-full h-56 object-cover transition duration-700 group-hover:scale-110"
                        >

                        {{-- Dark Overlay --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"
                        ></div>

                        {{-- Play Button --}}
                        <div
                            class="absolute inset-0 flex items-center justify-center"
                        >
                            <div
                                class="w-16 h-16 rounded-full bg-white/95 flex items-center justify-center shadow-xl transition duration-500 group-hover:scale-110"
                            >
                                <svg
                                    class="w-7 h-7 text-red-600 ml-1"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Category Badge --}}
                        <div
                            class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-bold"
                            style="
                                background: {{ $this->category->bg_color }};
                                color: {{ $this->category->text_color }};
                            "
                        >
                            {{ $this->category->name }}
                        </div>

                        {{-- Date --}}
                        <div
                            class="absolute bottom-4 right-4 px-2 py-1 rounded-lg bg-black/70 text-white text-xs"
                        >
                            {{ $video->published_at->isoFormat('MMM D') }}
                        </div>

                    </div>

                    {{-- Content --}}
                    <div class="p-5 flex flex-col min-h-[180px]">

                        <h3
                            class="font-bold text-slate-900 text-lg leading-snug line-clamp-3 group-hover:text-red-600 transition"
                        >
                            {{ $video->title }}
                        </h3>

                        <div class="mt-auto pt-5">

                            <span
                                class="inline-flex items-center gap-2 text-red-600 font-semibold text-sm"
                            >
                                Watch Video

                                <svg
                                    class="w-4 h-4 transition-transform group-hover:translate-x-1"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"
                                    />
                                </svg>

                            </span>

                        </div>

                    </div>

                </a>

            </article>

        @endforeach

    </div>

    {{-- Mobile CTA --}}
    <div class="mt-8 text-center md:hidden">

        <a
            href="/ms/{{ $this->category->slug }}"
            wire:navigate
            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-900 text-white font-semibold"
        >
            View All Videos

            <svg
                class="w-4 h-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M14 5l7 7m0 0l-7 7m7-7H3"
                />
            </svg>

        </a>

    </div>

</section>

@endif
</div>