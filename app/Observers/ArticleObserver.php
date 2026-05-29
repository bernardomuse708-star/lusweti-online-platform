<?php

namespace App\Observers;

use App\Models\Article;
use App\Events\ArticlePublished;

class ArticleObserver
{
    /**
     * Handle the Article "saved" event (covers created and updated).
     */
    public function saved(Article $article): void
    {
        // Only broadcast if the article is actually marked as published
        if ($article->published_at && $article->published_at->isPast()) {
            broadcast(new ArticlePublished($article))->toOthers();
        }
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        broadcast(new ArticlePublished($article))->toOthers();
    }
}