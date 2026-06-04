@props(['section'])

<section class="py-10 bg-white">

    <h2 class="text-2xl font-bold mb-6">
        {{ $section->title }}
    </h2>

    <div class="space-y-4">

        @php
            $items = \App\Models\Burudani::query()
                ->when($section->category_id, function ($q) use ($section) {
                    $q->where('topic', $section->category_id);
                })
                ->latest()
                ->limit(6)
                ->get();
        @endphp

        @foreach($items as $item)

            <div class="border-b pb-3">

                <h3 class="font-semibold">
                    {{ $item->title }}
                </h3>

                <p class="text-sm text-gray-600">
                    {{ $item->summary }}
                </p>

                <span class="text-xs text-gray-400">
                    {{ optional($item->published_at)->diffForHumans() }}
                </span>

            </div>

        @endforeach

    </div>

</section>