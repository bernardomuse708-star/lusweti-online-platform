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
            // 1. System Foundation & Auth (Everything else relies on these)
            AdminSeeder::class,
            // PAGE SETTS
            PageSeeder::class,
            SectionTypeSeeder::class,
            PageSectionSeeder::class,
            PageVersionSeeder::class,
            PageSectionItemSeeder::class,

            SiteSettingSeeder::class,
            SocialLinkSeeder::class,

            // 2. Categories & Basic Infrastructure
            // (Ensure these create the Categories first so Articles can link to them)
            CategoryTeaserRowSeeder::class,
            NavigationSeeder::class,

            // 3. Core Content (The "Parents")
            // These must exist before any Teaser links to them
            ArticleSeeder::class,
            BurudaniSeeder::class,
            ExternalArticleSeeder::class,
            HadithiTeaserSeeder::class,

            // 4. Teasers, Rows, & Dynamic Content (The "Children")
            // These usually query existing Articles/Categories and map them to layouts
            BreakingNewsSeeder::class,
            HomepageTeaserSeeder::class,
            KolamuTeaserRowSeeder::class,
            PichaTeaserRowSeeder::class,
            SpotiKenyaTeaserRowSeeder::class,
            SpotiMajuuTeaserRowSeeder::class,
            VideoTeaserRowSeeder::class,

            // 5. Global UI & Footer
            // These can often be at the end as they usually fetch from the already-seeded data
            GlobalFooterComponentsSeeder::class,
            FooterDynamicSeeder::class,
        ]);
    }
}
