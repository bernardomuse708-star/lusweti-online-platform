<?php

namespace App\Livewire\Frontend;

use App\Models\Category;
use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class SpotiMajuuTeaserRow extends Component
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
        return Category::where('slug', 'spoti-majuu')
            ->where('is_active', true)
            ->first();
    }

    /**
     * Single covered query index scanner parsing arrays into memory structures 
     */
    #[Computed]
    public function columnLayouts(): array
    {
        if (!$this->category) {
            return ['featured' => null, 'thumbnails' => collect(), 'textOnly' => collect()];
        }

        // Single data retrieval stream utilizing covered indexes (eliminates N+1 vulnerabilities)
        $stream = Article::publishedStream($this->category->id)->take(15)->get();

        return [
            'featured'   => $stream->firstWhere('layout_style', 'featured-large'),
            'thumbnails' => $stream->where('layout_style', 'thumbnail-right')->take(4),
            'textOnly'   => $stream->where('layout_style', 'text-only')->take(5),
        ];
    }

    public function render(): View
    {
        return view('livewire.frontend.spoti-majuu-teaser-row');
    }
}