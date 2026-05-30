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