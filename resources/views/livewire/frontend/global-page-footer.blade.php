<div>
    <footer class="relative overflow-hidden bg-slate-950 text-slate-300">

        {{-- BACKGROUND EFFECTS --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden opacity-20">
            <div class="absolute -left-24 top-0 h-72 w-72 rounded-full bg-red-600 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 h-72 w-72 rounded-full bg-orange-500 blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-6 py-16 lg:px-8">

            {{-- TOP GRID --}}
            <div class="grid gap-14 border-b border-slate-800 pb-14 lg:grid-cols-12">

                {{-- BRAND --}}
                <div class="lg:col-span-4">
                    <div class="flex items-start gap-4">
                        {{-- LOGO --}}
                        <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-red-500 via-red-600 to-orange-500 shadow-lg shadow-red-500/20">
                            <span class="text-lg font-black tracking-widest text-white">
                                {{ strtoupper(substr($this->footerSettings['brand_name'] ?? 'LUSWETI', 0, 2)) }}

                            </span>
                        </div>

                        {{-- BRAND CONTENT --}}
                        <div class="min-w-0">
                            <h2 class="truncate text-2xl font-black tracking-tight text-white">
                                {{ $this->footerSettings['brand_name'] }}
                            </h2>
                            <p class="mt-3 max-w-sm text-sm leading-relaxed text-slate-400 line-clamp-3">
                                {{ $this->footerSettings['brand_description'] }}
                            </p>
                        </div>
                    </div>

                    {{-- DECORATION --}}
                    @if($this->footerSettings['footer_decoration'])
                    <div class="mt-10">

                        <img src="{{ \Illuminate\Support\Facades\Storage::url($this->footerSettings['footer_decoration']) }}"
                            alt="{{ $this->footerSettings['brand_name'] ?? 'Decoration' }}"
                            loading="lazy"
                            class="h-20 w-20 opacity-40 grayscale transition-all duration-500 hover:opacity-100 hover:grayscale-0">

                    </div>
                    @endif
                </div>

                {{-- SECTIONS --}}
                <div class="lg:col-span-5">
                    <div class="mb-7 flex items-center gap-3">
                        <div class="h-6 w-1 rounded-full bg-red-500"></div>
                        <h3 class="text-sm font-black uppercase tracking-[0.25em] text-white">
                            {{ $this->footerSettings['sections_title'] }}
                        </h3>
                    </div>

                    <ul class="grid grid-cols-2 gap-x-6 gap-y-5 md:grid-cols-3">

                        @forelse($this->footerCategories as $cat)
                        <li wire:key="footer-category-{{ $cat['id'] }}">
                            <a
                                href="/ms/{{ $cat['slug'] }}"
                                wire:navigate
                                class="group inline-flex items-center gap-3 text-sm font-bold tracking-wide text-slate-300 transition-all duration-300 hover:text-red-500">

                                <span class="h-1.5 w-1.5 rounded-full bg-slate-600 transition-all duration-300 group-hover:scale-125 group-hover:bg-red-500"></span>

                                <span class="line-clamp-1">
                                    {{ $cat['name'] }}
                                </span>
                            </a>
                        </li>

                        @empty
                        <li class="text-sm text-slate-500">Categories unavailable.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- META LINKS --}}
                <div class="lg:col-span-3">
                    <div class="mb-7 flex items-center gap-3">
                        <div class="h-6 w-1 rounded-full bg-orange-500"></div>
                        <h3 class="text-sm font-black uppercase tracking-[0.25em] text-white">
                            {{ $this->footerSettings['information_title'] }}
                        </h3>
                    </div>

                    <ul class="space-y-5">
                        @forelse($this->metaLinks as $index => $link)
                        <li wire:key="footer-meta-{{ $index }}">
                            <a
                                href="{{ $link['url'] }}"
                                class="group inline-flex items-center gap-3 text-sm font-medium text-slate-400 transition-all duration-300 hover:text-white"
                                @if($link['open_in_new_tab'])
                                target="_blank"
                                rel="noopener noreferrer"
                                @endif>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-600 transition-all duration-300 group-hover:translate-x-1 group-hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                <span class="line-clamp-1">
                                    {{ $link['title'] }}
                                </span>
                            </a>
                        </li>
                        @empty
                        <li class="text-sm text-slate-500">Links unavailable.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- FOOTER BOTTOM --}}
            <div class="flex flex-col items-center justify-between gap-6 pt-8 md:flex-row">

                {{-- COPYRIGHT --}}
                <p class="text-center text-xs font-medium tracking-wide text-slate-500 md:text-left">
                    © {{ $currentYear }} {{ $this->footerSettings['copyright_text'] ?? 'Lusweti Online Center' }}. All rights reserved.
                </p>

                {{-- SOCIAL LINKS --}}
                <livewire:frontend.social-links/>
            </div>
        </div>
    </footer>
</div>