<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Article;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;


 #[Layout('layout.app')]

class CategoryPage extends Component
{
    // The route automatically passes the Category model here
    public Category $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Replicating your Teaser logic so the Blade view has the exact
     * layout buckets it needs to render the 3-column grid.
     */
    public function getColumnLayoutsProperty(): array
    {
        // 1. Get the lead article (fallback to latest if no featured is set)
        $large = Article::published()
            ->where('category_id', $this->category->id)
            ->where('is_featured_in_row', true)
            ->with('media')
            ->first();

        if (!$large) {
            $large = Article::published()
                ->where('category_id', $this->category->id)
                ->with('media')
                ->latest()
                ->first();
        }

        // 2. Get the next 4 articles for the side columns
        $sideArticles = collect();
        if ($large) {
            $sideArticles = Article::published()
                ->where('category_id', $this->category->id)
                ->where('id', '!=', $large->id)
                ->with('media')
                ->latest()
                ->take(4)
                ->get();
        }

        // 3. Bucket them exactly how your Blade file expects
        return [
            'large'      => $large,
            'thumbnails' => $sideArticles->take(2),                   // Middle column
            'textOnly'   => $sideArticles->skip(2)->values(),         // Right column
        ];
    }

    public function render(): View
    {
        return view('livewire.frontend.category-page');
    }
}