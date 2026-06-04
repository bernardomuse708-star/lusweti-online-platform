<?php

namespace Database\Seeders;

use App\Models\Burudani;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BurudaniSeeder extends Seeder
{
    public function run(): void
    {

        $newsGrid = [['bg_color' => '#F5911E']];


        $newsGrid = [

            [
                'title' => 'Azam yamfuata staa Serengeti Boys',
                'slug' => 'azam-yamfuata-staa-serengeti-boys-5481322',
                'summary' => 'AZAM FC imeanza mchakato wa kumuwania mshambuliaji wa Serengeti Boys na Kagera Sugar, Luqman Ali, kwa ajili ya msimu ujao.',
                'image' => 'article-soka.jpg',
                'topic' => 'Soka',
                'is_featured' => true,
                'is_prime' => false,
                'published_at' => Carbon::now()->subHours(7),
            ],

            [
                'title' => 'Kombe la Dunia laichezesha Simba mchana',
                'slug' => 'kombe-la-dunia-laichezesha-simba-mchana-5481278',
                'image' => 'article-soka.jpg',
                'topic' => 'Soka',
                'is_featured' => false,
                'is_prime' => false,
                'published_at' => Carbon::now()->subHours(7),
            ],

            [
                'title' => 'Namungo yaanza hesabu za vidole Ligi Kuu',
                'slug' => 'namungo-yaanza-hesabu-za-vidole-ligi-kuu-5481262',
                'image' => 'article-burudani.jpg',
                'topic' => 'Soka',
                'is_featured' => false,
                'is_prime' => false,
                'published_at' => Carbon::now()->subHours(7),
            ],

            [
                'title' => 'Serengeti Boys na fainali ya heshima, historia AFCON',
                'slug' => 'serengeti-boys-na-fainali-ya-heshima-historia-afcon-5480914',
                'image' => 'article-prime.jpg',
                'topic' => 'Soka',
                'is_featured' => false,
                'is_prime' => true,
                'published_at' => Carbon::now()->subHours(10),
            ],

            [
                'title' => 'Wawi Stars, Chipukizi fainali FA Pemba',
                'slug' => 'wawi-stars-chipukizi-fainali-fa-pemba-5480782',
                'image' => 'article-burudani.jpg',
                'topic' => 'Soka',
                'is_featured' => false,
                'is_prime' => false,
                'published_at' => Carbon::now()->subHours(12),
            ],
        ];

        foreach ($newsGrid as $item) {

            $burudani = Burudani::updateOrCreate(
                [
                    'slug' => $item['slug'],
                ],
                [
                    'title' => $item['title'],
                    'summary' => $item['summary'] ?? null,
                    'topic' => $item['topic'],
                    'is_featured' => $item['is_featured'],
                    'is_prime' => $item['is_prime'],
                    'published_at' => $item['published_at'],
                ]
            );

            $imagePath = public_path(
                'seeds/' . $item['image']
            );

            if (
                file_exists($imagePath) &&
                $burudani->getMedia('featured_image')->isEmpty()
            ) {
                $burudani
                    ->addMedia($imagePath)
                    ->preservingOriginal()
                    ->toMediaCollection('featured_image');
            }
        }
    }
}