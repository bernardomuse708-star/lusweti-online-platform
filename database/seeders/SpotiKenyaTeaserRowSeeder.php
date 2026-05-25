<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class SpotiKenyaTeaserRowSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Safe registration/retrieval for parent styling context metadata
        $category = Category::updateOrCreate(
            ['slug' => 'spoti-kenya'],
            ['name' => 'Spoti Kenya', 'bg_color' => '#F5911E', 'text_color' => '#FFFFFF', 'is_active' => true]
        );

        $now = now();

        // 2. High-speed atomic compilation matrix mapped directly to your provided source records
        Article::upsert([
            [
                'category_id' => $category->id,
                'tentacle_id' => '5436138-65',
                'title' => 'Utamu wa Mashemeji Dabi upo hapa!',
                'slug' => Str::slug('Utamu wa Mashemeji Dabi upo hapa'),
                'summary' => 'Mechi ya 99 ya Mashemeji Derby kati ya vigogo wa soka la Kenya, Gor Mahia na AFC Leopards inapigwa leo kwenye Uwanja wa Nyayo jijini Nairobi ikiwa ni mfululizo wa Ligi Kuu Kenya, msimu huu.',
                'image_path' => '/resource/image/5436266/landscape_ratio3x2/300/200/7536136c4c6d16e785b218d0d003bcf7/xP/mashemeji-pc.jpg',
                'display_layout' => 'large-featured',
                'published_at' => Carbon::create(2026, 4, 26, 15, 0, 0),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5430314-66',
                'title' => 'Kocha Pamba Jiji alia na mabeki',
                'slug' => Str::slug('Kocha Pamba Jiji alia na mabeki'),
                'summary' => null,
                'image_path' => '/resource/blob/5430316/e7c27f697df71da82c2c2450bf2f59f2/baraza-pict-data.jpg',
                'display_layout' => 'thumbnail-right',
                'published_at' => Carbon::create(2026, 4, 21, 12, 0, 0),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5429218-67',
                'title' => 'Mechi saba Ligi Kuu zamshtua Mkenya Mtibwa Sugar',
                'slug' => Str::slug('Mechi saba Ligi Kuu zamshtua Mkenya Mtibwa Sugar'),
                'summary' => null,
                'image_path' => '/resource/blob/5429220/cd486481d6e51d12da8c77febb9c2c3a/mtibwa-pict-data.png',
                'display_layout' => 'thumbnail-right',
                'published_at' => Carbon::create(2026, 4, 20, 10, 0, 0),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5428310-68',
                'title' => 'Straika Mkenya Pamba Jiji apata ahueni',
                'slug' => Str::slug('Straika Mkenya Pamba Jiji apata ahueni'),
                'summary' => null,
                'image_path' => '/resource/image/5428314/portrait_ratio1x1/70/70/7479eb937362dee29c03c940111f24f/pM/straika-pc.jpg',
                'display_layout' => 'thumbnail-right',
                'published_at' => Carbon::create(2026, 4, 19, 16, 30, 0),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5404024-69',
                'title' => 'Mkenya afichua jambo Ligi Kuu Bara',
                'slug' => Str::slug('Mkenya afichua jambo Ligi Kuu Bara'),
                'summary' => null,
                'image_path' => '/resource/blob/5404026/a543dd4d211f8fd90d71ab7e0116305a/baraza-pict-data.jpg',
                'display_layout' => 'thumbnail-right',
                'published_at' => Carbon::create(2026, 3, 27, 9, 15, 0),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5384868-6a',
                'title' => 'Kocha wa zamani Kenya afariki kwa shambulio la moyo',
                'slug' => Str::slug('Kocha wa zamani Kenya afariki kwa shambulio la moyo'),
                'summary' => null,
                'image_path' => null,
                'display_layout' => 'text-only',
                'published_at' => Carbon::create(2026, 3, 9, 14, 0, 0),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5383258-6b',
                'title' => 'Wiki tatu zampa Mkenya ahueni',
                'slug' => Str::slug('Wiki tatu zampa Mkenya ahueni'),
                'summary' => null,
                'image_path' => null,
                'display_layout' => 'text-only',
                'published_at' => Carbon::create(2026, 3, 8, 11, 0, 0),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5374006-6c',
                'title' => 'Pamba Jiji, Azam FC vita ya nne Ligi Kuu Bara',
                'slug' => Str::slug('Pamba Jiji Azam FC vita ya nne Ligi Kuu Bara'),
                'summary' => null,
                'image_path' => null,
                'display_layout' => 'text-only',
                'published_at' => Carbon::create(2026, 2, 27, 18, 0, 0),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5369130-6d',
                'title' => 'Ushindi wampa jeuri Mkenya Singida Black Stars',
                'slug' => Str::slug('Ushindi wampa jeuri Mkenya Singida Black Stars'),
                'summary' => null,
                'image_path' => null,
                'display_layout' => 'text-only',
                'published_at' => Carbon::create(2026, 2, 23, 13, 20, 0),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_id' => $category->id,
                'tentacle_id' => '5362708-6e',
                'title' => 'Mkenya Pamba Jiji hesabu kwa vigogo',
                'slug' => Str::slug('Mkenya Pamba Jiji hesabu kwa vigogo'),
                'summary' => null,
                'image_path' => null,
                'display_layout' => 'text-only',
                'published_at' => Carbon::create(2026, 2, 18, 10, 0, 0),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ], ['tentacle_id'], ['title', 'slug', 'summary', 'image_path', 'display_layout', 'published_at', 'updated_at']);
    }
}