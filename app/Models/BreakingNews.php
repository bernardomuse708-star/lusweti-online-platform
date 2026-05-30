<?php

namespace App\Models;

use App\Events\BreakingNewsUpdated;
use Illuminate\Database\Eloquent\Model;
use App\Services\HeadlineAiService;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class BreakingNews extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'url',
        'is_active',
        'is_live',
        'is_urgent',
        'expires_at',
        'priority',
        'ai_score',
    ];

    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    public function getDisplayTitleAttribute()
    {
        return $this->ai_title ?: $this->title;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->useFallbackUrl(asset('images/placeholders/breaking-news-default.jpg'));
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

    public function getImageUrlAttribute(): ?string
    {
        if ($this->hasMedia('featured_image')) {
            return $this->getFirstMediaUrl('featured_image', 'hero');
        }
        return null;
    }

    public function getImageThumbUrlAttribute(): ?string
    {
        if ($this->hasMedia('featured_image')) {
            return $this->getFirstMediaUrl('featured_image', 'thumb');
        }
        return null;
    }

    /**
     * Extract OG image from external URL and attach to featured_image collection
     */
    public function extractAndAttachOgImage(string $externalUrl): bool
    {
        try {
            $imageUrl = $this->extractOgImage($externalUrl);

            if (!$imageUrl) {
                Log::info('No OG image found for URL: ' . $externalUrl);
                return false;
            }

            $resolvedUrl = $this->resolveImageUrl($imageUrl, $externalUrl);

            if (!filter_var($resolvedUrl, FILTER_VALIDATE_URL)) {
                Log::warning('Resolved OG image URL is invalid: ' . $resolvedUrl);
                return false;
            }

            $response = Http::timeout(30)->get($resolvedUrl);

            if (!$response->successful()) {
                Log::warning('Failed to download OG image: ' . $resolvedUrl);
                return false;
            }

            if ($this->hasMedia('featured_image')) {
                $this->clearMediaCollection('featured_image');
            }

            $this->addMediaFromUrl($resolvedUrl)
                ->preservingOriginal()
                ->toMediaCollection('featured_image');

            Log::info('Attached OG image to BreakingNews: ' . $this->title);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to extract OG image for BreakingNews: ' . $e->getMessage());
            return false;
        }
    }

    private function extractOgImage(string $url): ?string
    {
        try {
            $response = Http::timeout(15)->get($url);

            if (!$response->successful()) {
                return null;
            }

            $html = $response->body();

            if (preg_match('/<meta\s+property=["\']og:image["\']\s+content=["\']([^"\']+)["\']/i', $html, $matches)) {
                return trim($matches[1]);
            }

            if (preg_match('/<meta\s+name=["\']twitter:image["\']\s+content=["\']([^"\']+)["\']/i', $html, $matches)) {
                return trim($matches[1]);
            }

            return null;
        } catch (\Exception $e) {
            Log::warning('Failed to extract OG image from ' . $url . ': ' . $e->getMessage());
            return null;
        }
    }

    private function resolveImageUrl(string $imageUrl, string $baseUrl): string
    {
        $imageUrl = trim($imageUrl);

        if (str_starts_with($imageUrl, '//')) {
            $scheme = parse_url($baseUrl, PHP_URL_SCHEME) ?: 'https';
            return $scheme . ':' . $imageUrl;
        }

        if (parse_url($imageUrl, PHP_URL_SCHEME) !== null) {
            return $imageUrl;
        }

        $basePath = rtrim($baseUrl, '/');

        return $basePath . '/' . ltrim($imageUrl, '/');
    }

    public function updateScore()
    {
        $this->ai_score =
            ($this->views * 0.3) +
            ($this->clicks * 0.6) +
            ($this->is_urgent ? 100 : 0) +
            (now()->diffInMinutes($this->created_at) < 10 ? 50 : 0);

        $this->saveQuietly();
    }

    protected static function booted(): void
    {
        static::created(function () {
            try {
                event(new BreakingNewsUpdated());
            } catch (\Exception $e) {
                report($e);
            }
        });

        static::updated(function () {
            try {
                event(new BreakingNewsUpdated());
            } catch (\Exception $e) {
                report($e);
            }
        });

        static::deleted(function () {
            try {
                event(new BreakingNewsUpdated());
            } catch (\Exception $e) {
                report($e);
            }
        });

        static::created(function ($item) {
            dispatch(function () use ($item) {
                try {
                    $ai = app(HeadlineAiService::class);

                    $item->updateQuietly([
                        'original_title' => $item->title,
                        'ai_title' => $ai->rewrite($item->title),
                    ]);
                } catch (\Exception $e) {
                    report($e);
                }
            })->delay(now()->addSeconds(1));
        });
    }
}
