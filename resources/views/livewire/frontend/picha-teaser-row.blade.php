<div>
@if($this->category)

<section
    id="{{ $this->category->slug }}"
    class="relative py-8 lg:py-12"
    wire:ignore
>

    {{-- SECTION HEADER --}}
    <div class="flex items-center justify-between mb-8 mx-auto max-w-7xl">

        <div class="flex items-center gap-4">

            <div
                class="w-2 h-12 rounded-full"
                style="background-color: {{ $this->category->bg_color }}"
            ></div>

            <div>

                <h2
                    class="text-2xl lg:text-4xl font-black text-yellow-600 tracking-tight"
                    style="color: {{ $this->category->text_color }}"
                >
                    {{ $this->category->name }}
                </h2>

                <p class="text-sm text-slate-500">
                    Explore visual stories and featured photo galleries
                </p>

            </div>

        </div>

        <a
            href="/ms/{{ $this->category->slug }}"
            wire:navigate
            class="hidden md:flex items-center gap-2 text-sm font-semibold text-purple-600 hover:text-purple-700 transition"
        >
            View All Galleries

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

    {{-- GALLERY GRID --}}
    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4 mx-auto max-w-7xl">

        @foreach($this->collectionItems as $gallery)

            <article
                wire:key="gallery-teaser-{{ $gallery->id }}"
                class="group overflow-hidden rounded-2xl bg-white border border-slate-200 hover:border-purple-300 hover:shadow-2xl transition-all duration-500 hover:-translate-y-1"
            >

                <a
                    href="/ms/{{ $this->category->slug }}/{{ $gallery->slug }}"
                    wire:navigate
                    class="block h-full"
                >

                    {{-- IMAGE --}}
                    <div class="relative overflow-hidden">

                        @if($gallery->image_path)

                            <img
                                src="{{ $gallery->image_path }}"
                                alt="{{ $gallery->title }}"
                                loading="lazy"
                                class="w-full h-64 object-cover transition duration-700 group-hover:scale-110"
                            >

                        @endif

                        {{-- Overlay --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"
                        ></div>

                        {{-- Gallery Icon --}}
                        <div
                            class="absolute top-4 left-4 w-12 h-12 rounded-full backdrop-blur-md bg-white/20 border border-white/30 flex items-center justify-center"
                        >

                            <svg
                                class="w-6 h-6 text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"
                                />
                            </svg>

                        </div>

                        {{-- Gallery Badge --}}
                        <div
                            class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold"
                            style="
                                background: {{ $this->category->bg_color }};
                                color: {{ $this->category->text_color }};
                            "
                        >
                            Gallery
                        </div>

                        {{-- Date --}}
                        <div
                            class="absolute bottom-4 right-4 px-3 py-1 rounded-lg bg-black/70 text-white text-xs"
                        >
                            {{ $gallery->published_at->isoFormat('MMM D') }}
                        </div>

                    </div>

                    {{-- CONTENT --}}
                    <div class="p-5 flex flex-col min-h-[180px]">

                        <h3
                            class="text-lg font-bold text-slate-900 leading-snug line-clamp-3 group-hover:text-purple-600 transition"
                        >
                            {{ $gallery->title }}
                        </h3>

                        <div class="mt-auto pt-5">

                            <span
                                class="inline-flex items-center gap-2 text-purple-600 font-semibold text-sm"
                            >
                                View Gallery

                                <svg
                                    class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
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

    {{-- MOBILE CTA --}}
    <div class="mt-8 text-center md:hidden">

        <a
            href="/ms/{{ $this->category->slug }}"
            wire:navigate
            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-900 text-white font-semibold"
        >
            View All Galleries

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