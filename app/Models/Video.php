<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Broadcasting\Channel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\Fit;

class Video extends Model implements HasMedia
{
    use InteractsWithMedia;
    // REMOVED: use BroadcastsEvents; -> Handled securely by VideoObserver now

    protected $fillable = [
        'video_category_id',
        'title',
        'slug',
        'summary',
        'youtube_id',
        'is_visible',
        'published_at',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Define the channels to broadcast model changes over.
     */
    public function broadcastOn(string $event): array
    {
        return [new Channel('videos')];
    }

    /**
     * Spatie Media Engine Configuration
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('clip_payload')
            ->singleFile()
            ->acceptsMimeTypes(['video/mp4', 'video/webm', 'video/quicktime']);

        $this->addMediaCollection('video_thumbnail')
            ->singleFile()
            ->useFallbackUrl(asset('images/placeholders/video-default.jpg'));
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('optimized')
            ->fit(Fit::Crop, 800, 450)
            ->format('webp')
            ->quality(82)
            ->nonQueued();

        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(225)
            ->sharpen(10)
            ->nonQueued();
    }

    /**
     * Determine if the video source is external YouTube
     */
    public function getIsYoutubeAttribute(): bool
    {
        return !empty($this->youtube_id);
    }

    /**
     * Unified Asset URL Accessor
     */
    public function getVideoUrlAttribute(): ?string
    {
        if ($this->is_youtube) {
            return "https://www.youtube.com/watch?v={$this->youtube_id}";
        }

        return $this->getFirstMediaUrl('clip_payload') ?: null;
    }

    public function getImagePathAttribute(): ?string
    {
        if ($this->hasMedia('video_thumbnail')) {
            return $this->getFirstMediaUrl('video_thumbnail', 'optimized');
        }
        return null;
    }

    public function getImageThumbUrlAttribute(): ?string
    {
        if ($this->hasMedia('video_thumbnail')) {
            return $this->getFirstMediaUrl('video_thumbnail', 'thumb');
        }
        return null;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(VideoCategory::class, 'video_category_id');
    }

    public function scopePublishedFeed(Builder $query, int $categoryId): void
    {
        $query->where('video_category_id', $categoryId)
            ->where('is_visible', true)
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }
}

