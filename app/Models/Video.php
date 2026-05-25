<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Video extends Model
{
    protected $fillable = ['title', 'video_category_id',
        'tentacle_id', 'youtube_id', 'is_active','youtube_id',
        'published_at',
        'is_visible', 'slug',];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at'=>'datetime',
        'is_visible'=>'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(VideoCategory::class, 'video_category_id');
    }

    /**
     * Scope streaming with atomic ordering protection
     */
    public function scopePublishedFeed(Builder $query, int $categoryId): void
    {
        $query->where('video_category_id', $categoryId)
            ->where('is_visible', true)
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }
}
