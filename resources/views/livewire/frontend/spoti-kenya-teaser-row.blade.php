<div>
    @if($this->category)

    <section id="spotikenya" class="w-full py-10 mx-auto bg-white text-slate-900 antialiased">

        {{-- BBC STYLE HEADER: Sharp Top Accent Bar --}}
        <header class=" mb-8">
            <div class="flex items-center justify-between border-b-2 border-slate-900 pb-3">

                <h2 class="inline-block text-xs font-black uppercase tracking-widest text-white px-3 py-1.5 rounded-none"
                    style="background: {{ $this->category->bg_color ?? '#111827' }}; color: {{ $this->category->text_color ?? '#ffffff' }};">
                    <a href="/ms/{{ $this->category->slug }}" wire:navigate>
                        {{ $this->category->name }}
                    </a>
                </h2>

                <a href="/ms/{{ $this->category->slug }}"
                    wire:navigate
                    class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-slate-900 flex items-center gap-1 transition-colors">
                    All {{ $this->category->name }}
                    <span class="text-sm font-normal">&rarr;</span>
                </a>

            </div>
        </header>

        {{-- EDITORIAL GRID --}}
        <div class=" grid grid-cols-1 lg:grid-cols-3 gap-10 mx-auto ">

            {{-- HERO BLOCK --}}
            <div class="lg:col-span-1 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                @if($this->dynamicLayoutColumns['hero'])
                @php $heroItem = $this->dynamicLayoutColumns['hero']; @endphp

                <a href="/ms/{{ $this->category->slug }}/{{ $heroItem->slug }}"
                    wire:navigate
                    wire:key="spoti-hero-{{ $heroItem->id }}"
                    class="group block h-full bg-transparent">

                    @if($heroItem->featured_image_url)
                    <div class="overflow-hidden bg-slate-100 mb-4 rounded-none">
                        <img src="{{ $heroItem->featured_image_url }}" alt="{{ $heroItem->title }}" loading="lazy"
                            class="w-full aspect-[16/10] object-cover transition-transform duration-500 ease-out group-hover:scale-101">
                    </div>
                    @endif

                    <div class="space-y-2.5">

                        <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                            <span class="text-red-600 font-extrabold">{{ $this->category->name }}</span>
                            <span>•</span>
                            <span>{{ $heroItem->published_at->diffForHumans() }}</span>
                        </div>

                        <h3 class="text-xl font-black tracking-tight leading-snug text-slate-900 group-hover:underline md:text-2xl">
                            {{ $heroItem->title }}
                        </h3>

                        @if($heroItem->summary)
                        <p class="text-sm text-slate-600 leading-relaxed line-clamp-3 font-normal">
                            {{ $heroItem->summary }}
                        </p>
                        @endif

                    </div>
                </a>
                @endif
            </div>

            {{-- THUMBNAILS LIST --}}
            <div class="lg:col-span-1 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                <ul class="divide-y divide-slate-100">

                    @foreach($this->dynamicLayoutColumns['thumbnails'] as $thumbItem)
                    <li class="py-4 first:pt-0 last:pb-0">
                        <a href="/ms/{{ $this->category->slug }}/{{ $thumbItem->slug }}"
                            wire:navigate
                            class="group flex gap-4 items-start bg-transparent">

                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-bold leading-snug text-slate-900 group-hover:underline tracking-tight line-clamp-3">
                                    {{ $thumbItem->title }}
                                </h3>

                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-1.5 flex gap-2">
                                    <span>{{ $this->category->name }}</span>
                                    <span>•</span>
                                    <span>{{ $thumbItem->published_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            @if($thumbItem->featured_image_thumb_url)
                            <div class="w-1/3 flex-shrink-0 bg-slate-100 rounded-none overflow-hidden">
                                <img src="{{ $thumbItem->featured_image_thumb_url }}" alt="{{ $thumbItem->title }}" loading="lazy"
                                    wire:key="spoti-thumb-{{ $thumbItem->id }}"
                                    class="w-full aspect-[16/10] object-cover">
                            </div>
                            @endif

                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>

            {{-- TEXT ONLY LIST --}}
            <div class="lg:col-span-1">
                <ul class="divide-y divide-slate-200 border-t-2 border-slate-900 lg:border-t-0">

                    @foreach($this->dynamicLayoutColumns['textOnly'] as $index => $textItem)
                    <li class="py-3.5 first:pt-0 last:pb-0">
                        <a href="/ms/{{ $this->category->slug }}/{{ $textItem->slug }}"
                            wire:navigate
                            class="group block bg-transparent">

                            <div class="flex items-start gap-3">
                                {{-- BBC Headline Numeric Anchors --}}
                                <span class="text-lg font-light tracking-tight text-slate-300 group-hover:text-red-600 transition-colors">
                                    0{{ $index + 1 }}
                                </span>
                                
                                <div class="flex-1">
                                    <h3 class="text-sm font-bold leading-snug text-slate-900 group-hover:underline">
                                        {{ $textItem->title }}
                                    </h3>

                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mt-1 flex gap-2">
                                        <span>{{ $this->category->name }}</span>
                                        <span>•</span>
                                        <span>{{ $textItem->published_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </li>
                    @endforeach

                </ul>
            </div>

        </div>

        {{-- FOOTER ACCENT LINK 
        <footer class="px-4 sm:px-6 lg:px-8 mt-8 border-t border-slate-100 pt-4">
            <div class="flex justify-end">
                <a href="/ms/{{ $this->category->slug }}"
                    wire:navigate
                    class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-slate-900 flex items-center gap-1 transition-colors">
                    All {{ $this->category->name }}
                    <span class="text-sm font-normal">&rarr;</span>
                </a>
            </div>
        </footer>--}}

        {{-- FLAT EDITORIAL AD WRAPPER Advertisement--}}
        <div class="mt-12 border-t border-b border-slate-200 py-3 text-center rounded-none bg-transparent">
            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block"></span>
        </div>

    </section>

    @endif
</div>