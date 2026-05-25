<div>
    <footer class="bg-slate-900 text-slate-300" wire:ignore>
        <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8">

            <div class="grid grid-cols-2 gap-12 md:grid-cols-4 lg:grid-cols-6">

                {{-- Categories Navigation --}}
                <nav role="navigation" aria-label="Site index" class="mb-12">
                    <ul class="grid grid-cols-2 gap-x-6 gap-y-6 md:grid-cols-3 lg:grid-cols-6">
                        {{-- CHANGED: $categories is now $footerCategories --}}
                        @forelse($footerCategories as $cat)
                        <li wire:key="footer-cat-{{ $cat->id }}">
                            <a href="/ms/{{ $cat->slug }}" class="block text-sm font-black uppercase tracking-widest text-white transition-colors hover:text-red-500" wire:navigate>
                                {{ $cat->name }}
                            </a>
                        </li>
                        @empty
                        <li class="text-xs text-gray-500">Categories unavailable.</li>
                        @endforelse
                    </ul>
                </nav>

                <!-- Site Index Column -->
                <div class="col-span-2 lg:col-span-3">
                    <h3 class="mb-6 text-sm font-bold uppercase tracking-wider text-white">Sections</h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($footerCategories as $category)
                        <li>
                            <a href="/ms/{{ $category->slug }}"
                                wire:navigate
                                class="group flex items-center gap-2 text-sm font-medium transition-colors hover:text-red-500">
                                <span class="h-1 w-1 rounded-full bg-slate-600 transition-colors group-hover:bg-red-500"></span>
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Meta/Info Column -->
                <div class="col-span-2">
                    <h3 class="mb-6 text-sm font-bold uppercase tracking-wider text-white">Information</h3>
                    <ul class="space-y-4 text-sm font-medium">
                        <li><a href="/about" class="hover:text-red-500 transition-colors">About Us</a></li>
                        <li><a href="/terms" class="hover:text-red-500 transition-colors">Terms of Service</a></li>
                        <li><a href="/privacy" class="hover:text-red-500 transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Branding / Decoration -->
                <div class="col-span-2 md:col-span-1 lg:col-span-1 flex items-start justify-end">
                    <img src="{{ asset('resource/crblob/4367644/a26213978044efb02abdc086cd487b55/footer-decoration-ms-svg-data.svg') }}"
                        alt="Mwanaspoti"
                        class="h-16 w-16 opacity-50 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-500"
                        loading="lazy">
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="mt-16 border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-slate-500">
                    Nation Media Group © {{ $currentYear }}
                </p>
                <div class="flex gap-6">
                    <a href="#" class="text-slate-500 hover:text-white transition-colors">Twitter</a>
                    <a href="#" class="text-slate-500 hover:text-white transition-colors">Facebook</a>
                </div>
            </div>
        </div>
    </footer>

</div>