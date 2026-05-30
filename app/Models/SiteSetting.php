<?php

namespace App\Models;

use App\Events\SiteHeaderUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SiteSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['key', 'value'];

    public static function getWithCache(string $key, ?string $default = null): ?string
    {
        return Cache::rememberForever("site_setting:{$key}", function () use ($key, $default) {
            return self::where('key', $key)->value('value') ?? $default;
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('site_logo')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('optimized')
            ->width(200)
            ->height(60)
            ->sharpen(10)
            ->nonQueued();
    }

    public function getLogoUrlAttribute(): ?string
    {
        if ($this->hasMedia('site_logo')) {
            return $this->getFirstMediaUrl('site_logo', 'optimized');
        }
        return null;
    }

    protected static function booted(): void
    {
        static::saved(fn (SiteSetting $setting) => Cache::forget("site_setting:{$setting->key}"));
        static::deleted(fn (SiteSetting $setting) => Cache::forget("site_setting:{$setting->key}"));

        static::saved(fn() => SiteHeaderUpdated::dispatch());
        static::deleted(fn() => SiteHeaderUpdated::dispatch());
    }
}
