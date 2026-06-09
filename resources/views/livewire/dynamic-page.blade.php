<div class="min-h-screen bg-white mx-auto max-w-7xl">

    {{-- HERO --}}
    @if($page->hero_title)
        <section class="relative bg-gray-900 text-white py-20 px-6">

            @if($page->hero_image)
                <div class="absolute inset-0 opacity-40">
                    <img src="{{ $page->hero_image }}"
                         class="w-full h-full object-cover">
                </div>
            @endif

            <div class="relative max-w-5xl mx-auto text-center">

                <h1 class="text-4xl font-bold">
                    {{ $page->hero_title }}
                </h1>

                <p class="mt-4 text-lg text-gray-200">
                    {{ $page->hero_subtitle }}
                </p>

                @if($page->hero_button_text)
                    <a href="{{ $page->hero_button_url }}"
                       class="mt-6 inline-block bg-red-600 px-6 py-3 rounded-lg">
                        {{ $page->hero_button_text }}
                    </a>
                @endif

            </div>
        </section>
    @endif


    {{-- PAGE SECTIONS --}}
    <div class="space-y-10 py-10">

        @foreach($page->visibleSections as $section)

            <section
                id="section-{{ $section->id }}"
                wire:key="page-section-{{ $section->id }}"
            >

                <livewire:is
                    :component="$section->sectionType->livewire_component"
                    :section="$section"
                    :key="'dynamic-section-'.$section->id"
                />

            </section>

        @endforeach

    </div>

</div>