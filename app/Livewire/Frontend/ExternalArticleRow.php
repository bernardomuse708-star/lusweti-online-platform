<?php

namespace App\Livewire\Frontend;

use App\Models\Article;
use App\Models\Category;

use Livewire\Component;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class ExternalArticleRow extends Component
{
    public string $categorySlug = 'soka';

    #[Computed]
    public function category(): ?Category
    {
        return Category::query()
            ->where('slug', $this->categorySlug)
            ->where('is_active', true)
            ->first();
    }

    #[Computed]
    public function collectionItems(): Collection
    {
        if (! $this->category()) {
            return collect();
        }

        return Article::publishedFeed($this->category()->id)
            ->whereNotNull('external_url')
            ->where('external_url', '!=', '')
            ->with('media')
            ->take(4)
            ->get();
    }

    #[On('echo:news,.article.published')]
    public function refreshFeed(array $payload): void
    {
        if (
            isset($payload['category_id']) &&
            $this->category() &&
            $payload['category_id'] === $this->category()->id
        ) {
            unset($this->collectionItems);

            $this->dispatch('$refresh');
        }
    }

    public function render(): View
    {
        return view('livewire.frontend.external-article-row');
    }
}