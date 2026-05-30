<?php

namespace App\Livewire\Frontend;

use App\Models\VideoCategory;
use App\Models\Video;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class VideoTeaserRow extends Component
{
    /**
     * Engineer-class realtime listener for video updates.
     * Listens to video broadcasts and re-renders when new videos are published.
     * Broadcasts on 'videos' channel with 'feed.updated' event name.
     */
    #[On('echo:videos,.feed.updated')]
    public function refreshVideos(): void
    {
        $this->dispatch('$refresh');
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