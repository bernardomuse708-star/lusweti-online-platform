<?php

namespace App\Observers;

use App\Models\Video;
use App\Events\VideoFeedUpdated;

class VideoObserver
{
    /**
     * Handle the Video "saved" event.
     * (Fired on both Create and Update)
     */
    public function saved(Video $video): void
    {
        // Only trigger a frontend refresh if the video is actually meant to be visible
        if ($video->is_visible && $video->published_at <= now()) {
            VideoFeedUpdated::dispatch();
        }
    }

    /**
     * Handle the Video "deleted" event.
     */
    public function deleted(Video $video): void
    {
        VideoFeedUpdated::dispatch();
    }
    
    /**
     * Handle the Video "restored" event.
     */
    public function restored(Video $video): void
    {
        if ($video->is_visible) {
            VideoFeedUpdated::dispatch();
        }
    }
}