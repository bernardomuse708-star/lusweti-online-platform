<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class KolamuTeaserRow extends Component
{

// protected $listeners = [
//         'echo:news,article.published' => '$refresh',
//     ];

    /**
     * Look-up and memory reference category layout settings context
     */
    #[Computed]
    public function category(): ?Category
    {
        return Category::where('slug', 'kolamu')
            ->where('is_active', true)
            ->first();
    }

    /**
     * Compute and stream structural elements using a covered single scan pass
     */
    #[Computed]
    public function rowLayouts(): array
    {
        if (!$this->category) {
            return ['featured' => null, 'thumbnails' => collect(), 'textOnly' => collect()];
        }

        // Pulls all needed records in exactly 1 clean query pass using our custom compound index
        $stream = Article::publishedFeed($this->category->id)->take(15)->get();

        return [
            'featured'   => $stream->firstWhere('layout_style', 'featured-large'),
            'thumbnails' => $stream->where('layout_style', 'right-thumbnail')->take(4),
            'textOnly'   => $stream->where('layout_style', 'text-only')->take(5),
        ];
    }

    #[On('echo:magazine-stream,.article.mutated')]
    public function refreshKolamu(): void
    {
        unset($this->rowLayouts);
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.frontend.kolamu-teaser-row');
    }
}