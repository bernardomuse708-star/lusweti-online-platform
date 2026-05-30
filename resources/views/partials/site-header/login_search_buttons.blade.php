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
