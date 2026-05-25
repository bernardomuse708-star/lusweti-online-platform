<?php

namespace App\Livewire\Frontend;

use App\Models\VideoCategory;
use App\Models\Video;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class VideoTeaserRow extends Component
{
    // protected $listeners = [
    //     'echo:news,article.published' => '$refresh',
    // ];

    /**
     * Resolve the container structural layout context configuration mapping
     */
    #[Computed]
    public function category(): ?VideoCategory
    {
        return VideoCategory::where('slug', 'video')
            ->where('is_active', true)
            ->first();
    }

    /**
     * Compute exactly 4 structural elements using the covered composite index
     */
    #[Computed]
    public function collectionItems(): Collection
    {
        if (!$this->category) {
            return collect();
        }

        return Video::publishedFeed($this->category->id)
            ->take(4)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.frontend.video-teaser-row');
    }
}