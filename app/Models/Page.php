<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\PageUpdated;
use App\Services\PageCacheService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',

        'hero_title',
        'hero_subtitle',
        'hero_image',

        'hero_button_text',
        'hero_button_url',

        'seo_title',
        'seo_description',

        'status',
        'published_at',

        'is_visible_in_nav',
        'sort_order',

        'preview_token',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_visible_in_nav' => 'boolean',
        'sort_order' => 'integer',
    ];

    // public function sections(): HasMany
    // {
    //     return $this->hasMany(PageSection::class)
    //         ->orderBy('sort_order');
    // }

    public function visibleSections(): HasMany
    {
        return $this->sections()
            ->where('is_visible', true);
    }

    public function versions(): HasMany
    {
        return $this->hasMany(PageVersion::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)
            ->orderBy('sort_order');
    }


    protected static function booted(): void
    {

        static::updating(function ($page) {

            PageVersion::create([

                'page_id' => $page->id,

                'snapshot' => json_encode(
                    $page->getOriginal()
                ),

                'created_by' => Auth::id(),
            ]);
        });

        static::creating(function ($page) {

            if (! $page->preview_token) {

                $page->preview_token = Str::uuid();
            }
        });

        static::saved(function ($page) {
            broadcast(new PageUpdated($page));
        });

        static::saved(
            fn($page) =>
            PageCacheService::flush($page->id)
        );

        static::saved(function ($page) {

            Cache::forget("page:{$page->id}");
        });

        static::deleted(function ($page) {

            Cache::forget("page:{$page->id}");
        });
        static::saving(function ($page) {

            if ($page->status === 'scheduled' && $page->published_at?->isPast()) {
                $page->status = 'published';
            }
        });
    }


    public function scopePublished($query)
    {
        return $query
            ->where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }
}
