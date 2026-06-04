<div>
    <footer class="w-full bg-neutral-950 text-neutral-300 border-t-4 border-neutral-800 antialiased font-sans">

        <div class=" py-12 mx-auto max-w-7xl">

            {{-- MAIN EDITORIAL COLUMNS --}}
            <div class=" grid grid-cols-1 gap-10 border-b border-neutral-800 pb-12 lg:grid-cols-12 lg:gap-8">

                {{-- BRAND ARCHITECTURE --}}
                <div class="lg:col-span-4 space-y-4 ml-4">
                    <div class="flex items-start gap-4">
                        {{-- Flat Geometric Logo Box --}}
                        <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-none bg-red-700 text-white font-black tracking-tighter text-xl">
                            {{ strtoupper(substr($this->footerSettings['brand_name'] ?? 'LU', 0, 2)) }}
                        </div>

                        <div class="min-w-0">
                            <h2 class="text-lg font-black tracking-tight text-white uppercase">
                                {{ $this->footerSettings['brand_name'] }}
                            </h2>
                            <p class="mt-2 max-w-sm text-xs leading-relaxed text-neutral-400 font-normal line-clamp-3">
                                {{ $this->footerSettings['brand_description'] }}
                            </p>
                        </div>
                    </div>

                    {{-- Flat Graphic Decoration 
                    @if($this->footerSettings['footer_decoration'])
                    <div class="pt-2">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($this->footerSettings['footer_decoration']) }}"
                            alt="{{ $this->footerSettings['brand_name'] ?? 'Decoration' }}"
                            loading="lazy"
                            class="h-12 w-auto rounded-none opacity-30 grayscale block">
                    </div>
                    @endif--}}
                </div>

                {{-- CATEGORY DIRECTORY GRID --}}
                <div class="lg:col-span-5">
                    <div class="mb-5 border-b border-neutral-800 pb-2">
                        <h3 class="text-xs font-black uppercase tracking-wider text-white">
                            {{ $this->footerSettings['sections_title'] }}
                        </h3>
                    </div>

                    <ul class="grid grid-cols-2 gap-x-4 gap-y-3 sm:grid-cols-3">
                        @forelse($this->footerCategories as $cat)
                        <li wire:key="footer-category-{{ $cat['id'] }}">
                            <a href="/ms/{{ $cat['slug'] }}"
                                wire:navigate
                                class="text-xs font-bold text-neutral-400 hover:text-white hover:underline transition-colors block truncate">
                                {{ $cat['name'] }}
                            </a>
                        </li>
                        @empty
                        <li class="text-xs text-neutral-500 font-normal">Categories unavailable.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- EDITORIAL META & COMPLIANCE LINKS --}}
                <div class="lg:col-span-3">
                    <div class="mb-5 border-b border-neutral-800 pb-2">
                        <h3 class="text-xs font-black uppercase tracking-wider text-white">
                            {{ $this->footerSettings['information_title'] }}
                        </h3>
                    </div>

                    <ul class="space-y-3">
                        @forelse($this->metaLinks as $index => $link)
                        <li wire:key="footer-meta-{{ $index }}">
                            <a href="{{ $link['url'] }}"
                                class="text-xs font-medium text-neutral-400 hover:text-white hover:underline block truncate"
                                @if($link['open_in_new_tab']) target="_blank" rel="noopener noreferrer" @endif>
                                {{ $link['title'] }}
                            </a>
                        </li>
                        @empty
                        <li class="text-xs text-neutral-500 font-normal">Links unavailable.</li>
                        @endforelse
                    </ul>
                </div>

            </div>

            {{-- COPYRIGHT & COMPLIANCE BAR --}}
            <div class="flex flex-col items-start justify-between gap-6 pt-8 sm:flex-row sm:items-center">
                
                <div class="space-y-2">
                    <p class="text-xs font-normal tracking-wide text-neutral-500">
                        &copy; {{ $currentYear }} {{ $this->footerSettings['copyright_text'] ?? 'Lusweti Online Center' }}. All rights reserved.
                    </p>
                    <p class="text-[10px] leading-relaxed  text-neutral-600 max-w-2xl font-normal">
                        The content of external sites is not the responsibility of this publication.
                    </p>
                </div>

                <div class="flex-shrink-0 rounded-none bg-transparent text-neutral-400">
                    <livewire:frontend.social-links />
                </div>

            </div>

        </div>
    </footer>
</div>