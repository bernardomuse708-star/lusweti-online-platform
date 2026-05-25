<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class MagazineHome extends Component
{
    use WithPagination;

    // protected $listeners = [
    //     'echo:news,article.published' => '$refresh',
    // ];


    public function render(): View
    {
        // Thread-safe dynamic stream isolation without standard offset bugs
        $allArticles = Article::with('category')->published()->get();

        return view('livewire.magazine-home', [
            'featuredLargeLeft' => $allArticles->where('layout_type', 'teaser-image-large')->take(2),
            'textTeasers'       => $allArticles->where('layout_type', 'teaser-image-none')->take(1),
            'rightThumbnails'   => $allArticles->where('layout_type', 'teaser-image-right')->take(2),
            'inlineTextTeaser'  => $allArticles->where('layout_type', 'teaser-text')->take(1),
            'latestFeed'        => $allArticles->sortByDesc('published_at')->take(3),
            'activeVideo'       => Video::where('is_active', true)->first(),
        ]);
    }
}