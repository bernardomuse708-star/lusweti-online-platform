<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Article;
use App\Models\PageSection;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class ThreeColumnTeaserRow extends Component
{
    public ?string $categorySlug = null;
    public ?PageSection $section = null;

    public function mount(): void
    {
        // If section is provided, extract categorySlug from it
        if ($this->section && $this->section->category) {
            $this->categorySlug = $this->section->category->slug;
        }
    }

    /**
     * Resolve layout details using a clean, single-pass database scan
     */
    #[Computed(cache: true)]
    public function category(): ?Category
    {
        if (!$this->categorySlug) return null;

        return Category::where('slug', $this->categorySlug)
            ->where('is_active', true)
            ->with('media')
            ->first();
    }

    /**
     * Fetches exactly 3 structural rows using the covered compound database index
     */
    #[Computed(cache: true)]
    public function gridArticles(): Collection
    {
        if (!$this->category) {
            return collect();
        }

        return Article::publishedFeed($this->category->id)
            ->with('media')
            ->take(3)
            ->get();
    }

    #[On('echo:magazine-stream,.article.mutated')]
    public function refreshThreeColumn(): void
    {
        unset($this->gridArticles);
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.frontend.three-column-teaser-row');
    }
}