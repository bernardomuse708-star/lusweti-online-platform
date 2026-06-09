{{-- resources/views/livewire/pages/search-page.blade.php --}}
<div class="min-h-screen bg-white py-6 px-4 sm:px-6 lg:px-8 border-t border-gray-200">
    <div class="mx-auto">
        
        {{-- Headline Search Tracker --}}
        <div class="border-b border-gray-900 pb-4 mb-8">
            <p class="text-[10px] font-bold text-red-600 uppercase tracking-widest">Tafuta Tovutini</p>
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-950 mt-1">Search Results</h1>
            
            <div class="mt-4 max-w-xl">
                <div class="relative">
                    <input 
                        wire:model.live.debounce.300ms="search"
                        type="text" 
                        placeholder="Type keywords here..." 
                        class="w-full bg-gray-100 text-gray-900 placeholder-gray-500 text-sm font-medium px-4 py-3 border border-transparent focus:border-gray-900 focus:bg-white focus:ring-0 transition-colors duration-150 outline-none rounded-none"
                    >
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400" wire:loading.delay>
                        {{-- Clean Minimalist Spinner --}}
                        <svg class="animate-spin h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Results Metrics --}}
        @if(!blank($search))
            <p class="text-xs text-gray-500 mb-6 uppercase font-bold tracking-wider">
                Alipata matokeo {{ $results->total() }} kwa ajili ya "{{ $search }}"
            </p>
        @endif

        {{-- Sharp Grid Component --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($results as $article)
                <article class="border border-gray-200 p-4 flex flex-col justify-between transition-all hover:border-gray-400 bg-white">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[10px] font-bold text-red-600 uppercase tracking-wider">
                                {{ $article->category->name ?? 'News' }}
                            </span>
                            <span class="text-[10px] text-gray-400 font-medium">
                                {{ $article->created_at->format('M d, Y') }}
                            </span>
                        </div>
                        
                        <a href="/ms/{{ $article->category->slug ?? 'news' }}/{{ $article->slug }}" wire:navigate class="group">
                            <h3 class="text-base font-bold text-gray-900 group-hover:text-red-600 transition-colors line-clamp-2 leading-tight">
                                {{ $article->title }}
                            </h3>
                        </a>
                        
                        <p class="text-xs text-gray-600 mt-2 line-clamp-3 leading-relaxed">
                            {{ $article->summary ?? Str::limit(strip_tags($article->content), 120) }}
                        </p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                        <a href="/ms/{{ $article->category->slug ?? 'news' }}/{{ $article->slug }}" wire:navigate class="text-[10px] font-bold uppercase tracking-wider text-gray-900 hover:text-red-600 transition-colors">
                            Soma Zaidi &rarr;
                        </a>
                        @if(isset($article->relevance))
                            <span class="text-[9px] font-mono bg-gray-100 text-gray-500 px-1.5 py-0.5">
                                Match score: {{ round($article->relevance, 2) }}
                            </span>
                        @endif
                    </div>
                </article>
            @empty
                <div class="col-span-full py-12 text-center border border-dashed border-gray-300">
                    <p class="text-sm text-gray-500 font-medium">Hakuna makala yaliyopatikana yanayolingana na utafutaji wako.</p>
                </div>
            @endforelse
        </div>

        {{-- Clean Pagination Execution --}}
        <div class="mt-12 sharp-pagination">
            {{ $results->links() }}
        </div>

    </div>
</div>