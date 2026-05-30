<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stream;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function stream()
    {
        $stream = Stream::latest('id')->first();

        $room = $stream?->livekit_room
            ?: $stream?->uuid
            ?: env('STREAM_CHAT_ROOM', 'default-stream-room');

        return view('stream', [
            'token' => 'YOUR_LIVEKIT_TOKEN',
            'livekitUrl' => env('LIVEKIT_URL'),
            'isHost' => true,
            'room' => $room,
            'stream' => $stream,
        ]);
    }
}
