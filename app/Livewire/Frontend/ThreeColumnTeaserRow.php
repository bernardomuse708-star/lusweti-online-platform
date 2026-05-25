<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class ThreeColumnTeaserRow extends Component
{
    public string $categorySlug;
    // protected $listeners = [
    //     'echo:news,article.published' => '$refresh',
    // ];


    /**
     * Resolve layout details using a clean, single-pass database scan
     */
    #[Computed]
    public function category(): ?Category
    {
        return Category::where('slug', $this->categorySlug)
            ->where('is_active', true)
            ->first();
    }

    /**
     * Fetches exactly 3 structural rows using the covered compound database index
     */
    #[Computed]
    public function gridArticles(): Collection
    {
        if (!$this->category) {
            return collect();
        }

        return Article::streamByCategory($this->category->id)
            ->take(3)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.frontend.three-column-teaser-row');
    }
}