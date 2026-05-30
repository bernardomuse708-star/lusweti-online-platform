<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Gallery;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PichaTeaserRowSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::updateOrCreate(
            ['slug' => 'picha'],
            [
                'name' => 'Picha',
                'bg_color' => '#F5911E',
                'text_color' => '#FFFFFF',
                'is_active' => true,
            ]
        );

        $galleries = [
            [
                'tentacle_id' => '5467648-81',
                'title' => 'Rio Ferdinand avutiwa na utalii wa Serengeti',
                'image' => 'article-soka.jpg',
                'published_at' => now()->subDays(1),
            ],
            [
                'tentacle_id' => '5465104-82',
                'title' => 'Rio Ferdinand atua nchini, mamia wampokea',
                'image' => 'article-burudani.jpg',
                'published_at' => now()->subDays(3),
            ],
            [
                'tentacle_id' => '5455798-83',
                'title' => 'Namna Barcelona ilivyoshangilia ubingwa wa 29 La Liga',
                'image' => 'article-soka.jpg',
                'published_at' => now()->subDays(2),
            ],
            [
                'tentacle_id' => '5352936-84',
                'title' => 'MKAPA',
                'image' => 'article-burudani.jpg',
                'published_at' => now()->subDays(4),
            ],
        ];

        foreach ($galleries as $item) {

            $Gallery = Gallery::updateOrCreate(
                [
                    'tentacle_id' => $item['tentacle_id'],
                ],
                [
                    'category_id' => $category->id,
                    'title' => $item['title'],
                    'slug' => Str::slug($item['title']),
                    'published_at' => $item['published_at'],
                    'is_visible' => true,
                ]
            );

            // Use public/storage/seeds for dummy images
            $imagePath = public_path('storage' . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . $item['image']);

            if (file_exists($imagePath) && $Gallery->getMedia('cover')->isEmpty()) {
                $Gallery
                    ->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('cover');
            } else {
                // Try alternative path
                $altPath = public_path('seeds' . DIRECTORY_SEPARATOR . $item['image']);
                if (file_exists($altPath) && $Gallery->getMedia('cover')->isEmpty()) {
                    $Gallery
                        ->addMedia($altPath)
                        ->preservingOriginal()
                        ->toMediaCollection('cover');
                }
            }
        }
    }
}
