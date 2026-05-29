<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StreamChatMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $message;
    public string $room;

    public function __construct(array $message, string $room)
    {
        $this->message = $message;
        $this->room = $room;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('stream-chat.' . $this->room),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }
}