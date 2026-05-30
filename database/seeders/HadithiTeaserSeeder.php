<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HadithiTeaserSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::updateOrCreate(
            ['slug' => 'hadithi'],
            ['name' => 'Hadithi', 'bg_color' => '#F5911E', 'text_color' => '#FFFFFF', 'is_active' => true]
        );

        $baseTime = now();

        $articles = [
            [
                'category_id' => $category->id,
                'tentacle_id' => '5246530-3a',
                'title' => 'Mtoto wa Mjini - 15',
                'slug' => Str::slug('Mtoto wa Mjini - 15'),
                'summary' => 'Usifanye mchezo na damu ya mswahili, baada ya miezi mitano ya kuwa na uhusiano kati yake na Muddy, Linnie alipatwa na mabadiliko makubwa ya mwili. Hali yake ilibadilika na kuonekana kunawiri na...',
                'image_path' => '/resource/image/5246542/landscape_ratio3x2/300/200/9da619d3aa294d195897550738fff612/fH/mtoto-wa-mjini-15-pic.png',
                'display_style' => 'large',
                'published_at' => $baseTime,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5245044-3b',
                'title' => 'Mtoto wa Mjini - 14',
                'slug' => Str::slug('Mtoto wa Mjini - 14'),
                'summary' => null,
                'image_path' => '/resource/image/5245072/landscape_ratio3x2/150/100/76b9379aaeed9a2f17ac43974feed816/Vr/mtoto-wa-mjini-14-pic-b.png',
                'display_style' => 'thumbnail-left',
                'published_at' => $baseTime->subMinutes(10),
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5245012-3c',
                'title' => 'Mtoto wa Mjini - 13',
                'slug' => Str::slug('Mtoto wa Mjini - 13'),
                'summary' => null,
                'image_path' => '/resource/image/5245068/landscape_ratio3x2/150/100/9b407798dcf632c3403355ef38f861f7/bI/mtoto-wa-mjini-13-pic-b.png',
                'display_style' => 'thumbnail-left',
                'published_at' => $baseTime->subMinutes(20),
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5241848-3d',
                'title' => 'Mtoto wa Mjini - 12',
                'slug' => Str::slug('Mtoto wa Mjini - 12'),
                'summary' => null,
                'image_path' => '/resource/image/5241860/landscape_ratio3x2/150/100/74b7500d44e52c994953b4d74a30ec1e/cm/mtoto-wa-mjini-12-pic.jpg',
                'display_style' => 'thumbnail-left',
                'published_at' => $baseTime->subMinutes(30),
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5239948-3e',
                'title' => 'Mtoto wa Mjini - 11',
                'slug' => Str::slug('Mtoto wa Mjini - 11'),
                'summary' => null,
                'image_path' => '/resource/image/5240036/landscape_ratio3x2/150/100/342b8792257ec1a9eb8c866b30ed5b07/Ql/mtoto-wa-mjini-11-pic.jpg',
                'display_style' => 'thumbnail-left',
                'published_at' => $baseTime->subMinutes(40),
            ],
        ];

        // Hydrate Text Only entries programmatically via standard mapping rules
        for ($i = 10; $i >= 5; $i--) {
            $articles[] = [
                'category_id' => $category->id,
                'tentacle_id' => "5239936-offset-{$i}",
                'title' => "Mtoto wa Mjini - {$i}",
                'slug' => Str::slug("Mtoto wa Mjini - {$i}"),
                'summary' => null,
                'image_path' => null,
                'display_style' => 'text-only',
                'published_at' => $baseTime->subHours(12 - $i),
            ];
        }

        Article::upsert($articles, ['tentacle_id'], ['title', 'slug', 'summary', 'image_path', 'display_style', 'published_at']);

        // Add featured images using Media Library
        $articlesWithImages = array_filter($articles, fn($a) => !empty($a['image_path']));
        foreach ($articlesWithImages as $articleData) {
            $article = Article::where('slug', $articleData['slug'])->first();
            if ($article && $article->getMedia('featured_image')->isEmpty()) {
                $filename = 'article-soka.jpg';
                $sourcePath = public_path('storage' . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . $filename);

                if (file_exists($sourcePath)) {
                    try {
                        $article->addMedia($sourcePath)
                            ->preservingOriginal()
                            ->toMediaCollection('featured_image');
                    } catch (\Exception $e) {
                        $this->command->error("Failed to attach media to article: " . $e->getMessage());
                    }
                } else {
                    $altPath = public_path('seeds' . DIRECTORY_SEPARATOR . $filename);
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