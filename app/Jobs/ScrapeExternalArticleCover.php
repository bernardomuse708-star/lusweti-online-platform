<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Dispatchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ScrapeExternalArticleCover implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $articleId;

    public int $tries = 2;

    public int $timeout = 30;

    public function __construct(int $articleId)
    {
        $this->articleId = $articleId;
    }

    public function handle(): void
    {
        $article = Article::find($this->articleId);

        if (!$article || !filled($article->external_url)) {
            return;
        }

        try {
            $imageUrl = $this->extractOgImage($article->external_url);

            if (!$imageUrl) {
                Log::info('No OG image found for external URL: ' . $article->external_url);
                return;
            }

            $resolvedUrl = $this->resolveImageUrl($imageUrl, $article->external_url);

            if (!filter_var($resolvedUrl, FILTER_VALIDATE_URL)) {
                Log::warning('Resolved OG image URL is invalid: ' . $resolvedUrl);
                return;
            }

            $response = Http::timeout(30)->get($resolvedUrl);

            if (!$response->successful()) {
                Log::warning('Failed to download OG image for external URL: ' . $resolvedUrl . ' (status: ' . $response->status() . ')');
                return;
            }

            if ($article->hasMedia('featured_image')) {
                $article->clearMediaCollection('featured_image');
            }

            $article->addMediaFromUrl($resolvedUrl)
                ->preservingOriginal()
                ->toMediaCollection('featured_image');

            Log::info('Attached scraped OG image for external URL: ' . $article->external_url);
        } catch (\Exception $e) {
            Log::error('ScrapeExternalArticleCover failed for article ' . $this->articleId . ': ' . $e->getMessage());
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
}
