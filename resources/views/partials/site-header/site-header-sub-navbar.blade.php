<div>
    <nav class="border-b border-gray-100  relative z-30">
        <!-- CATEGORY BAR -->
        <div class="border-t border-slate-300 bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex items-center gap-6 overflow-x-auto py-3 text-sm font-medium">

                    @foreach($this->categories as $category)
                    <a href="/ms/{{ $category->slug }}"
                        wire:navigate
                        class="whitespace-nowrap text-slate-700 hover:text-black transition">
                        {{ $category->name }}
                    </a>
                    @endforeach

                </div>

            </div>
        </div>
    </nav>
</div>