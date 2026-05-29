<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;



class DynamicArticleRow extends Component
{
    public string $categorySlug = 'soka';

    public function mount(string $categorySlug = 'soka'): void
    {
        $this->categorySlug = $categorySlug;
    }

    #[Computed]
    public function category(): ?Category
    {
        return Category::query()
            ->where('slug', $this->categorySlug)
            ->where('is_active', true)
            ->first();
    }

    #[Computed]
    public function articles(): Collection
    {
        if (! $this->category()) {
            return collect();
        }

        return Article::publishedStream($this->category()->id)
            ->with('media')
            ->take(4)
            ->get();
    }

    #[On('echo:news,.article.published')]
    public function syncFeed(array $payload): void
    {
        if (
            isset($payload['category_id']) &&
            $this->category() &&
            $payload['category_id'] === $this->category()->id
        ) {
            unset($this->articles);

            $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        return view('livewire.frontend.dynamic-article-row');
    }
}