<div>
    @if($this->category)
    <section class="">

        {{-- Section Header: BBC Style Top Accent Line Bar --}}
        <div class="mb-8 flex items-center justify-between border-b-2 border-slate-900 pb-3">
            <h2 class="inline-block text-xs font-black uppercase tracking-widest text-white px-3 py-1.5"
                style="background-color: {{ $this->category->bg_color ?? '#111827' }}; color: {{ $this->category->text_color ?? '#ffffff' }};">
                {{ $this->category->name }}
            </h2>
            <a href="/ms/{{ $this->category->slug }}"
                class="group flex items-center text-xs font-bold uppercase tracking-wider text-slate-500 transition-colors hover:text-slate-900">
                View All
                <span class="ml-1.5 transition-transform group-hover:translate-x-1">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-3">

            {{-- Lead Story: Sharp Framing & Distinct Typography Hierarchy --}}
            @if($largeItem = $this->columnLayouts['large'] ?? null)
            <article class="lg:col-span-1 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                <a href="/ms/{{ $this->category->slug }}/{{ $largeItem->slug }}" wire:navigate class="group block h-full">
                    <div class="relative mb-4 overflow-hidden bg-slate-100 rounded-none">
                        @php
                            $heroImage = $largeItem->featured_image_url ?? asset('images/placeholders/article-default.jpg');
                            $heroMissing = !$largeItem->hasMedia('featured_image');
                        @endphp
                        <img src="{{ $heroImage }}"
                            alt="{{ $largeItem->title }}"
                            loading="lazy"
                            class="aspect-[16/10] w-full object-cover transition-transform duration-500 ease-out group-hover:scale-101">
                        @if($heroMissing)
                            <div class="absolute inset-x-0 bottom-0 bg-red-600/90 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-white">
                                Debug: no extracted image attached yet
                            </div>
                        @endif
                    </div>
                    
                    <div class="space-y-2.5">
                        <div class="flex items-center gap-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                            <span class="text-red-600 font-extrabold">{{ $this->category->name }}</span>
                            <span>&bull;</span>
                            <span>{{ $largeItem->published_at->isoFormat('MMM D') }}</span>
                        </div>
                        
                        <h3 class="text-xl font-black tracking-tight leading-snug text-slate-900 group-hover:underline md:text-2xl">
                            {{ $largeItem->title }}
                        </h3>
                        
                        <p class="text-sm leading-relaxed text-slate-600 line-clamp-3 font-normal">
                            {{ $largeItem->summary }}
                        </p>
                    </div>
                </a>
            </article>
            @endif

            {{-- Thumbnail List: Uniform Layout --}}
            <div class="lg:col-span-1 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                <ul class="divide-y divide-slate-100">
                    @forelse($this->columnLayouts['thumbnails'] ?? [] as $thumbItem)
                    <li wire:key="hadithi-thumb-{{ $thumbItem->id }}" class="py-4 first:pt-0 last:pb-0">
                        <a href="/ms/{{ $this->category->slug }}/{{ $thumbItem->slug }}" wire:navigate class="group flex items-start gap-4">
                            <div class="w-1/3 flex-shrink-0 overflow-hidden bg-slate-100 rounded-none">
                                @php
                                    $thumbImage = $thumbItem->featured_image_thumb_url ?? asset('images/placeholders/article-default.jpg');
                                    $thumbMissing = !$thumbItem->hasMedia('featured_image');
                                @endphp
                                <div class="relative overflow-hidden">
                                    <img src="{{ $thumbImage }}" alt="{{ $thumbItem->title }}" loading="lazy"
                                        class="aspect-[16/10] w-full object-cover">
                                    @if($thumbMissing)
                                        <div class="absolute inset-x-0 bottom-0 bg-red-600/90 px-1 py-0.5 text-[9px] font-bold uppercase text-white tracking-tight">
                                            Missing image
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex-1">
                                <h3 class="text-sm font-bold leading-snug text-slate-900 group-hover:underline tracking-tight">
                                    {{ $thumbItem->title }}
                                </h3>
                                <p class="mt-1 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                    {{ $thumbItem->published_at->isoFormat('MMM D') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    @empty
                    <li class="text-sm text-slate-400 italic py-2">No additional stories in this category.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Text Only List: Clean Structural Dividers --}}
            <div class="lg:col-span-1">
                <ul class="divide-y divide-slate-200 border-t-2 border-slate-900 lg:border-t-0">
                    @forelse($this->columnLayouts['textOnly'] ?? [] as $index => $textItem)
                    <li wire:key="hadithi-txt-{{ $textItem->id }}" class="py-3.5 first:pt-0 last:pb-0">
                        <a href="/ms/{{ $this->category->slug }}/{{ $textItem->slug }}" wire:navigate class="group block">
                            <div class="flex items-start gap-3">
                                {{-- Elegant structural sequence indexing instead of standard bullet points --}}
                                <span class="text-lg font-light tracking-tight text-slate-300 group-hover:text-red-600 transition-colors">
                                    0{{ $index + 1 }}
                                </span>
                                <div class="flex-1">
                                    <h3 class="text-sm font-bold leading-snug text-slate-900 group-hover:underline">
                                        {{ $textItem->title }}
                                    </h3>
                                    <p class="mt-1 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                        {{ $textItem->published_at->isoFormat('MMM D') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                    @empty
                    <li class="py-4 text-sm text-slate-400 italic">More stories coming soon.</li>
                    @endforelse
                </ul>
            </div>

        </div>
    </section>
    @endif
</div>