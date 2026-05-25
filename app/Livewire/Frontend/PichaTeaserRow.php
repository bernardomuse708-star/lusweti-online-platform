<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Gallery;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class PichaTeaserRow extends Component
{
   
// protected $listeners = [
//         'echo:news,article.published' => '$refresh',
//     ];
/**
     * Resolve the container layout context structure mapping
     */
    #[Computed]
    public function category(): ?Category
    {
        return Category::where('slug', 'picha')
            ->where('is_active', true)
            ->first();
    }

    /**
     * Compute exactly 4 structural feed items via the covered composite database index
     */
    #[Computed]
    public function collectionItems(): Collection
    {
        if (!$this->category) {
            return collect();
        }

        return Gallery::publishedStream($this->category->id)
            ->take(4)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.frontend.picha-teaser-row');
    }
}