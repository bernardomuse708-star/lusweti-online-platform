<?php

namespace App\Livewire\Frontend;

use App\Events\StreamChatMessageSent;
use App\Models\Message;
use App\Models\Stream;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Chat extends Component
{
    public string $room;

    public string $message = '';

    public array $messages = [];

    public ?int $streamId = null;

    public function mount($room)
    {
        $this->room = $room;

        $query = Stream::where('livekit_room', $room);

        if (preg_match('/^[0-9a-f\-]{36}$/i', $room)) {
            $query->orWhere('uuid', $room);
        }

        $stream = $query->first();

        if ($stream) {

            $this->streamId = $stream->id;

            $this->loadMessages();
        }
    }

    public function getListeners()
    {
        return [
            "echo:stream-chat.{$this->room},message.sent" => 'messageReceived',
        ];
    }

    public function loadMessages()
    {
        if (!$this->streamId) {
            return;
        }

        $dbMessages = Message::with('user')
            ->where('stream_id', $this->streamId)
            ->latest()
            ->take(100)
            ->get()
            ->reverse();

        $this->messages = $dbMessages
            ->map(fn($msg) => [
                'user' => $msg->user?->name ?? 'Guest',
                'text' => $msg->body,
                'time' => $msg->created_at->format('H:i'),
            ])
            ->values()
            ->toArray();
    }

    public function sendMessage()
    {
        if (!trim($this->message)) {
            return;
        }

        $user = Auth::user();

        if (!$user || !$this->streamId) {
            return;
        }

        $msg = Message::create([
            'stream_id' => $this->streamId,
            'user_id' => $user->id,
            'body' => $this->message,
        ]);

        $payload = [
            'user' => $user->name,
            'text' => $msg->body,
            'time' => now()->format('H:i'),
        ];

        broadcast(new StreamChatMessageSent(
            $payload,
            $this->room
        ))->toOthers();

        $this->messages[] = $payload;

        $this->message = '';

        $this->dispatch('chat-message-added');
    }

    public function messageReceived($event)
    {
        $this->messages[] = $event['message'];

        $this->dispatch('chat-message-added');
    }

    public function render()
    {
        return view('livewire.frontend.chat');
    }
}