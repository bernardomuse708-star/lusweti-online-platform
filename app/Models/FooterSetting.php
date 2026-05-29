<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class FooterSetting extends Model
{
    protected $fillable = [
        'brand_name',
        'brand_short',
        'brand_description',
        'copyright_text',
        'sections_title',
        'information_title',
        'footer_decoration',
    ];




    protected static function booted(): void
    {
        static::saved(fn() => Cache::forget('global_footer_settings_v4'));
        static::deleted(fn() => Cache::forget('global_footer_settings_v4'));
    }
}
