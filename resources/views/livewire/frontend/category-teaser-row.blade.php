<div>
    @if($this->category)
    <section class=" px-4 py-12 sm:px-6 lg:px-8">

        {{-- Section Header: Cleaned Hierarchy --}}
        <div class="mb-10 flex items-center justify-between border-b border-gray-100 pb-6 max-w-7xl mx-auto">
            <h2 class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-black uppercase tracking-widest shadow-sm"
                style="background-color: {{ $this->category->bg_color }}; color: {{ $this->category->text_color }};">
                {{ $this->category->name }}
            </h2>
            <a href="/ms/{{ $this->category->slug }}"
                class="group flex items-center text-xs font-bold uppercase tracking-widest text-gray-400 transition-colors hover:text-red-600">
                View All
                <span class="ml-1 transition-transform group-hover:translate-x-1">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-3 max-w-7xl mx-auto">

            {{-- Lead Story: Optimized for High CTR --}}
            @if($largeItem = $this->columnLayouts['large'] ?? null)
            <article class="lg:col-span-1">
                <a href="/ms/{{ $this->category->slug }}/{{ $largeItem->slug }}" wire:navigate class="group block h-full">
                    <div class="relative mb-6 overflow-hidden rounded-2xl bg-gray-100 shadow-sm transition-all duration-300 group-hover:shadow-lg">
                        @if($largeItem->image_path)
                        <img src="{{ $largeItem->image_path }}"
                            alt="{{ $largeItem->title }}"
                            class="aspect-video w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        @endif
                    </div>
                    <div class="space-y-3">
                        <h3 class="text-2xl font-black leading-tight text-gray-900 transition-colors group-hover:text-red-600 tracking-tight">
                            {{ $largeItem->title }}
                        </h3>
                        <p class="text-sm leading-relaxed text-gray-600 line-clamp-3">
                            {{ $largeItem->summary }}
                        </p>
                        <div class="flex items-center gap-3 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            <span class="rounded bg-gray-100 px-2 py-0.5 text-gray-600">{{ $this->category->name }}</span>
                            <span>&bull;</span>
                            <span>{{ $largeItem->published_at->isoFormat('MMM D') }}</span>
                        </div>
                    </div>
                </a>
            </article>
            @endif

            {{-- Thumbnail List: Consistent Rhythm --}}
            <div class="space-y-8 lg:col-span-1">
                <ol class="space-y-8">
                    @forelse($this->columnLayouts['thumbnails'] ?? [] as $thumbItem)
                    <li wire:key="hadithi-thumb-{{ $thumbItem->id }}">
                        <a href="/ms/{{ $this->category->slug }}/{{ $thumbItem->slug }}" wire:navigate class="group flex items-start gap-4">
                            <div class="w-1/3 flex-shrink-0 overflow-hidden rounded-xl bg-gray-100 shadow-sm">
                                @if($thumbItem->image_path)

                                <img src="{{ $thumbItem->getFirstMediaUrl('default') }}" alt="{{ $thumbItem->title }}" loading="lazy"
                                    class="aspect-video w-full object-cover transition-transform duration-500 group-hover:scale-105">


                                @endif
                            </div>
                            <div class="flex-1 self-center">
                                <h3 class="text-sm font-bold leading-snug text-gray-900 transition-colors group-hover:text-red-600 tracking-tight">
                                    {{ $thumbItem->title }}
                                </h3>
                                <p class="mt-1.5 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                                    {{ $thumbItem->published_at->isoFormat('MMM D') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    @empty
                    <li class="text-sm text-gray-400 italic">No additional stories in this category.</li>
                    @endforelse
                </ol>
            </div>

            {{-- Text Only List: Structural Integrity --}}
            <div class="space-y-8 lg:col-span-1">
                <ol class="divide-y divide-gray-100 border-t border-gray-100">
                    @forelse($this->columnLayouts['textOnly'] ?? [] as $textItem)
                    <li wire:key="hadithi-txt-{{ $textItem->id }}" class="py-5">
                        <a href="/ms/{{ $this->category->slug }}/{{ $textItem->slug }}" wire:navigate class="group block">
                            <h3 class="flex items-center text-sm font-semibold leading-relaxed text-gray-700 transition-colors group-hover:text-red-600">
                                <span class="mr-3 inline-block h-1 w-4 rounded-full bg-red-500 transition-all group-hover:w-6"></span>
                                {{ $textItem->title }}
                            </h3>
                            <p class="mt-2 pl-7 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                                {{ $textItem->published_at->isoFormat('MMM D') }}
                            </p>
                        </a>
                    </li>
                    @empty
                    <li class="py-5 text-sm text-gray-400 italic">More coming soon.</li>
                    @endforelse
                </ol>
            </div>

        </div>
    </section>
    @endif
</div>