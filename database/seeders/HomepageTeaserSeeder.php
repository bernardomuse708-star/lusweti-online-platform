<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Article;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HomepageTeaserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Core Categories (Baki na hili kama lilivyo)
        $soka = Category::updateOrCreate(['slug' => 'soka'], ['name' => 'Soka', 'bg_color' => '#F5911E']);
        $kolamu = Category::updateOrCreate(['slug' => 'kolamu'], ['name' => 'Kolamu', 'bg_color' => '#F5911E']);
        $burudani = Category::updateOrCreate(['slug' => 'burudani'], ['name' => 'Burudani', 'bg_color' => '#F5911E']);
        $spotiMajuu = Category::updateOrCreate(['slug' => 'spoti-majuu'], ['name' => 'Spoti Majuu', 'bg_color' => '#F5911E']);
        // 2. Structural Article Payload Array (Ensures absolute execution safety)
        $articles = [
            [
                'tentacle_id'  => '5471656-21',
                'category_id'  => $soka->id,
                'title'        => 'Okello atibua likizo ya skauti wa FIFA',
                'slug'         => Str::slug('Okello atibua likizo ya skauti wa FIFA'),
                'summary'      => 'Soma zaidi hapa',
                'layout_type'  => 'teaser-image-large',
                'image_path'   => '/resource/blob/5471658/62ffa4647881ea2db48942c76238a7b2/okello-pict-data.jpg',
                'is_prime'     => true,
                'published_at' => now()->subHours(4),
            ],
            [
                'tentacle_id'  => '5471422-22',
                'category_id'  => $kolamu->id,
                'title'        => 'Dakika za jioni kwa kina Metacha, hatuna ubinadamu tena',
                'slug'         => Str::slug('Dakika za jioni kwa kina Metacha hatuna ubinadamu tena'),
                'summary'      => null,
                'layout_type'  => 'teaser-image-none',
                'image_path'   => null,
                'is_prime'     => true,
                'published_at' => now()->subHours(18),
            ],
            [
                'tentacle_id'  => '5471598-23',
                'category_id'  => $soka->id,
                'title'        => 'Yanga, Azam kusaka pointi tatu muhimu Ligi Kuu Bara',
                'slug'         => Str::slug('Yanga Azam kusaka pointi tatu muhimu Ligi Kuu Bara'),
                'summary'      => null,
                'layout_type'  => 'teaser-image-right',
                'image_path'   => '/resource/blob/5471600/596f398bf02d7fcc83f786a4ad40d956/mechi-pict-data.jpg',
                'is_prime'     => false,
                'published_at' => now()->subHours(3),
            ],
            [
                'tentacle_id'  => '5471636-24',
                'category_id'  => $soka->id,
                'title'        => 'Mwamnyeto afunguka mazito, amtaja beki Simba',
                'slug'         => Str::slug('Mwamnyeto afunguka mazito amtaja beki Simba'),
                'summary'      => 'Soma zaidi hapa',
                'layout_type'  => 'teaser-image-large',
                'image_path'   => '/resource/blob/5471638/30cc345deee30f7a49c290c172ede39d/mwamnyeto-pict-data.png',
                'is_prime'     => true,
                'published_at' => now()->subHours(5),
            ],
            [
                'tentacle_id'  => '5471108-25',
                'category_id'  => $soka->id,
                'title'        => 'Simon Msuva aisaka rekodi Iraq',
                'slug'         => Str::slug('Simon Msuva aisaka rekodi Iraq'),
                'summary'      => 'WAKATI msimu wa Ligi Kuu Iraq ukikaribia mwishoni, mashabiki wa soka Tanzania wanasubiri kushuhudia Simon Msuva akiivunja rekodi yake binafsi ya mabao akiwa na Al Talaba.',
                'layout_type'  => 'teaser-text',
                'image_path'   => null,
                'is_prime'     => false,
                'published_at' => now()->subHour(),
            ],
            [
                'tentacle_id'  => '5471548-26',
                'category_id'  => $kolamu->id,
                'title'        => 'Pole sana Metacha, hata Okello alitumia akili',
                'slug'         => Str::slug('Pole sana Metacha hata Okello alitumia akili'),
                'summary'      => null,
                'layout_type'  => 'teaser-image-right',
                'image_path'   => '/resource/blob/5471550/4f9acc90647a0091d2c1ff2db1501650/zengwe-pict-data.jpg',
                'is_prime'     => true,
                'published_at' => now()->subHours(4),
            ],
            [
                'tentacle_id'  => '5471282-29',
                'category_id'  => $burudani->id,
                'title'        => 'Diamond akiri \'kumwibia\' T.I.D',
                'slug'         => Str::slug('Diamond akiri kumwibia TID'),
                'summary'      => null,
                'layout_type'  => 'teaser-image-right',
                'image_path'   => '/resource/blob/5471284/8c70210d0c3a76658d8e832170c64526/diamond-pict-data.png',
                'is_prime'     => false,
                'published_at' => now()->subHours(1),
            ],
            [
                'tentacle_id'  => '5471118-2c',
                'category_id'  => $soka->id,
                'title'        => 'Chirwa apania kuipandisha Kagera Sugar',
                'slug'         => Str::slug('Chirwa apania kuipandisha Kagera Sugar'),
                'summary'      => 'MSHAMBULIAJI wa Kagera Sugar, Mzambia Obrey Chirwa amesema licha ya kasi yake ya kufunga mabao msimu huu, ila kipaumbele chake cha kwanza ni kukirejesha kikosi hicho Ligi Kuu Bara, hata kama...',
                'layout_type'  => 'teaser-image-right',
                'image_path'   => '/resource/blob/5471120/f27a75f20f028dedecaa37423a40ed0f/chirwa-pict-data.png',
                'is_prime'     => false,
                'published_at' => now(),
            ],
        ];

        // Idempotent mass execution mapping against unique tracking identifier
        // 3. Tumia updateOrCreate badala ya upsert
        foreach ($articles as $articleData) {
            Article::updateOrCreate(
                ['slug' => $articleData['slug']],
                $articleData
            );
        }
        // 3. Seed Sidebar Media
        Video::updateOrCreate(
            ['youtube_id' => 'videoseries?list=PLT9FZ72emr6DZ2bvHgu5F7SM3Ik_9Y5Y8'],
            ['title' => 'Main Playlist Content Stream', 'is_active' => true]
        );
    }
}
