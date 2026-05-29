<?php
// app/Events/GalleryStreamUpdated.php

namespace App\Events;

use App\Models\Gallery;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// Changed to ShouldBroadcast (queued) and ShouldDispatchAfterCommit
class GalleryStreamUpdated implements ShouldBroadcast, ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Gallery $gallery
    ) {}

    public function broadcastOn(): array
    {
        return [
            new Channel('galleries'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'gallery.updated';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->gallery->id,
            'category_id' => $this->gallery->category_id,
        ];
    }
}