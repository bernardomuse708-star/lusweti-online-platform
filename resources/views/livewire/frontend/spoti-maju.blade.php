@props(['section'])

<section class="6xl mx-auto px-6 py-10 bg-gray-50">

    <h2 class="text-2xl font-bold mb-6">
        {{ $section->title }}
    </h2>

    @php
        $articles = \App\Models\Article::publishedStream($section->category_id ?? 0)
            ->limit(8)
            ->get();
    @endphp

    <div class="grid md:grid-cols-2 gap-6">

        @foreach($articles as $article)

            <div class="bg-white p-4 shadow rounded-lg">

                <h3 class="font-semibold text-lg">
                    {{ $article->title }}
                </h3>

                <p class="text-sm text-gray-600 mt-2">
                    {{ $article->summary }}
                </p>

                <span class="text-xs text-gray-400 block mt-2">
                    {{ optional($article->published_at)->diffForHumans() }}
                </span>

            </div>

        @endforeach

    </div>

</section>