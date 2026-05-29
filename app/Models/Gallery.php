<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Spatie\Image\Enums\Fit;

class Gallery extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'tentacle_id',
        'title',
        'slug',
        'published_at',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'published_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | MEDIA COLLECTIONS
    |--------------------------------------------------------------------------
    */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile()
            ->useFallbackUrl('/assets/fallbacks/gallery-cover.jpg');
    }

    /*
    |--------------------------------------------------------------------------
    | MEDIA CONVERSIONS
    |--------------------------------------------------------------------------
    */

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('optimized')
            ->fit(Fit::Crop, 1200, 800)
            ->format('webp')
            ->quality(85)
            ->nonQueued();
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getImagePathAttribute(): ?string
    {
        return $this->getFirstMediaUrl('cover', 'optimized')
            ?: asset('/assets/fallbacks/gallery-cover.jpg');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopePublishedStream(Builder $query, int $categoryId): void
    {
        $query
            ->where('category_id', $categoryId)
            ->where('is_visible', true)
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->latest('id');
    }

    protected static function booted(): void
    {
        
    }
}
