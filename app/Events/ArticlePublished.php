<?php

namespace App\Events;

use App\Models\Article;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticlePublished implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Inject the updated article context.
     */
    public function __construct(public Article $article) {}

    /**
     * Broadcast to a public channel accessible by global visitors.
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('magazine-stream'),
        ];
    }

    /**
     * Broadcast naming standard alignment.
     */
    public function broadcastAs(): string
    {
        return 'article.mutated';
    }
}