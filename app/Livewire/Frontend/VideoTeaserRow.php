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
    /**
     * Listen to the Reverb WebSocket channel for our custom unified event
     */
    protected function getListeners()
    {
        return [
            // Notice the dot (.) before the event name. 
            // This is required when using a custom broadcastAs() name in Laravel Echo.
            "echo:videos,.feed.updated" => '$refresh',
        ];
    }

    #[Computed]
    public function category(): ?VideoCategory
    {
        return VideoCategory::where('slug', 'video')
            ->where('is_active', true)
            ->first();
    }

    #[Computed]
    public function collectionItems(): Collection
    {
        if (!$this->category) {
            return collect();
        }

        return Video::publishedFeed($this->category->id)
            ->with('media')
            ->take(4)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.frontend.video-teaser-row');
    }
}