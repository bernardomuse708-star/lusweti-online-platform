<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SiteHeaderUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct()
    {
        //
    }

    /**
     * The broadcast channel Reverb will send this message over.
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('site-header'),
        ];
    }

    /**
     * The specific event name your frontend JavaScript/Livewire will listen for.
     */
    public function broadcastAs(): string
    {
        return 'header.updated';
    }
}
