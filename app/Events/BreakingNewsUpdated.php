<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// MUST implement ShouldBroadcast for Echo/Reverb to pick it up!
class BreakingNewsUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct()
    {
        //
    }

    public function broadcastOn(): array
    {
        // Standardize to hyphens and use the Channel class
        return [
            new Channel('breaking-news')
        ];
    }

    public function broadcastAs(): string
    {
        // This is the event name Echo will listen for
        return 'breaking.updated';
    }
}