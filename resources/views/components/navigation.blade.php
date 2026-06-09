<div class="flex items-center h-full">
    {{-- Inline Search for Desktop (Flat Block style) --}}
    <div class="hidden lg:block border-r border-gray-200 h-full py-3 pr-4">
        <form action="/ms/search" method="GET" class="m-0 p-0 relative">
            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search news..."
                class="w-48 bg-gray-100 text-gray-900 placeholder-gray-500 text-xs font-medium px-3 py-1.5 border border-transparent focus:border-gray-900 focus:bg-white focus:ring-0 transition-colors duration-150 rounded-none">
            <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-black" aria-label="Submit search">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </button>
        </form>
    </div>

    {{-- Mobile Search Trigger Only --}}
    <div class="lg:hidden px-2 border-r border-gray-200">
        <a href="/ms/search" wire:navigate class="p-2 text-gray-700 hover:text-red-600 transition-colors" aria-label="Search">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </a>
    </div>

    {{-- Account Actions Block --}}
    <div class="relative flex items-center h-full pl-4" x-data="{ accountMenuOpen: false }" @click.away="accountMenuOpen = false">
        @guest
        <div class="flex items-center gap-4">
            {{-- Global Event Dispatcher using unified Alpine element dispatch --}}
            <button type="button" 
                @click="Livewire.dispatch('open-auth-modal', { tab: 'login' })" 
                class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gray-800 hover:text-red-600 transition-colors group">
                <span class="w-5 h-5 bg-gray-200 flex items-center justify-center text-gray-600 group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </span>
                Sign In
            </button>

            <a href="/ms/subscribe" wire:navigate class="bg-red-600 px-4 py-2 text-xs font-bold uppercase tracking-wider text-white hover:bg-black transition-colors">Subscribe</a>
        </div>
        @endguest

        @auth
        <button @click="accountMenuOpen = !accountMenuOpen" 
            aria-haspopup="true"
            :aria-expanded="accountMenuOpen"
            class="flex items-center gap-2 h-full py-2 hover:text-red-600 transition-colors focus:outline-none focus:text-red-600">
            <div class="flex h-7 w-7 items-center justify-center bg-black text-[10px] font-bold text-white uppercase tracking-wider">
                {{ Str::of(auth()->user()->name)->explode(' ')->map(fn($word) => Str::substr($word, 0, 1))->join('') }}
            </div>
            <span class="hidden sm:block text-xs font-bold uppercase tracking-wide max-w-[120px] truncate">
                {{ auth()->user()->name }}
            </span>
            <svg class="h-3 w-3 text-gray-400 transform transition-transform duration-150" :class="{ 'rotate-180': accountMenuOpen }" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
        </button>

        {{-- Dropdown Menu (With Finished High-Fidelity BBC Transitions) --}}
        <div x-show="accountMenuOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 top-full mt-1 w-56 bg-white border border-gray-300 shadow-xl divide-y divide-gray-100 z-50 rounded-none">

            <div class="px-4 py-2.5 bg-gray-50">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Akaunti yangu</p>
                <p class="text-xs font-medium text-gray-900 truncate mt-0.5">{{ auth()->user()->email }}</p>
            </div>

            <div class="p-1 font-medium text-xs text-gray-700">
                <a href="/profile" wire:navigate class="block px-3 py-2 hover:bg-gray-100 hover:text-red-600">Maelezo ya kibinafsi</a>
                <a href="/profile/password" wire:navigate class="block px-3 py-2 hover:bg-gray-100 hover:text-red-600">Badilisha neno la siri</a>
                <a href="/profile/purchases" wire:navigate class="block px-3 py-2 hover:bg-gray-100 hover:text-red-600">Uliyonunua</a>
            </div>

            <div class="p-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left font-bold text-xs px-3 py-2 text-red-600 hover:bg-red-50 focus:outline-none">
                        Toka
                    </button>
                </form>
            </div>
        </div>
        @endauth
    </div>
</div>