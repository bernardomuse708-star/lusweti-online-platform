<div>
    @if($this->category)
    <section class=" py-10 text-slate-900 antialiased  bg-white">

        {{-- BBC EDITORIAL HEADER --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between border-b-2 border-slate-900 pb-3 gap-4">
            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                <a href="/ms/{{ $this->category->slug }}"
                    wire:navigate
                    class="inline-block text-xs font-black uppercase tracking-widest px-3 py-1.5 rounded-none"
                    style="background-color: {{ $this->category->bg_color ?? '#111827' }}; color: {{ $this->category->text_color ?? '#ffffff' }};">
                    {{ $this->category->name }}
                </a>
                <span class="h-4 w-[1px] bg-slate-300 hidden sm:inline"></span>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Latest Updates</span>
            </div>
            
            <a href="/ms/{{ $this->category->slug }}"
                wire:navigate
                class="inline-flex items-center gap-1 text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-slate-900 transition-colors">
                See All
                <span class="text-sm font-normal">&rarr;</span>
            </a>
        </div>

        {{-- MAIN THREE-COLUMN EDITORIAL GRID --}}
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-6">

            {{-- COLUMN 1: LEAD FEATURED STORY --}}
            <div class="lg:col-span-4 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                @if($this->columnLayouts['featured'])
                @php $featuredItem = $this->columnLayouts['featured']; @endphp
                <a href="/ms/{{ $this->category->slug }}/{{ $featuredItem->slug }}"
                    wire:navigate
                    wire:key="hadithi-featured-{{ $featuredItem->id }}"
                    class="group block space-y-3.5">

                    <div class="relative overflow-hidden rounded-none bg-slate-100 aspect-video">
                        @php
                            $imageUrl = $featuredItem->featured_image_url ?? asset('images/placeholders/article-default.jpg');
                        @endphp
                        <img src="{{ $imageUrl }}" 
                            alt="{{ $featuredItem->title }}" 
                            loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-101">
                    </div>

                    <div class="space-y-2">
                        <h3 class="text-xl font-extrabold leading-tight tracking-tight text-slate-950 group-hover:underline decoration-1">
                            {{ $featuredItem->title }}
                        </h3>
                        @if($featuredItem->summary)
                        <p class="text-sm leading-relaxed text-slate-600 line-clamp-3 font-normal">
                            {{ $featuredItem->summary }}
                        </p>
                        @endif
                    </div>
                </a>
                @endif
            </div>

            {{-- COLUMN 2: SECONDARY ROW STACK WITH THUMBNAILS --}}
            <div class="lg:col-span-4 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0 space-y-4">
                @foreach($this->columnLayouts['thumbnails'] as $thumbItem)
                <a href="/ms/{{ $this->category->slug }}/{{ $thumbItem->slug }}"
                    wire:navigate
                    wire:key="hadithi-thumbnail-{{ $thumbItem->id }}"
                    class="group flex gap-4 border-b border-slate-100 pb-4 last:border-0 last:pb-0 items-start">
                    
                    <div class="h-16 w-24 flex-shrink-0 overflow-hidden rounded-none bg-slate-100 aspect-video">
                        @php
                            $thumbImageUrl = $thumbItem->featured_image_thumb_url ?? asset('images/placeholders/article-default.jpg');
                        @endphp
                        <img src="{{ $thumbImageUrl }}"
                            class="h-full w-full object-cover"
                            alt="{{ $thumbItem->title }}">
                    </div>

                    <div class="space-y-1 min-w-0">
                        <h3 class="text-sm font-bold leading-snug text-slate-950 group-hover:underline line-clamp-2">
                            {{ $thumbItem->title }}
                        </h3>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            {{ $thumbItem->published_at->diffForHumans() }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- COLUMN 3: SCANNABLE TEXT-ONLY STACK --}}
            <div class="lg:col-span-4 space-y-4">
                @foreach($this->columnLayouts['textOnly'] as $textItem)
                <a href="/ms/{{ $this->category->slug }}/{{ $textItem->slug }}"
                    wire:navigate
                    class="group block border-l-2 border-slate-200 pl-4 transition-colors hover:border-slate-900">
                    <h3 class="text-sm font-bold leading-snug text-slate-800 group-hover:text-slate-950 group-hover:underline line-clamp-2">
                        {{ $textItem->title }}
                    </h3>
                    <p class="mt-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        {{ $textItem->published_at->diffForHumans() }}
                    </p>
                </a>
                @endforeach
            </div>

        </div>

        {{-- FLAT EDITORIAL AD WRAPPER Advertisement--}}
        <div class="mt-12 border-t border-b border-slate-200 py-3 text-center rounded-none bg-transparent">
            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block"></span>
        </div>

    </section>
    @endif
</div>