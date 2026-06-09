{{-- master-header.blade.php --}}
<div>
    <header x-data="{ mobileMenuOpen: false, accountMenuOpen: false }" class="sticky top-0 z-50 w-full bg-white font-sans border-b border-gray-200">

        {{-- News Update Banner / Top Marquee 
        @include('partials.site-header.news-update', ['showDemo' => false])--}}        

        {{-- Main Navigation Bar (BBC Content Grid) --}}
        <div class="max-w-7xl mx-auto  relative z-40 bg-white">
            <div class="flex h-14 sm:h-16 items-center justify-between border-b border-gray-100">

                {{-- Left Section: Mobile Toggle & ePaper --}}
                <div class="flex items-center gap-4 flex-1">
                    @include('partials.site-header.mobile-menu-toggle-epaper', ['showDemo' => false])
                </div>

                {{-- Center Section: Distinct Clean Logo --}}
                <div class="flex justify-center flex-shrink-0 px-4">
                    @include('partials.site-header.center-logo', ['showDemo' => false])
                </div>

                {{-- Right Section: Account, Subscribe & Search Controls --}}
                <div class="flex items-center justify-end flex-1">
                    @include('partials.site-header.login_search_buttons', ['showDemo' => false])
                </div>

            </div>
        </div>       

        {{-- Main Category Bar (BBC Sharp Box Layout) --}}
        @include('partials.site-header.category-bar', ['showDemo' => false])


        {{-- Breaking News Ticker --}}
        <livewire:frontend.breaking-news />

    </header>
</div>