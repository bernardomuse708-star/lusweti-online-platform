<?php

namespace App\Models;

use App\Events\ArticlePublished;
use App\Jobs\ScrapeExternalArticleCover;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'tentacle_id',
        'topic_label',
        'title',
        'slug',
        'summary',
        'external_url',
        'content',
        'layout_type',
        'is_featured_in_row',
        'is_prime',
        'display_style',
        'display_layout',
        'published_at',
        'is_visible',
    ];

    protected $casts = [
        'is_prime' => 'boolean',
        'is_featured_in_row' => 'boolean',
        'is_visible' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        // Consolidate triggers to avoid redundant websocket payload execution
        static::saved(function (Article $article) {
            broadcast(new ArticlePublished($article))->toOthers();

            if ($article->external_url && $article->wasChanged('external_url')) {
                ScrapeExternalArticleCover::dispatchAfterResponse($article);
            }
        });

        static::deleted(function (Article $article) {
            broadcast(new ArticlePublished($article))->toOthers();
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->useFallbackUrl(asset('images/placeholders/article-default.jpg'));
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished(Builder $query): void
    {
        $query
            ->where('published_at', '<=', now())
            // Fallback rule protects query execution if column is missing from custom migrations
            ->where('is_visible', true)
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }

    /**
     * Scope a query to retrieve a high-performance stream of published articles for a specific category.
     * * Designed to lean cleanly on covered indexes composite (category_id, is_visible, published_at, id).
     *
     * @param Builder $query
     * @param int $categoryId
     * @return Builder
     */
    public function scopePublishedStream(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId)
            ->where('is_visible', true)
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }

    /**
     * Scope a query to retrieve a high-performance feed of published articles for a specific category.
     * * Designed to lean cleanly on covered indexes composite (category_id, is_visible, published_at, id).
     *
     * @param Builder $query
     * @param int $categoryId
     * @return Builder
     */


    public function scopePublishedFeed(Builder $query, int $categoryId): void
    {
        $query
            ->published()
            ->where('category_id', $categoryId);
    }
}
// class Article extends Model implements HasMedia
// {
//     use HasFactory;
//     use InteractsWithMedia;

//     protected $fillable = [
//         'category_id',
//         'tentacle_id',
//         'topic_label',
//         'title',
//         'slug',
//         'summary',
//         'external_url',
//         'content',
//         'layout_type',
//         'is_featured_in_row',
//         'is_prime',
//         'display_style',
//         'display_layout',
//         'published_at',
//         'is_visible',
//     ];

//     protected $casts = [
//         'is_prime' => 'boolean',
//         'is_featured_in_row' => 'boolean',
//         'is_visible' => 'boolean',
//         'published_at' => 'datetime',
//     ];

//     /**
//      * Define the media collections.
//      */
//     // public function registerMediaCollections(): void
//     // {
//     //     // Enforce a single 'cover' image with a fallback for missing media
//     //     $this->addMediaCollection('cover')
//     //         ->singleFile()
//     //         ->useFallbackUrl('/assets/fallbacks/article-hero.webp');
//     // }

//     /**
//      * Define optimized image conversions for the frontend grid.
//      */
//     // public function registerMediaConversions(?Media $media = null): void
//     // {
//     //     // 1. Base optimized version (Largest format)
//     //     $this->addMediaConversion('optimized')
//     //         ->fit(Fit::Crop, 1200, 675)
//     //         ->format('webp')
//     //         ->quality(82)
//     //         ->queued();

//     //     // 2. Used in the large featured layout (lg:col-span-4 aspect-[16/10])
//     //     $this->addMediaConversion('featured')
//     //         ->fit(Fit::Crop, 800, 500)
//     //         ->format('webp')
//     //         ->quality(80)
//     //         ->queued(); 

//     //     // 3. Used in the thumbnail list (lg:col-span-4 space-y-4)
//     //     $this->addMediaConversion('thumbnail')
//     //         ->fit(Fit::Crop, 150, 150)
//     //         ->format('webp')
//     //         ->quality(75)
//     //         ->sharpen(10)
//     //         ->queued(); 
//     // }


//     /**
//      * Define and lock down your media collections.
//      */
//     public function registerMediaCollections(): void
//     {
//         $this->addMediaCollection('featured_image')
//             ->singleFile() // Automatically deletes the old file when a new one is uploaded
//             ->useFallbackUrl(asset('images/placeholders/article-default.jpg'))
//             ->useFallbackPath(public_path('images/placeholders/article-default.jpg'));
//     }

//     /**
//      * Automatically trigger background optimizations on upload.
//      */
//     public function registerMediaConversions(?Media $media = null): void
//     {
//         // Grid/Row view thumbnail (High optimization)
//         $this->addMediaConversion('thumb')
//             ->width(400)
//             ->height(225)
//             ->sharpen(10)
//             ->nonQueued(); // Fast, non-blocking if small

//         // Large Hero display
//         $this->addMediaConversion('hero')
//             ->width(1200)
//             ->height(675)
//             ->withResponsiveImages(); // Generates srcsets for mobile responsiveness
//     }

//     public function category(): BelongsTo
//     {
//         return $this->belongsTo(Category::class);
//     }

//     public function scopePublished(Builder $query): void
//     {
//         $query
//             ->where('published_at', '<=', now())
//             ->where('is_visible', true)
//             ->orderByDesc('published_at')
//             ->orderByDesc('id');
//     }

//     public function scopePublishedFeed(Builder $query, int $categoryId): void
//     {
//         $query
//             ->published()
//             ->where('category_id', $categoryId);
//     }

//     public function scopePublishedStream(Builder $query, int $categoryId): void
//     {
//         $query
//             ->published()
//             ->where('category_id', $categoryId);
//     }

//     /**
//      * Legacy accessor for older templates not using direct Spatie methods.
//      */
//      /**
//      * CRITICAL FIX FOR YOUR BLADE TEMPLATE:
//      * Your blade uses BOTH `getFirstMediaUrl('default')` AND `image_path`.
//      * If you are using Spatie Media Library, ensure you have this accessor 
//      * so `$item->image_path` resolves correctly for your thumbnails!
//      */
//     public function getImagePathAttribute(): ?string
//     {
//         return $this->getFirstMediaUrl('default') 
//             ?: asset('/assets/fallbacks/default-article.jpg');
//     }
//     protected static function booted(): void
//     {
//         /**
//          * Trigger real-time layout shift on Creation and Updates.
//          */
//         static::saved(fn (Article $article) => broadcast(new ArticlePublished($article)));

//         /**
//          * Trigger real-time layout shift on Deletions.
//          */
//         static::deleted(fn (Article $article) => broadcast(new ArticlePublished($article)));

//         static::saved(function (Article $article) {
//             // 1. Instantly update the UI with text data
//             broadcast(new ArticlePublished($article));

//             // 2. If it's an external article without an image, queue the scraper
//             if ($article->external_url && $article->wasChanged('external_url')) {
//                 ScrapeExternalArticleCover::dispatchAfterResponse($article);
//             }
//         });

//         static::deleted(fn (Article $article) => broadcast(new ArticlePublished($article)));
//     }


    
    
   
// }