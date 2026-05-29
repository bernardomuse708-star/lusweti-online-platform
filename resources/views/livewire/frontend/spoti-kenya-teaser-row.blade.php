<div>
    @if($this->category)

    <section id="spotikenya" class="w-full py-8 mx-auto max-w-7xl">

        {{-- HEADER --}}
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-5">
            <div class="flex items-center justify-between">

                <h2
                    class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold tracking-wide shadow-sm"
                    style="background: {{ $this->category->bg_color }}; color: {{ $this->category->text_color }};">
                    <a href="/ms/{{ $this->category->slug }}" wire:navigate>
                        {{ $this->category->name }}
                    </a>
                </h2>

                <a
                    href="/ms/{{ $this->category->slug }}"
                    wire:navigate
                    class="text-sm font-medium text-gray-600 hover:text-black flex items-center gap-1">
                    All {{ $this->category->name }}
                    <svg class="w-4 h-4">
                        <use xlink:href="#icon-more"></use>
                    </svg>
                </a>

            </div>
        </header>

        {{-- GRID --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6 mx-auto max-w-7xl">

            {{-- HERO --}}
            <div class="lg:col-span-1">
                @if($this->dynamicLayoutColumns['hero'])
                @php $heroItem = $this->dynamicLayoutColumns['hero']; @endphp

                <a href="/ms/{{ $this->category->slug }}/{{ $heroItem->slug }}"
                    wire:navigate
                    class="group block rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition bg-white">

                    @if($heroItem->image_path)
                    <div class="overflow-hidden">
                        <img src="{{ $heroItem->getFirstMediaUrl('default') }}" alt="{{ $heroItem->title }}" loading="lazy"
                            class="w-full h-64 object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    @endif

                    <div class="p-4 space-y-2">

                        <h3 class="text-lg font-bold leading-snug text-gray-900 group-hover:text-black">
                            {{ $heroItem->title }}
                        </h3>

                        @if($heroItem->summary)
                        <p class="text-sm text-gray-600 line-clamp-3">
                            {{ $heroItem->summary }}
                        </p>
                        @endif

                        <div class="text-xs text-gray-500 flex gap-2">
                            <span class="font-medium">{{ $this->category->name }}</span>
                            <span>•</span>
                            <span>{{ $heroItem->published_at->diffForHumans() }}</span>
                        </div>

                    </div>
                </a>
                @endif
            </div>

            {{-- THUMBNAILS --}}
            <div class="space-y-4">

                @foreach($this->dynamicLayoutColumns['thumbnails'] as $thumbItem)
                <a href="/ms/{{ $this->category->slug }}/{{ $thumbItem->slug }}"
                    wire:navigate
                    class="flex gap-3 p-3 bg-white rounded-xl shadow-sm hover:shadow-md transition">

                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-gray-900 line-clamp-2">
                            {{ $thumbItem->title }}
                        </h3>

                        <div class="text-xs text-gray-500 mt-1 flex gap-2">
                            <span>{{ $this->category->name }}</span>
                            <span>•</span>
                            <span>{{ $thumbItem->published_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    @if($thumbItem->image_path)


                    <img src="{{ $thumbItem->getFirstMediaUrl('default') }}" alt="{{ $thumbItem->title }}" loading="lazy"
                        class="w-20 h-20 rounded-lg object-cover">


                    @endif

                </a>
                @endforeach

            </div>

            {{-- TEXT ONLY --}}
            <div class="space-y-3">

                @foreach($this->dynamicLayoutColumns['textOnly'] as $textItem)
                <a href="/ms/{{ $this->category->slug }}/{{ $textItem->slug }}"
                    wire:navigate
                    class="block p-3 rounded-lg hover:bg-gray-50 transition">

                    <h3 class="text-sm font-medium text-gray-900 line-clamp-2">
                        {{ $textItem->title }}
                    </h3>

                    <div class="text-xs text-gray-500 mt-1 flex gap-2">
                        <span>{{ $this->category->name }}</span>
                        <span>•</span>
                        <span>{{ $textItem->published_at->diffForHumans() }}</span>
                    </div>

                </a>
                @endforeach

            </div>

        </div>

        {{-- FOOTER --}}
        <footer class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="flex justify-end">
                <a href="/ms/{{ $this->category->slug }}"
                    wire:navigate
                    class="text-sm font-semibold text-gray-700 hover:text-black flex items-center gap-1">
                    All {{ $this->category->name }}
                    <svg class="w-4 h-4">
                        <use xlink:href="#icon-more"></use>
                    </svg>
                </a>
            </div>
        </footer>

    </section>

    @endif
</div>