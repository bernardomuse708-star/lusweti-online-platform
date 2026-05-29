<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // 🚀 Use this, NOT ShouldBroadcastNow
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;


class FooterUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function broadcastOn(): array
    {
        return [
            new Channel('footer'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'footer.updated';
    }
}