<?php

namespace App\Models;

use App\Events\SocialLinksUpdated;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\Cache;

class SocialLink extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'platform_key',
        'url',
        'color_class',
        'is_active',
        'sort_weight',
    ];

    protected static function booted(): void
    {
        static::saved(fn() => Cache::forget('global_footer_socials_v4'));
        static::deleted(fn() => Cache::forget('global_footer_socials_v4'));
        // Whenever a link changes, dispatch our real-time broadcasting event
        static::saved(fn() => SocialLinksUpdated::dispatch());
        static::deleted(fn() => SocialLinksUpdated::dispatch());
    }


    public function registerMediaCollections(): void
    {
        // Enforce a single logo image per social link
        $this->addMediaCollection('logo')
            ->singleFile();
    }
}
