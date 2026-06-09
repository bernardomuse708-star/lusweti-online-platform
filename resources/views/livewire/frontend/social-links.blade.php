<div class="flex flex-wrap items-center justify-center gap-2.5">
    @forelse($this->socialLinks as $social)
    <a href="{{ $social['url'] }}"
       target="_blank"
       rel="noopener noreferrer"
       wire:key="footer-social-{{ $social['id'] }}"
       class="group flex items-center gap-2 bg-neutral-900 border border-neutral-800 px-3 py-2 text-xs font-extrabold uppercase tracking-wider text-neutral-400 rounded-none transition-none hover:bg-neutral-800 hover:text-white hover:border-neutral-600 focus:outline-none focus:ring-1 focus:ring-white">

        @if(!empty($social['logo_url']))
        <img src="{{ $social['logo_url'] }}"
             alt="{{ $social['name'] }} Logo"
             loading="lazy"
             class="h-4 w-4 object-contain grayscale brightness-200 opacity-70 group-hover:opacity-100 transition-none">
        @endif

        <span class="hidden sm:inline tracking-widest">{{ $social['name'] }}</span>
    </a>
    @empty
    @endforelse
</div>