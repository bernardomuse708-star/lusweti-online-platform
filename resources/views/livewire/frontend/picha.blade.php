@props(['section'])

<section class="6xl mx-auto px-6 py-10">

    <h2 class="text-2xl font-bold mb-6">
        {{ $section->title }}
    </h2>

    @php
        $galleries = \App\Models\Gallery::publishedStream(
            $section->category_id ?? 0
        )
        ->limit(8)
        ->get();
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        @foreach($galleries as $gallery)

            <div class="rounded overflow-hidden shadow">

                <img
                    src="{{ $gallery->image_path }}"
                    class="w-full h-40 object-cover"
                />

                <div class="p-2 text-sm font-medium">
                    {{ $gallery->title }}
                </div>

            </div>

        @endforeach

    </div>

</section>