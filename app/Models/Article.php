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
        'image_path',
        'layout_type',
        'layout_style',
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
            // Only broadcast if not running in console (seeding)
            if (!app()->runningInConsole()) {
                broadcast(new ArticlePublished($article))->toOthers();
            }

            // Disable external scraping during seeding
            if ($article->external_url && $article->wasChanged('external_url') && !app()->runningInConsole()) {
                ScrapeExternalArticleCover::dispatchAfterResponse($article->id);
            }
        });

        static::deleted(function (Article $article) {
            // Only broadcast if not running in console (seeding)
            if (!app()->runningInConsole()) {
                broadcast(new ArticlePublished($article))->toOthers();
            }
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



    /**
     * Pro Full-Text Search Scope with Cover Density Ranking
     */
    public function scopeAdvancedSearch(Builder $query, ?string $term): Builder
    {
        if (blank($term)) {
            return $query;
        }

        // 1. Clean terms & convert to Postgres tsquery formatting (e.g., 'habari & michezo:*')
        $formattedTerm = collect(explode(' ', $term))
            ->map(fn($word) => preg_replace('/[^A-Za-z0-9]/', '', $word))
            ->filter()
            ->map(fn($word) => "{$word}:*")
            ->join(' & ');

        if (empty($formattedTerm)) {
            return $query;
        }

        // 2. Replicate the vectorized text mapping used in our GIN index
        $vector = "
            setweight(to_tsvector('simple', coalesce(title, '')), 'A') ||
            setweight(to_tsvector('simple', coalesce(summary, '')), 'B') ||
            setweight(to_tsvector('simple', coalesce(content, '')), 'C')
        ";

        // 3. Bind the tsquery parameters safely
        return $query->whereRaw("({$vector}) @@ to_tsquery('simple', ?)", [$formattedTerm])
            ->select('*')
            // ts_rank_cd calculates relevance based on word proximity and frequency
            ->selectRaw("ts_rank_cd(({$vector}), to_tsquery('simple', ?)) as relevance", [$formattedTerm])
            ->orderBy('relevance', 'desc');
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        if ($this->hasMedia('featured_image')) {
            return $this->getFirstMediaUrl('featured_image', 'hero');
        }

        return $this->image_path;
    }

    public function getFeaturedImageThumbUrlAttribute(): ?string
    {
        if ($this->hasMedia('featured_image')) {
            return $this->getFirstMediaUrl('featured_image', 'thumb');
        }

        return $this->image_path;
    }
}
