<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            // NewsSeeder::class,
            BreakingNewsSeeder::class,
            NavigationSeeder::class,
            CategoryTeaserRowSeeder::class,
            ArticleSeeder::class,
            HomepageTeaserSeeder::class,
            KolamuTeaserRowSeeder::class,
            PichaTeaserRowSeeder::class,
            HadithiTeaserSeeder::class,
            SiteSettingSeeder::class,
            SocialLinkSeeder::class,
            GlobalFooterComponentsSeeder::class,
            SpotiKenyaTeaserRowSeeder::class,
            SpotiMajuuTeaserRowSeeder::class,
            VideoTeaserRowSeeder::class,
            FooterDynamicSeeder::class,
            ExternalArticleSeeder::class,
        ]);
    }
}
