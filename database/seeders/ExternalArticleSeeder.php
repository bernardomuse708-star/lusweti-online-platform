<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExternalArticleSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::updateOrCreate(
            ['slug' => 'external'],
            ['name' => 'External', 'bg_color' => '#F5911E', 'text_color' => '#FFFFFF', 'is_active' => true]
        );

        $externalArticles = [
            [
                'title' => 'Breaking: Major Sports Event Coverage',
                'url' => 'https://example.com/sports-event',
                'summary' => 'This is an example of an external article with OG image extraction.',
            ],
            [
                'title' => 'Technology News Update',
                'url' => 'https://example.com/tech-news',
                'summary' => 'Example of external tech news article.',
            ],
            [
                'title' => 'Entertainment Highlights',
                'url' => 'https://example.com/entertainment',
                'summary' => 'Entertainment news from external source.',
            ],
        ];

        foreach ($externalArticles as $articleData) {
            $article = Article::updateOrCreate(
                ['slug' => Str::slug($articleData['title'])],
                [
                    'category_id' => $category->id,
                    'tentacle_id' => 'ext-' . Str::random(8),
                    'title' => $articleData['title'],
                    'slug' => Str::slug($articleData['title']),
                    'summary' => $articleData['summary'],
                    'url' => $articleData['url'],
                    'published_at' => now()->subHours(rand(1, 24)),
                    'is_visible' => true,
                ]
            );

            // Try to extract OG image from external URL
            if ($article->getMedia('featured_image')->isEmpty()) {
                $ogImageUrl = $this->extractOgImage($articleData['url']);

                if ($ogImageUrl) {
                    try {
                        // Download the OG image and add to Media Library
                        $response = Http::timeout(30)->get($ogImageUrl);

                        if ($response->successful()) {
                            $tempPath = tempnam(sys_get_temp_dir(), 'og_image_');
                            file_put_contents($tempPath, $response->body());

                            $article->addMedia($tempPath)
                                ->preservingOriginal()
                                ->toMediaCollection('featured_image');

                            unlink($tempPath);

                            $this->command->info("Successfully attached OG image to: \"{$article->title}\"");
                        }
                    } catch (\Exception $e) {
                        Log::error("Failed to download OG image for {$article->title}: " . $e->getMessage());
                        $this->command->warn("Failed to download OG image for: \"{$article->title}\"");
                    }
                } else {
                    // Fallback to dummy image if OG extraction fails
                    $filename = 'article-soka.jpg';
                    $sourcePath = public_path('storage' . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . $filename);

                    if (file_exists($sourcePath)) {
                        try {
                            $article->addMedia($sourcePath)
                                ->preservingOriginal()
                                ->toMediaCollection('featured_image');
                            $this->command->info("Attached fallback image to: \"{$article->title}\"");
                        } catch (\Exception $e) {
                            $this->command->error("Failed to attach fallback image: " . $e->getMessage());
                        }
                    }
                }
            }
        }
    }

    /**
     * Extract OG image URL from external URL
     */
    private function extractOgImage(string $url): ?string
    {
        try {
            $response = Http::timeout(10)->get($url);

            if (!$response->successful()) {
                return null;
            }

            $html = $response->body();

            // Extract OG:image meta tag
            if (preg_match('/<meta\s+property="og:image"\s+content="([^"]+)"/i', $html, $matches)) {
                return $matches[1];
            }

            // Fallback to twitter:image
            if (preg_match('/<meta\s+name="twitter:image"\s+content="([^"]+)"/i', $html, $matches)) {
                return $matches[1];
            }

            return null;
        } catch (\Exception $e) {
            Log::error("Failed to extract OG image from {$url}: " . $e->getMessage());
            return null;
        }
    }
}
