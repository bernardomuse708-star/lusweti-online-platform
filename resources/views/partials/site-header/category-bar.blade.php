<nav class="border-b border-gray-100  relative z-30">
    <!-- PAGE NAVIGATION BAR -->
    <div class="border-t border-slate-300 bg-gray-100">
        <div class="max-w-7xl mx-auto ">

            <div class="flex items-center gap-6 overflow-x-auto py-3 text-sm font-medium">

                {{-- Pages created in Filament --}}
                @foreach($this->pages as $page)
                <a href="/{{ $page->slug }}"
                    wire:navigate
                    class="whitespace-nowrap text-slate-700 hover:text-black transition">
                    {{ $page->title }}
                </a>
                @endforeach

            </div>

        </div>
    </div>
</nav>