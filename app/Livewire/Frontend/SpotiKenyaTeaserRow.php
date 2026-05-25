<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class SpotiKenyaTeaserRow extends Component
{
    // protected $listeners = [
    //     'echo:news,article.published' => '$refresh',
    // ];

    /**
     * Look-up and memory reference category layout settings context
     */
    #[Computed]
    public function category(): ?Category
    {
        return Category::where('slug', 'spoti-kenya')
            ->where('is_active', true)
            ->first();
    }

    /**
     * Query optimization processor pulling and grouping feed rows in 1 step
     */
    #[Computed]
    public function dynamicLayoutColumns(): array
    {
        if (!$this->category) {
            return ['hero' => null, 'thumbnails' => collect(), 'textOnly' => collect()];
        }

        // Single query pass using covered index layout bounds
        $stream = Article::publishedStream($this->category->id)->take(15)->get();

        return [
            'hero'       => $stream->firstWhere('display_layout', 'large-featured'),
            'thumbnails' => $stream->where('display_layout', 'thumbnail-right')->take(4),
            'textOnly'   => $stream->where('display_layout', 'text-only')->take(5),
        ];
    }

    public function render(): View
    {
        return view('livewire.frontend.spoti-kenya-teaser-row');
    }
}