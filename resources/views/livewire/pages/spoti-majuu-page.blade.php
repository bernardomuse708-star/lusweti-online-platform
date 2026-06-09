<div>

    <div class="w-full bg-white font-sans antialiased min-h-screen pb-16">

        {{-- Main Top Ad Unit --}}
        <div class="mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <div class="hidden sm:flex items-center justify-center h-24 bg-gray-50 border border-gray-200 text-gray-400 text-xs font-mono uppercase tracking-wider">
                Advertisement
            </div>
        </div>

        {{-- Page Structural Header --}}
        <div class="mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="border-b-4 border-black pb-2">
                <h1 class="text-3xl font-black uppercase tracking-tight text-gray-900">
                    {{ $this->category->name }}
                </h1>
            </div>
        </div>

        {{-- SECTION 1: Spoti Majuu Base Feed --}}
        <section class="mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="border-b-2 border-gray-900 pb-1 mb-6">
                <span class="bg-black text-white text-xs font-bold uppercase tracking-widest px-3 py-1">Majuu Updates</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($this->spotiMajuuArticles as $article)
                <div class="border-b border-gray-100 pb-4 md:border-b-0 md:pb-0">
                    @if($article->getFirstMediaUrl('featured_image'))
                    <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-3">
                        <img src="{{ $article->getFirstMediaUrl('featured_image') }}" class="w-full h-full object-cover" alt="">
                    </div>
                    @endif
                    <h3 class="font-bold text-base text-gray-900 hover:text-red-600">
                        <a href="/ms/{{ $this->category->slug }}/{{ $article->slug }}" wire:navigate>{{ $article->title }}</a>
                    </h3>
                    <p class="text-xs text-gray-600 mt-2 line-clamp-2">{{ $article->summary }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- SECTION 2: Spoti Kenya (Layout Partial Mapping) --}}
        <section class="mx-auto px-4 sm:px-6 lg:px-8 mt-12">
            @include('partials.spoti-majuu.spotiKenya', ['articles' => $this->spotiKenyaArticles])
        </section>

        {{-- SECTION 3: Picha Gallery Row --}}
        <section class="mx-auto px-4 sm:px-6 lg:px-8 mt-12">
            @include('partials.spoti-majuu.picha', ['galleries' => $this->pichaGalleries])
        </section>

        {{-- SECTION 4: Burudani Feed --}}
        <section class="mx-auto px-4 sm:px-6 lg:px-8 mt-12">
            @include('partials.spoti-majuu.burudani', ['news' => $this->burudaniNews])
        </section>

    </div>

</div>