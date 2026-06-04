<div class="flex items-center gap-4">
    <button @click="mobileMenuOpen = !mobileMenuOpen"
        class="flex items-center gap-1.5 py-2 text-gray-900 hover:text-red-600 transition-colors focus:outline-none"
        aria-expanded="false">
        
        <div class="w-5 h-5 flex flex-col justify-center gap-1">
            <span class="h-0.5 w-5 bg-current transform transition duration-200" :class="mobileMenuOpen ? 'rotate-45 translate-y-1.5' : ''"></span>
            <span class="h-0.5 w-5 bg-current transition duration-150" :class="mobileMenuOpen ? 'opacity-0' : ''"></span>
            <span class="h-0.5 w-5 bg-current transform transition duration-200" :class="mobileMenuOpen ? '-rotate-45 -translate-y-1.5' : ''"></span>
        </div>

        {{--         <span class="text-xs font-bold uppercase tracking-wider hidden sm:inline">Menu</span>
 --}}
        
    </button>

    <div class="h-4 w-[1px] bg-gray-200 hidden sm:block"></div>

    <a href="https://mwanaclick.com?utm_source=direct&utm_medium=service%20link" target="_blank" rel="noopener" class="hidden sm:inline-block text-xs font-bold uppercase tracking-wider text-gray-600 hover:text-red-600 transition-colors">
        ePaper
    </a>
</div>