<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KolamuTeaserRowSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $category = Category::updateOrCreate(
                ['slug' => 'kolamu'],
                [
                    'name' => 'Kolamu',
                    'bg_color' => '#6A270B',
                    'text_color' => '#FFFFFF',
                    'is_active' => true,
                ]
            );

            $now = now();

            $articles = [

                [
                    'category_id' => $category->id,
                    'tentacle_id' => '5471548-57',
                    'title' => 'Pole sana Metacha, hata Okello alitumia akili',
                    'slug' => Str::slug('Pole sana Metacha hata Okello alitumia akili'),
                    'summary' => 'Soma hapa',
                    'image_path' => '/resource/blob/5471550/4f9acc90647a0091d2c1ff2db1501650/zengwe-pict-data.jpg',
                    'layout_style' => 'featured-large',
                    'is_prime' => true,
                    'published_at' => $now->copy()->subHours(4),
                ],

                [
                    'category_id' => $category->id,
                    'tentacle_id' => '5471506-58',
                    'title' => "Mtego wa TFF unavyosaka 'mchawi' wa Ligi Kuu Bara",
                    'slug' => Str::slug('Mtego wa TFF unavyosaka mchawi wa Ligi Kuu Bara'),
                    'summary' => null,
                    'image_path' => '/resource/blob/5471508/dffc0666969d6c703962a0b5873873b4/tuzo-pict-data.png',
                    'layout_style' => 'right-thumbnail',
                    'is_prime' => true,
                    'published_at' => $now->copy()->subHours(5),
                ],

                [
                    'category_id' => $category->id,
                    'tentacle_id' => '5471422-59',
                    'title' => 'Dakika za jioni kwa kina Metacha, hatuna ubinadamu tena',
                    'slug' => Str::slug('Dakika za jioni kwa kina Metacha hatuna ubinadamu tena'),
                    'summary' => null,
                    'image_path' => '/resource/blob/5471426/a7b6423a29491658a3ce2c69211acd7e/jicho-pict-data.jpg',
                    'layout_style' => 'right-thumbnail',
                    'is_prime' => true,
                    'published_at' => $now->copy()->subHours(18),
                ],

                [
                    'category_id' => $category->id,
                    'tentacle_id' => '5470504-5a',
                    'title' => 'KASIGA: Hii ndiyo mikakati ya gofu nchini',
                    'slug' => Str::slug('KASIGA Hii ndiyo mikakati ya gofu nchini'),
                    'summary' => null,
                    'image_path' => '/resource/image/5470508/portrait_ratio1x1/70/70/39c5986d749f2db013c8a10354485da6/QK/gofu-pc.jpg',
                    'layout_style' => 'right-thumbnail',
                    'is_prime' => false,
                    'published_at' => $now->copy()->subHours(21),
                ],

                [
                    'category_id' => $category->id,
                    'tentacle_id' => '5470638-5b',
                    'title' => 'Martinez na Mandinha ndani ya penzi lililoanzia stendi lililompa ubingwa',
                    'slug' => Str::slug('Martinez na Mandinha ndani ya penzi lililoanzia stendi lililompa ubingwa'),
                    'summary' => null,
                    'image_path' => '/resource/image/5470660/portrait_ratio1x1/70/70/d3fc348695d398a3639b88e2c7924031/in/martinez-pc.jpg',
                    'layout_style' => 'right-thumbnail',
                    'is_prime' => false,
                    'published_at' => $now->copy()->subDay(),
                ],

                [
                    'category_id' => $category->id,
                    'tentacle_id' => '5470664-5c',
                    'title' => 'Makosa yanayofanywa katika uvaaji wa suti',
                    'slug' => Str::slug('Makosa yanayofanywa katika uvaaji wa suti'),
                    'summary' => null,
                    'image_path' => null,
                    'layout_style' => 'text-only',
                    'is_prime' => false,
                    'published_at' => $now->copy()->subDay()->subHour(),
                ],

                [
                    'category_id' => $category->id,
                    'tentacle_id' => '5470476-5d',
                    'title' => 'Maajabu ya mchezo wa Kiyumbizi',
                    'slug' => Str::slug('Maajabu ya mchezo wa Kiyumbizi kolamu'),
                    'summary' => null,
                    'image_path' => null,
                    'layout_style' => 'text-only',
                    'is_prime' => false,
                    'published_at' => $now->copy()->subDay()->subHours(2),
                ],

                [
                    'category_id' => $category->id,
                    'tentacle_id' => '5469506-5e',
                    'title' => 'Msimu unafungwa kwa kishindo! Utamu upo chini',
                    'slug' => Str::slug('Msimu unafungwa kwa kishindo Utamu upo chini'),
                    'summary' => null,
                    'image_path' => null,
                    'layout_style' => 'text-only',
                    'is_prime' => false,
                    'published_at' => $now->copy()->subDays(2),
                ],

                [
                    'category_id' => $category->id,
                    'tentacle_id' => '5469402-5f',
                    'title' => 'Neuer, Musiala, Wirtz wabeba tumaini la Ujerumani',
                    'slug' => Str::slug('Neuer Musiala Wirtz wabeba tumaini la Ujerumani'),
                    'summary' => null,
                    'image_path' => null,
                    'layout_style' => 'text-only',
                    'is_prime' => false,
                    'published_at' => $now->copy()->subDays(2)->subHour(),
                ],

                [
                    'category_id' => $category->id,
                    'tentacle_id' => '60-prime',
                    'title' => 'Nyuma ya ubora wa Simba kuna huyu',
                    'slug' => Str::slug('Nyuma ya ubora wa Simba kuna huyu'),
                    'summary' => null,
                    'image_path' => null,
                    'layout_style' => 'text-only',
                    'is_prime' => true,
                    'published_at' => $now->copy()->subDays(2)->subHours(2),
                ],

            ];

            foreach ($articles as $article) {
                $articleModel = Article::updateOrCreate(
                    [
                        'slug' => $article['slug'],
                    ],
                    $article
                );

                // Add featured image using Media Library if image_path is not null
                if (!empty($article['image_path']) && $articleModel->getMedia('featured_image')->isEmpty()) {
                    $filename = 'article-burudani.jpg';
                    $sourcePath = public_path('storage' . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . $filename);

                    if (file_exists($sourcePath)) {
                        try {
                            $articleModel->addMedia($sourcePath)
                                ->preservingOriginal()
                                ->toMediaCollection('featured_image');
                        } catch (\Exception $e) {
                            $this->command->error("Failed to attach media to article: " . $e->getMessage());
                        }
                    } else {
                        $altPath = public_path('seeds' . DIRECTORY_SEPARATOR . $filename);
                        if (file_exists($altPath)) {
                            try {
                                $articleModel->addMedia($altPath)
                                    ->preservingOriginal()
                                    ->toMediaCollection('featured_image');
                            } catch (\Exception $e) {
                                $this->command->error("Failed to attach media to article: " . $e->getMessage());
                            }
                        }
                    }
                }
            }
        });
    }
}