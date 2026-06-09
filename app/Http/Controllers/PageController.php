<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Stream;

class PageController extends Controller
{
    public function home()
    {
        $page = Page::where('slug', 'nyumbani')->firstOrFail();

        return view('preview.page', compact('page'));
    }

    public function michezo()
    {
        $page = Page::where('slug', 'michezo')->firstOrFail();

        return view('preview.page', compact('page'));
    }

    public function burudani()
    {
        $page = Page::where('slug', 'burudani')->firstOrFail();

        return view('preview.page', compact('page'));
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
