<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Article;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CategoryTeaserRow extends Component
{
    public string $categorySlug;

    // protected $listeners = [
    //     'echo:news,article.published' => '$refresh',
    // ];


    // Cache properties directly into memory per render cycle to eliminate N+1 vulnerabilities
    public function getCategoryProperty(): ?Category
    {
        return Category::where('slug', $this->categorySlug)
            ->where('is_active', true)
            ->first();
    }

    public function getFeaturedArticleProperty(): ?Article
    {
        if (!$this->category) return null;

        return Article::published()
            ->where('category_id', $this->category->id)
            ->where('is_featured_in_row', true)
            ->first();
    }

    public function getSideArticlesProperty()
    {
        if (!$this->category) return collect();

        $featuredId = $this->featuredArticle?->id;

        return Article::published()
            ->where('category_id', $this->category->id)
            ->when($featuredId, fn($query) => $query->where('id', '!=', $featuredId))
            ->take(4)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.frontend.category-teaser-row');
    }
}