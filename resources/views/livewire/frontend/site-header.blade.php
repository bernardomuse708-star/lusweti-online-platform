<div>
    <header x-data="{ mobileMenuOpen: false, accountMenuOpen: false }" class="sticky top-0 z-50 w-full bg-white font-sans shadow-sm">

        {{-- Breaking News Banner (Top) --}}
        <div x-data="{ hasNews: @entangle('latestBreakingNews') }"
            x-show="hasNews"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-y-full opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            class="bg-red-600 px-4 py-2.5 text-center text-sm font-medium text-white sm:px-6 lg:px-8 relative z-50">
            @if($latestBreakingNews)
            <a href="{{ $latestBreakingNews['url'] }}" wire:navigate class="inline-flex flex-wrap items-center justify-center gap-2 hover:opacity-90 transition-opacity">
                <span class="rounded bg-black/25 px-2 py-0.5 text-xs font-bold tracking-wider shadow-inner">HABARI MPYA</span>
                <span class="truncate">{{ $latestBreakingNews['headline'] }}</span>
            </a>
            @endif
        </div>

        {{-- Main Navigation Bar --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-40 bg-white">
            <div class="flex h-16 sm:h-20 items-center justify-between">

                {{-- Left Section: Mobile Menu Toggle & ePaper --}}
                <div class="flex items-center gap-4 flex-1">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="group p-2 text-gray-600 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 rounded-md transition-colors"
                        aria-expanded="false">
                        <span class="sr-only">Toggle menu</span>
                        {{-- Hamburger Icon --}}
                        <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        {{-- Close Icon --}}
                        <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <a href="https://mwanaclick.com?utm_source=direct&utm_medium=service%20link" target="_blank" rel="noopener" class="hidden sm:block text-sm font-bold tracking-wide text-gray-500 hover:text-red-600 transition-colors">
                        ePaper
                    </a>
                </div>

                {{-- Center Section: Logo --}}
                <div class="flex justify-center flex-shrink-0">
                    <a href="/" wire:navigate aria-label="Homepage" class="group">
                        <img class="h-8 sm:h-10 w-auto transform transition-transform group-hover:scale-105"
                            src="{{ asset('resource/crblob/4351492/5c3d71953e078c66977c4abdce89ec1e/ms-logo-svg-data.svg') }}"
                            alt="Mwanaspoti">
                    </a>
                </div>

                {{-- Right Section: Search & Account --}}
                <div class="flex items-center justify-end gap-3 sm:gap-6 flex-1">
                    <a href="/ms/search" wire:navigate class="p-2 text-gray-500 hover:text-red-600 transition-colors rounded-full hover:bg-gray-50" aria-label="Search">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </a>

                    <div class="relative" @click.away="accountMenuOpen = false">
                        @guest
                        <div class="hidden md:flex items-center gap-4">
                            <a href="/login" wire:navigate class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">Log in</a>
                            <a href="/ms/subscribe" wire:navigate class="rounded-full bg-red-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-red-700 hover:shadow transition-all">Subscribe</a>
                        </div>
                        @endguest

                        @auth
                        <button @click="accountMenuOpen = !accountMenuOpen" class="flex items-center gap-2 rounded-full border border-gray-200 bg-white p-1 pr-3 hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-xs font-bold text-white uppercase">
                                {{ Str::of(auth()->user()->name)->explode(' ')->map(fn($word) => Str::substr($word, 0, 1))->join('') }}
                            </div>
                            <span class="hidden sm:block text-sm font-semibold text-gray-700 truncate max-w-[120px]">
                                {{ auth()->user()->name }}
                            </span>
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        {{-- Account Dropdown --}}
                        <div x-show="accountMenuOpen"
                            x-cloak
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            class="absolute right-0 mt-3 w-56 origin-top-right rounded-xl bg-white shadow-xl ring-1 ring-black/5 divide-y divide-gray-100">

                            <div class="px-4 py-3">
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Akaunti yangu</p>
                            </div>

                            <div class="p-1.5">
                                <a href="/profile" wire:navigate class="block rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-red-600">Maelezo ya kibinafsi</a>
                                <a href="/profile/password" wire:navigate class="block rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-red-600">Badilisha neno la siri</a>
                                <a href="/profile/purchases" wire:navigate class="block rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-red-600">Uliyonunua</a>
                            </div>

                            <div class="p-1.5">
                                <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-red-50 hover:text-red-700">
                                        Toka
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        {{-- Sub Navigation (Categories Carousel) --}}
        <nav class="border-b border-gray-100 bg-white relative z-30">
           


            <!-- CATEGORY BAR -->
            <div class="border-t border-slate-100 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="flex items-center gap-6 overflow-x-auto py-3 text-sm font-medium">

                        @foreach($this->categories as $category)
                        <a href="/ms/{{ $category->slug }}"
                            wire:navigate
                            class="whitespace-nowrap text-slate-600 hover:text-black transition">
                            {{ $category->name }}
                        </a>
                        @endforeach

                    </div>

                </div>
            </div>
        </nav>

        {{-- Mega Menu (Dropdown) --}}
        <nav x-show="mobileMenuOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="absolute left-0 top-full w-full bg-slate-900 border-t border-slate-800 shadow-2xl z-20">

            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                <div class="mb-8 block sm:hidden">
                    <a href="https://mwanaclick.com" target="_blank" rel="noopener" class="inline-block rounded-lg bg-slate-800 px-4 py-2 text-sm font-bold text-white hover:bg-slate-700">
                        Soma ePaper
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-x-8 gap-y-6 sm:grid-cols-3 lg:grid-cols-6">
                    @foreach($this->categories as $category)
                    <a href="/ms/{{ $category->slug }}" wire:navigate class="group flex items-center text-sm font-bold uppercase tracking-wider text-slate-300 hover:text-white transition-colors">
                        <span class="border-b-2 border-transparent group-hover:border-red-500 pb-0.5 transition-all">
                            {{ $category->name }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>
        </nav>

    </header>

</div>

{{-- Add this custom utility to your app.css to hide the ugly scrollbar on the sub-nav --}}
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>