<?php


declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;
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

    // Automatically flush the Livewire navigation cache when a category is updated
    protected static function booted(): void
    {
        $flushCache = fn() => Cache::forget('header-navigation-categories');

        static::saved($flushCache);
        static::deleted($flushCache);

        static::saved(fn() => Cache::forget('global_footer_categories_v4'));
        static::deleted(fn() => Cache::forget('global_footer_categories_v4'));
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
