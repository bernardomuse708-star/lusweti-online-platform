<?php


declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'is_visible_in_footer',
        'sort_weight',
        'is_visible_in_nav',
        'text_color',
        'is_active'
    ];

    protected $casts = [
        'is_visible_in_nav' => 'boolean',
        'is_visible_in_footer' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'sort_weight' => 'integer',
    ];

    protected static function booted(): void
    {
        $flushCache = fn() => Cache::forget('header-navigation-categories');

        static::saved($flushCache);
        static::deleted($flushCache);

        static::saved(fn() => Cache::forget('global_footer_categories_v4'));
        static::deleted(fn() => Cache::forget('global_footer_categories_v4'));
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->useFallbackUrl(asset('images/placeholders/category-default.jpg'));
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(225)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('hero')
            ->width(1200)
            ->height(675)
            ->withResponsiveImages();
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        if ($this->hasMedia('featured_image')) {
            return $this->getFirstMediaUrl('featured_image', 'hero');
        }
        return null;
    }

    public function getFeaturedImageThumbUrlAttribute(): ?string
    {
        if ($this->hasMedia('featured_image')) {
            return $this->getFirstMediaUrl('featured_image', 'thumb');
        }
        return null;
    }

    public function scopeForFooter(Builder $query): void
    {
        $query->where('is_active', true)
            ->where('is_visible_in_footer', true)
            ->orderBy('sort_weight')
            ->orderBy('id');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
}
