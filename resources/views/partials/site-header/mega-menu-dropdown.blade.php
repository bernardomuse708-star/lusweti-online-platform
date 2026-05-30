<div>
<nav x-show="mobileMenuOpen"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    class="absolute left-0 top-full w-full bg-slate-700 border-t border-slate-800 shadow-2xl z-20">

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 block sm:hidden">
            <a href="https://mwanaclick.com" target="_blank" rel="noopener" class="inline-block rounded-lg bg-slate-800 px-4 py-2 text-sm font-bold text-white hover:bg-slate-700">
                Soma ePaper
            </a>
        </div>

        <div class="grid grid-cols-2 gap-x-3 gap-y-2 sm:grid-cols-3 lg:grid-cols-6">
            @foreach($this->categories as $category)
            <a href="/ms/{{ $category->slug }}" wire:navigate class="group flex items-center text-sm font-bold uppercase tracking-wider text-slate-50 hover:text-white transition-colors">
                <span class="border-b-2 border-transparent group-hover:border-red-500 pb-0.5 transition-all">
                    {{ $category->name }}
                </span>
            </a>
            @endforeach
        </div>
    </div>
</nav>
</div>