<?php

namespace App\Livewire\MagazineLayout;

use App\Models\Article;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;


class MagazineHome extends Component
{
    use WithPagination;

    /**
     * Listen to the broadcast channel.
     * Triggers dynamic re-rendering of properties instantly.
     */
    #[On('echo:magazine-stream,.article.mutated')]
    public function refreshStream(): void
    {
        // Forces Livewire to run a secure differential DOM update 
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        // Performance guard: Limit collection pull to the maximum display capability threshold
        $allArticles = Article::with('category')
            ->published()
            // ->is_visible()
            ->take(25)
            ->get();

        $featuredLargeLeft = $allArticles->where('layout_type', 'teaser-image-large')->take(2);
        $textTeasers = $allArticles->where('layout_type', 'teaser-image-none')->take(1);
        $rightThumbnails = $allArticles->where('layout_type', 'teaser-image-right')->take(2);
        $inlineTextTeaser = $allArticles->where('layout_type', 'teaser-text')->take(1);

        $excludedIds = $featuredLargeLeft->pluck('id')
            ->merge($textTeasers->pluck('id'))
            ->merge($rightThumbnails->pluck('id'))
            ->merge($inlineTextTeaser->pluck('id'))
            ->unique();

        return view('livewire.magazine-layout.magazine-home', [
            'featuredLargeLeft' => $featuredLargeLeft,
            'textTeasers'       => $textTeasers,
            'rightThumbnails'   => $rightThumbnails,
            'inlineTextTeaser'  => $inlineTextTeaser,
            'latestFeed'        => $allArticles->sortByDesc('published_at')->take(3),
            'relatedArticles'   => $allArticles->whereNotIn('id', $excludedIds)->take(4),
            'activeVideo'       => Video::where('is_active', true)->first(),
        ]);
    }
}