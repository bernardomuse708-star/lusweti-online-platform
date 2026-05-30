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