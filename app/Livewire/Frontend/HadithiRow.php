<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class HadithiRow extends Component
{

// protected $listeners = [
//         'echo:news,article.published' => '$refresh',
//     ];

    /**
     * Resolves and caches the parent model in a single database pass
     */
    #[Computed]
    public function category(): ?Category
    {
        return Category::where('slug', 'hadithi')->where('is_active', true)->first();
    }

    /**
     * Evaluates column assignment arrays using an optimized, zero-DB collection scan.
     */
    #[Computed]
    public function columnLayouts(): array
    {
        if (!$this->category) {
            return ['large' => null, 'thumbnails' => collect(), 'textOnly' => collect()];
        }

        // Single query pass using the custom covered database index
        $stream = Article::publishedStream($this->category->id)->take(15)->get();

        return [
            'large'    => $stream->firstWhere('display_style', 'large'),
            'thumbnails' => $stream->where('display_style', 'thumbnail-left')->take(4),
            'textOnly'   => $stream->where('display_style', 'text-only')->take(6),
        ];
    }

    public function render(): View
    {
        return view('livewire.frontend.hadithi-row');
    }
}