<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * Idempotent cache retrieval helper.
     */
    public static function getWithCache(string $key, ?string $default = null): ?string
    {
        return Cache::rememberForever("site_setting:{$key}", function () use ($key, $default) {
            return self::where('key', $key)->value('value') ?? $default;
        });
    }

    protected static function booted(): void
    {
        // Automatically flush specific cache keys when modified via Filament/Console
        static::saved(fn (SiteSetting $setting) => Cache::forget("site_setting:{$setting->key}"));
        static::deleted(fn (SiteSetting $setting) => Cache::forget("site_setting:{$setting->key}"));
    }
}
