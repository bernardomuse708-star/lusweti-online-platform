<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit; // Add this

class VideoFeedUpdated implements ShouldBroadcast, ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    /**
     * Implementing ShouldBroadcastAfterCommit ensures this event is only pushed to Reverb
     * AFTER Filament has finished attaching the Spatie Media MP4 file to the database.
     */
    public function broadcastOn(): array
    {
        return [new Channel('videos')];
    }

    /**
     * Define a clean, custom event name for the WebSocket channel
     */
    public function broadcastAs(): string
    {
        return 'feed.updated';
    }
}