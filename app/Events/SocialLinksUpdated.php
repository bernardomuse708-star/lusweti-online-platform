<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // 🚀 Use this, NOT ShouldBroadcastNow
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Support\Facades\Cache;

class SocialLinksUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct()
    {
        // Clear the cache immediately on the backend server right when the event fires
        Cache::forget('global_footer_socials_v4');
    }

    /**
     * The broadcast channel Reverb will send this message over.
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('footer'),
        ];
    }

    /**
     * The specific event name your frontend JavaScript/Livewire will listen for.
     */
    public function broadcastAs(): string
    {
        return 'socials.updated';
    }
}