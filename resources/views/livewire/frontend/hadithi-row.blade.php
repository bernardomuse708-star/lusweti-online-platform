<div class="">
    @if($this->category)
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        <!-- Section Header: Refined Hierarchy -->
        <div class="mb-10 flex items-center justify-between border-b border-gray-100 pb-6 ">
            <div class="flex items-center gap-4">
                <a href="/ms/{{ $this->category->slug }}"
                    wire:navigate
                    class="inline-flex items-center rounded-lg px-4 py-1.5 text-xs font-black uppercase tracking-widest shadow-sm"
                    style="background-color: {{ $this->category->bg_color }}; color: {{ $this->category->text_color }};">
                    {{ $this->category->name }}
                </a>
                <span class="h-4 w-[1px] bg-slate-200"></span>
                <span class="text-sm font-medium text-slate-500">Latest Updates</span>
            </div>
            <a href="/ms/{{ $this->category->slug }}"
                wire:navigate
                class="group flex items-center gap-1.5 text-xs font-bold uppercase tracking-widest text-slate-500 transition-colors hover:text-red-600">
                See All
                <svg class="h-3 w-3 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-12 max-w-7xl mx-auto">

            <!-- Column 1: Featured Story (Focus Area) -->
            <div class="lg:col-span-4">
                @if($this->rowLayouts['featured'])
                @php $featuredItem = $this->rowLayouts['featured']; @endphp
                <a href="/ms/{{ $this->category->slug }}/{{ $featuredItem->slug }}"
                    wire:navigate
                    class="group block h-full space-y-4">

                    <div class="relative overflow-hidden rounded-2xl bg-slate-100 shadow-sm transition-all duration-500 group-hover:shadow-lg">
                        @if($featuredItem->image_path)
                        <img src="{{ $featuredItem->image_path }}"
                            class="aspect-[16/10] w-full object-cover transition-transform duration-700 group-hover:scale-105"
                            alt="{{ $featuredItem->title }}">
                        @endif
                    </div>

                    <div class="space-y-2">
                        <h3 class="text-xl font-black leading-tight text-slate-900 transition-colors group-hover:text-red-600">
                            {{ $featuredItem->title }}
                        </h3>
                        @if($featuredItem->summary)
                        <p class="text-sm leading-relaxed text-slate-600 line-clamp-3">
                            {{ $featuredItem->summary }}
                        </p>
                        @endif
                    </div>
                </a>
                @endif
            </div>

            <!-- Column 2: Thumbnails (Information Density) -->
            <div class="lg:col-span-4 space-y-6">
                @foreach($this->rowLayouts['thumbnails'] as $thumbItem)
                <a href="/ms/{{ $this->category->slug }}/{{ $thumbItem->slug }}"
                    wire:navigate
                    class="group flex gap-4 border-b border-slate-100 pb-6 last:border-0 last:pb-0 transition-opacity hover:opacity-80">
                    <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-lg bg-slate-100">
                        @if($thumbItem->image_path)
                        <img src="{{ $thumbItem->image_path }}"
                            class="h-full w-full object-cover"
                            alt="{{ $thumbItem->title }}">
                        @endif
                    </div>
                    <div class="flex flex-col justify-center">
                        <h3 class="text-sm font-bold leading-snug text-slate-900">
                            {{ $thumbItem->title }}
                        </h3>
                        <p class="mt-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            {{ $thumbItem->published_at->diffForHumans() }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Column 3: Text Only (Scannability) -->
            <div class="lg:col-span-4 space-y-6">
                @foreach($this->rowLayouts['textOnly'] as $textItem)
                <a href="/ms/{{ $this->category->slug }}/{{ $textItem->slug }}"
                    wire:navigate
                    class="group block border-l-2 border-slate-200 pl-4 transition-all hover:border-red-600">
                    <h3 class="text-sm font-semibold leading-relaxed text-slate-700 transition-colors group-hover:text-red-600">
                        {{ $textItem->title }}
                    </h3>
                    <p class="mt-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        {{ $textItem->published_at->diffForHumans() }}
                    </p>
                </a>
                @endforeach
            </div>

        </div>

        <!-- Ad Wrapper (Optimized) -->
        <div class="mt-12 rounded-xl bg-slate-50 border border-slate-100 p-4 text-center">
            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Advertisement</span>
        </div>

    </section>
    @endif
</div>