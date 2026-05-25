<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTeaserRowSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Safe insert or look-up for the parent category identity map
        $soka = Category::updateOrCreate(
            ['slug' => 'soka'],
            ['name' => 'Soka', 'bg_color' => '#F5911E', 'text_color' => '#FFFFFF', 'is_active' => true]
        );

        // 2. High-speed atomic execution matrix using invariant natural business keys
        Article::upsert([
            [
                'category_id' => $soka->id,
                'tentacle_id' => '5471118-33',
                'title' => 'Chirwa apania kuipandisha Kagera Sugar',
                'slug' => Str::slug('Chirwa apania kuipandisha Kagera Sugar'),
                'summary' => 'MSHAMBULIAJI wa Kagera Sugar, Mzambia Obrey Chirwa amesema licha ya kasi yake ya kufunga mabao msimu huu, ila kipaumbele chake cha kwanza ni kukirejesha kikosi hicho Ligi Kuu Bara, hata kama...',
                'image_path' => '/resource/blob/5471120/f27a75f20f028dedecaa37423a40ed0f/chirwa-pict-data.png',
                'is_featured_in_row' => true,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $soka->id,
                'tentacle_id' => '5471126-34',
                'title' => 'Beimbaya azigonganisha KMC FC, JKT Queens',
                'slug' => Str::slug('Beimbaya azigonganisha KMC FC JKT Queens'),
                'summary' => null,
                'image_path' => null,
                'is_featured_in_row' => false,
                'published_at' => now()->subMinutes(30),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $soka->id,
                'tentacle_id' => '5471108-35',
                'title' => 'Simon Msuva aisaka rekodi Iraq',
                'slug' => Str::slug('Simon Msuva aisaka rekodi Iraq'),
                'summary' => null,
                'image_path' => null,
                'is_featured_in_row' => false,
                'published_at' => now()->subHour(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $soka->id,
                'tentacle_id' => '5471230-36',
                'title' => 'Ligi ya Kabaddi Zanzibar imenoga',
                'slug' => Str::slug('Ligi ya Kabaddi Zanzibar imenoga'),
                'summary' => null,
                'image_path' => null,
                'is_featured_in_row' => false,
                'published_at' => now()->subHours(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $soka->id,
                'tentacle_id' => '5471302-37',
                'title' => 'Simba Queens ina rekodi nzuri Yanga',
                'slug' => Str::slug('Simba Queens ina rekodi nzuri Yanga'),
                'summary' => null,
                'image_path' => null,
                'is_featured_in_row' => false,
                'published_at' => now()->subHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['tentacle_id'], ['title', 'slug', 'summary', 'image_path', 'is_featured_in_row', 'published_at', 'updated_at']);
    }
}
