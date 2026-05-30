<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpotiMajuuTeaserRowSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Idempotent dynamic category parent assignment matching markup colors
        $category = Category::updateOrCreate(
            ['slug' => 'spoti-majuu'],
            ['name' => 'Spoti Majuu', 'bg_color' => '#F5911E', 'text_color' => '#FFFFFF', 'is_active' => true]
        );

        $now = now();

        // 2. High-speed raw dataset payload compiled directly from your provided structural markup elements
        Article::upsert([
            [
                'category_id' => $category->id,
                'tentacle_id' => '5472098-73',
                'title' => 'Jamie Vardy hana bahati, ashuka tena na Cremonese',
                'slug' => Str::slug('Jamie Vardy hana bahati ashuka tena na Cremonese'),
                'summary' => 'Baada ya kushuka na Leicester City msimu wa 2024/25, nyota wa zamani wa timu ya taifa ya England, Jamie Vardy anaendelea kupitia kipindi kigumu kisicho na bahati baada ya kushuka daraja misimu wa...',
                'image_path' => '/resource/blob/5472100/1e2a4ebd84d4c6fea6babf0c421e4b0a/verdy-pict-data.png',
                'layout_style' => 'featured-large',
                'is_prime' => false,
                'published_at' => $now->subMinutes(30),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5471904-74',
                'title' => 'Arsenal yamaliza EPL kibabe, West Ham yashuka daraja',
                'slug' => Str::slug('Arsenal yamaliza EPL kibabe West Ham yashuka daraja'),
                'summary' => null,
                'image_path' => '/resource/blob/5471906/c676eabf49677659e5baf0eed849e1da/arsenal-pict-data.png',
                'layout_style' => 'thumbnail-right',
                'is_prime' => false,
                'published_at' => $now->subHours(13),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5471476-75',
                'title' => 'Tiketi ya Sh5 bilioni Kombe la Dunia, mhudumu ni Infantino',
                'slug' => Str::slug('Tiketi ya Sh5 bilioni Kombe la Dunia mhudumu ni Infantino'),
                'summary' => null,
                'image_path' => '/resource/blob/5471478/d72d3ca73ff3a1940db6ff22f095906f/infantino-pict-data.jpg',
                'layout_style' => 'thumbnail-right',
                'is_prime' => false,
                'published_at' => $now->subHours(16),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5471558-76',
                'title' => 'Carvajal ana ishu na Inter Miami',
                'slug' => Str::slug('Carvajal ana ishu na Inter Miami'),
                'summary' => null,
                'image_path' => '/resource/blob/5471560/d73d1519043ea60705a9fb2de41f3c07/fununu-pict-data.jpg',
                'layout_style' => 'thumbnail-right',
                'is_prime' => false,
                'published_at' => $now->subHours(16)->subMinutes(5),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5471406-77',
                'title' => 'Carrick afichua mpango wa kusuka upya kikosi',
                'slug' => Str::slug('Carrick afichua mpango wa kusuka upya kikosi'),
                'summary' => null,
                'image_path' => '/resource/blob/5471408/390a4894e1f7742dec9a9a3b6791c004/carrick-pict-data.png',
                'layout_style' => 'thumbnail-right',
                'is_prime' => false,
                'published_at' => $now->subHours(17),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5471390-78',
                'title' => 'Mo Salah aacha ujumbe mzito kwa Slot, wachezaji',
                'slug' => Str::slug('Mo Salah aacha ujumbe mzito kwa Slot wachezaji'),
                'summary' => null,
                'image_path' => null,
                'layout_style' => 'text-only',
                'is_prime' => false,
                'published_at' => $now->subHours(18),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5471378-79',
                'title' => 'Magwiji wawili waangwa Real Madrid',
                'slug' => Str::slug('Magwiji wawili waangwa Real Madrid'),
                'summary' => null,
                'image_path' => null,
                'layout_style' => 'text-only',
                'is_prime' => false,
                'published_at' => $now->subHours(19),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5470624-7a',
                'title' => 'Wembanyama alinganishwa na Giannis kuvunja sheria NBA',
                'slug' => Str::slug('Wembanyama alinganishwa na Giannis kuvunja sheria NBA'),
                'summary' => null,
                'image_path' => null,
                'layout_style' => 'text-only',
                'is_prime' => false,
                'published_at' => $now->subDay(),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5470722-7b',
                'title' => 'Wachezaji wenye umri mdogo zaidi waliofunga Kombe la Dunia',
                'slug' => Str::slug('Wachezaji wenye umri mdogo zaidi waliofunga Kombe la Dunia'),
                'summary' => null,
                'image_path' => null,
                'layout_style' => 'text-only',
                'is_prime' => false,
                'published_at' => $now->subDay()->subMinutes(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5470576-7c',
                'title' => 'Spurs, West Ham nani kubaki EPL?',
                'slug' => Str::slug('Spurs West Ham nani kubaki EPL'),
                'summary' => null,
                'image_path' => null,
                'layout_style' => 'text-only',
                'is_prime' => false,
                'published_at' => $now->subDay()->subMinutes(20),
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ], ['tentacle_id'], ['title', 'slug', 'summary', 'image_path', 'layout_style', 'is_prime', 'published_at', 'updated_at']);

        // Add featured images using Media Library
        $articlesWithImages = [
            ['tentacle_id' => '5472098-73', 'filename' => 'article-soka.jpg'],
            ['tentacle_id' => '5471904-74', 'filename' => 'article-burudani.jpg'],
            ['tentacle_id' => '5471476-75', 'filename' => 'article-soka.jpg'],
            ['tentacle_id' => '5471558-76', 'filename' => 'article-burudani.jpg'],
            ['tentacle_id' => '5471406-77', 'filename' => 'article-soka.jpg'],
        ];

        foreach ($articlesWithImages as $item) {
            $article = Article::where('tentacle_id', $item['tentacle_id'])->first();
            if ($article && $article->getMedia('featured_image')->isEmpty()) {
                $sourcePath = public_path('storage' . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . $item['filename']);

                if (file_exists($sourcePath)) {
                    try {
                        $article->addMedia($sourcePath)
                            ->preservingOriginal()
                            ->toMediaCollection('featured_image');
                    } catch (\Exception $e) {
                        $this->command->error("Failed to attach media to article: " . $e->getMessage());
                    }
                } else {
                    $altPath = public_path('seeds' . DIRECTORY_SEPARATOR . $item['filename']);
                    if (file_exists($altPath)) {
                        try {
                            $article->addMedia($altPath)
                                ->preservingOriginal()
                                ->toMediaCollection('featured_image');
                        } catch (\Exception $e) {
                            $this->command->error("Failed to attach media to article: " . $e->getMessage());
                        }
                    }
                }
            }
        }
    }
}