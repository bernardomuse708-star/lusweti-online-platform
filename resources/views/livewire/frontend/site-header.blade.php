<div>
    <div>
    <header x-data="{ mobileMenuOpen: false, accountMenuOpen: false }" class="sticky top-0 z-50 w-full bg-white font-sans shadow-sm">

        {{-- News Update Banner (Top) --}}
        @include('partials.site-header.news-update', ['showDemo' => false])

        {{-- 1. BREAKING NEWS TICKER --}}
        <livewire:frontend.breaking-news />

        {{-- 2. FEATURED BREAKING NEWS (Only on Desktop) 
        <!-- @include('partials.site-header.featured-breaking-news', ['showDemo' => false]) -->--}}

        {{-- Main Navigation Bar --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-40 bg-white">
            <div class="flex h-16 sm:h-20 items-center justify-between">
                {{-- Left Section: Mobile Menu Toggle & ePaper --}}
                @include('partials.site-header.mobile-menu-toggle-epaper', ['showDemo' => false])
                {{-- Center Section: Logo --}}
                @include('partials.site-header.center-logo', ['showDemo' => false])
                {{-- Right Section: Search & Account --}}
                @include('partials.site-header.login_search_buttons', ['showDemo' => false])

            </div>
        </div>

        {{-- Sub Navigation (Categories Carousel) --}}
        @include('partials.site-header.site-header-sub-navbar', ['showDemo' => false])


        {{-- Mega Menu (Dropdown) --}}
        @include('partials.site-header.mega-menu-dropdown', ['showDemo' => false])



    </header>
    </div>

</div>