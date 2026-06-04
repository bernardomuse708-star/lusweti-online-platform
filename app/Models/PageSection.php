<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\SectionUpdated;
use App\Services\PageCacheService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'section_type_id',

        'content_source',

        'category_id',

        'title',

        'sort_order',

        'is_visible',

        'settings',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'settings' => 'array',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function sectionType(): BelongsTo
    {
        return $this->belongsTo(
            SectionType::class
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(
            PageSectionItem::class
        )->orderBy('sort_order');
    }


    protected static function booted(): void
    {

    static::saved(function ($page) {
            broadcast(new SectionUpdated($page));
        });

        static::saved(
            fn($section) =>
            PageCacheService::flush($section->page_id)
        );

        static::saved(function ($section) {

            Cache::forget("page:{$section->page_id}");
        });

        static::deleted(function ($section) {

            Cache::forget("page:{$section->page_id}");
        });
    }
}
