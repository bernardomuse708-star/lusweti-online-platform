<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class PichaTeaserRow extends Component
{
    public ?Category $category = null;

    public Collection $collectionItems;

    public function mount(): void
    {
        $this->category = Category::query()
            ->where('slug', 'picha')
            ->where('is_active', true)
            ->first();

        $this->loadGallaries();
    }

    public function loadGallaries(): void
    {
        if (! $this->category) {
            $this->collectionItems = collect();
            return;
        }

        $this->collectionItems = Gallery::query()
            ->publishedStream($this->category->id)
            ->with('media')
            ->take(4)
            ->get();
    }

    /**
     * PRO STANDARD FIX: 
     * 1. Exact channel name ('galleries')
     * 2. Exact event name with dot prefix to ignore namespace ('.gallery.updated')
     */
    #[On('echo:galleries,.gallery.updated')]
    public function refreshGallery(array $payload): void
    {
        if (
            isset($payload['category_id']) &&
            $payload['category_id'] === $this->category?->id
        ) {
            $this->loadGallaries();
        }
    }

    public function render(): View
    {
        return view('livewire.frontend.picha-teaser-row');
    }
}
