<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class FooterMetaLink extends Model
{
    use HasFactory;

    protected $fillable = ['system_key', 'title', 'url', 'open_in_new_tab', 'sort_weight', 'is_active'];

    protected $casts = [
        'open_in_new_tab' => 'boolean',
        'is_active' => 'boolean',
        'sort_weight' => 'integer',
    ];

    public function scopeActiveFeed(Builder $query): void
    {
        $query->where('is_active', true)
            ->orderBy('sort_weight')
            ->orderBy('id');
    }



    protected static function booted(): void
    {
        static::saved(fn() => Cache::forget('global_footer_metalinks_v4'));
        static::deleted(fn() => Cache::forget('global_footer_metalinks_v4'));
    }
}
