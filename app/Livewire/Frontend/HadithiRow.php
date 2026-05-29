<?php

namespace App\Livewire\Frontend;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On; // <-- Import the On attribute
use Livewire\Component;

class HadithiRow extends Component
{
    // Remove the old protected $listeners array entirely.

    #[Computed]
    public function category(): ?Category
    {
        return Category::query()
            ->where('slug', 'hadithi')
            ->where('is_active', true)
            ->first();
    }

    #[Computed]
    public function columnLayouts(): array
    {
        if (!$this->category) {
            return [
                'featured' => null,
                'thumbnails' => collect(),
                'textOnly' => collect(),
            ];
        }

        $stream = Article::query()
            ->where('category_id', $this->category->id)
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(15)
            ->get();

        return [
            'featured' => $stream->firstWhere('display_style', 'large'),

            'thumbnails' => $stream
                ->where('display_style', 'thumbnail-left')
                ->take(4),

            'textOnly' => $stream
                ->where('display_style', 'text-only')
                ->take(6),
        ];
    }

    /**
     * Modern Livewire 3 Event Listener
     * Notice the dot (.) before article.published. This tells Echo not to prepend a namespace.
     */
    #[On('echo:news,.article.published')]
    public function refreshHadithiStream(array $payload): void
    {
        // Only refresh the DOM if the broadcasted article belongs to this specific section.
        if (
            isset($payload['category_id']) && 
            $this->category() && 
            $payload['category_id'] === $this->category()->id
        ) {
            // Bust the computed cache and trigger a DOM diff
            unset($this->columnLayouts);
            $this->dispatch('$refresh');
        }
    }

    public function render(): View
    {
        return view('livewire.frontend.hadithi-row');
    }
}