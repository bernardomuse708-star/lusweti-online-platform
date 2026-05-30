<div class="flex flex-wrap items-center justify-center gap-4">
    @forelse($this->socialLinks as $social)
    <a
        href="{{ $social['url'] }}"
        target="_blank"
        rel="noopener noreferrer"
        wire:key="footer-social-{{ $social['id'] }}"
        class="group flex items-center gap-2.5 rounded-full border border-slate-800 bg-slate-900 px-4 py-2 text-sm font-semibold text-slate-400 transition-all duration-300 hover:border-slate-700 hover:bg-slate-800 hover:text-white {{ $social['color_class'] }}">

        @if(!empty($social['logo_url']))
        <img src="{{ $social['logo_url'] }}"
            alt="{{ $social['name'] }} Logo"
            loading="lazy"
            class="h-5 w-5 object-contain transition-transform duration-300 group-hover:scale-110">
        @endif

        <span class="hidden sm:inline">{{ $social['name'] }}</span>
    </a>
    @empty
    @endforelse
</div>