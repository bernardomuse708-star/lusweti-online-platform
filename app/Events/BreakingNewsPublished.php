<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BreakingNewsPublished implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $headline;
    public string $url;

    public function __construct(string $headline, string $url)
    {
        $this->headline = $headline;
        $this->url = $url;
    }

    public function broadcastOn(): array
    {
        // This creates a channel that the Livewire frontend can "listen" to
        return [
            new Channel('public-news'),
        ];
    }
}
