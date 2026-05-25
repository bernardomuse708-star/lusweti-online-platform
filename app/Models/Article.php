<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'tentacle_id',
        'topic_label',
        'title',
        'slug',
        'summary',
        'content',
        'layout_type',
        'image_path',
        'is_featured_in_row',
        'is_prime',
        'display_style',
        'display_layout',
        'published_at'
    ];

    protected $casts = [
        'is_prime' => 'boolean',
        'is_featured_in_row' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Fixed chronological sorting avoids standard increment index locking hazards
    public function scopePublished(Builder $query): void
    {
        $query->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }


    /**
     * Scope for optimized front-end retrieval
     */
    public function scopePublishedStream(Builder $query, int $categoryId): void
    {
        $query->where('category_id', $categoryId)
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }

    public function scopeStreamByCategory(Builder $query, int $categoryId): void
    {
        $query->where('category_id', $categoryId)
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }

    /**
     * Scope query to pull latest valid streaming feed entries
     */
    public function scopePublishedFeed(Builder $query, int $categoryId): void
    {
        $query->where('category_id', $categoryId)
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }
}
