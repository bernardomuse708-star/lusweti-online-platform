<div>
    @if($this->category)

<section
    id="{{ $this->category->slug }}"
    class="relative py-8 lg:py-12"
>

    {{-- Category Header --}}
    <div class="flex items-center justify-between mb-8 mx-auto max-w-7xl">

        <div class="flex items-center gap-4">

            <div
                class="h-12 w-2 rounded-full"
                style="background-color: {{ $this->category->bg_color }}"
            ></div>

            <div>
                <h2
                    class="text-2xl lg:text-4xl font-black tracking-tight"
                    style="color: {{ $this->category->text_color }}"
                >
                    {{ $this->category->name }}
                </h2>

                <p class="text-sm text-gray-500">
                    Latest updates and featured stories
                </p>
            </div>

        </div>

        <a
            href="/ms/{{ $this->category->slug }}"
            wire:navigate
            class="hidden md:flex items-center gap-2 text-sm font-semibold text-purple-600 hover:text-purple-700"
        >
            View All

            <svg class="w-4 h-4">
                <path
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    d="M5 12h14m-6-6l6 6-6 6"
                />
            </svg>
        </a>

    </div>

    {{-- Articles Grid --}}
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

        @foreach($this->gridArticles as $article)

            <article
                wire:key="grid-teaser-{{ $article->id }}"
                class="group bg-white rounded-2xl overflow-hidden border border-slate-200 hover:border-purple-300 hover:shadow-2xl transition-all duration-500 hover:-translate-y-1"
            >

                <a
                    href="/ms/{{ $this->category->slug }}/{{ $article->slug }}"
                    wire:navigate
                    class="block h-full"
                >

                    {{-- Featured Image --}}
                    @if($article->image_path)

                        <div class="relative overflow-hidden">
                            <img src="{{ $article->getFirstMediaUrl('default') }}" alt="{{ $article->title }}" loading="lazy"
                                class="w-full h-56 object-cover transition duration-700 group-hover:scale-105">


                           

                            <div
                                class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-bold"
                                style="
                                    background: {{ $this->category->bg_color }};
                                    color: {{ $this->category->text_color }};
                                "
                            >
                                {{ $article->topic_label ?? $this->category->name }}
                            </div>

                        </div>

                    @endif

                    {{-- Content --}}
                    <div class="p-6 flex flex-col h-[260px]">

                        <h3
                            class="text-xl font-bold text-slate-900 line-clamp-2 mb-3 group-hover:text-purple-600 transition"
                        >
                            {{ $article->title }}
                        </h3>

                        <p
                            class="text-slate-600 text-sm leading-relaxed line-clamp-3"
                        >
                            {{ $article->summary }}
                        </p>

                        <div class="mt-auto pt-6">

                            <div class="flex items-center justify-between">

                                <span class="text-xs text-gray-500">
                                    {{ $article->published_at->diffForHumans() }}
                                </span>

                                <span
                                    class="inline-flex items-center gap-1 text-sm font-semibold text-purple-600"
                                >
                                    Read Story

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
            View All {{ $this->category->name }}

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