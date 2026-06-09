<?php

// namespace App\Middlewares; // Update to your correct namespace if different
namespace App\Livewire\MagazineLayout;

use App\Models\Article;
use App\Models\Category;
use App\Models\Video;
use App\Models\PageSection;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;

class MagazineHome extends Component
{
    use WithPagination;

    // Public properties mapped to $this-> in the Blade template
    public ?PageSection $section = null;
    public ?Category $category = null;
    public array $columnLayouts = [];

    /**
     * Listen to the broadcast channel.
     * Triggers dynamic re-rendering of properties instantly.
     */
    #[On('echo:magazine-stream,.article.mutated')]
    public function refreshStream(): void
    {
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        // 1. Fetch Global Core Feed Data
        $allArticles = Article::with('category')
            ->published()
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

        $latestFeed = $allArticles->sortByDesc('published_at')->take(2);

        $imageItems = $allArticles
            ->whereNotIn('id', $excludedIds)
            ->whereNotNull('featured_image_thumb_url')
            ->take(2);

        $externalItems = $allArticles
            ->whereNotIn('id', $excludedIds)
            ->whereNotNull('external_url')
            ->take(2);

        $relatedArticles = $allArticles
            ->whereNotIn('id', $excludedIds)
            ->take(8);

        // 2. DYNAMIC FIT: Setup Data for your New Category Section
        // Grabs the first category that has articles available
        $featuredCategory = Category::has('articles')->first();

        if ($featuredCategory) {
            $this->category = $featuredCategory;

            // Fetch recent articles belonging explicitly to this category
            $categoryArticles = Article::where('category_id', $featuredCategory->id)
                ->published()
                ->latest('published_at')
                ->take(10)
                ->get();

            // Distribute into your specific columns layout
            $this->columnLayouts = [
                'large'      => $categoryArticles->first(),
                'thumbnails' => $categoryArticles->slice(1, 3),
                'textOnly'   => $categoryArticles->slice(4, 4),
            ];
        } else {
            $this->category = null;
            $this->columnLayouts = ['large' => null, 'thumbnails' => [], 'textOnly' => []];
        }

        return view('livewire.magazine-layout.magazine-home', [
            'featuredLargeLeft' => $featuredLargeLeft,
            'textTeasers'       => $textTeasers,
            'rightThumbnails'   => $rightThumbnails,
            'inlineTextTeaser'  => $inlineTextTeaser,
            'latestFeed'        => $latestFeed,
            'imageItems'        => $imageItems,
            'externalItems'     => $externalItems,
            'relatedArticles'   => $relatedArticles,
            'activeVideo'       => Video::where('is_active', true)->first(),
        ]);
    }
}