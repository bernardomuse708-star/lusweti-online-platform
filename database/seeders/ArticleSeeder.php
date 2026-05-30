<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


    $article = Article::first();
    $filename = 'socer.png';

    // Use public/storage/seeds for dummy images
    $sourcePath = public_path('storage' . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . $filename);


    if (File::exists($sourcePath)) {
        $article->addMedia($sourcePath)
            ->preservingOriginal()
            ->toMediaCollection('featured_image');
    } else {
        // Try alternative path
        $altPath = public_path('seeds' . DIRECTORY_SEPARATOR . $filename);
        if (File::exists($altPath)) {
            $article->addMedia($altPath)
                ->preservingOriginal()
                ->toMediaCollection('featured_image');
        } else {
            $this->command->warn("Media asset missing at [{$sourcePath}] and [{$altPath}]. Applied text database layers only.");
        }
    }


        // 1. Safe Category Resolution: Match explicitly on the unique constraint ('name')
        $sokaCategory = Category::firstOrCreate(['name' => 'Soka'], ['slug' => 'soka', 'is_active' => true]);
        $burudaniCategory = Category::firstOrCreate(['name' => 'Burudani'], ['slug' => 'burudani', 'is_active' => true]);
        $kolamuCategory = Category::firstOrCreate(['name' => 'Kolamu'], ['slug' => 'kolamu', 'is_active' => true]);
        $spotiMajuuCategory = Category::firstOrCreate(['name' => 'Spoti Majuu'], ['slug' => 'spoti-majuu', 'is_active' => true]);
        $spotiKenyaCategory = Category::firstOrCreate(['name' => 'Spoti Kenya'], ['slug' => 'spoti-kenya', 'is_active' => true]);

        // 2. Article Payload: Ensured unique slugs and tentacle_ids for every entry
        $articles = [
            [
                'title' => 'Kikosi cha Timu ya Taifa Kuanza Kambi Wiki Hii',
                'slug' => 'kikosi-cha-timu-ya-taifa-kuanza-kambi-wiki-hii',
                'category_id' => $sokaCategory->id,
                'tentacle_id' => 'TNT-SOKA-001',
                'topic_label' => 'Soka la Ndani',
                'summary' => 'Maandalizi ya mechi za kufuzu yanaendelea huku kocha mkuu akitangaza majina mapya.',
                'content' => 'Mabadiliko makubwa yamefanyika kwenye safu ya ushambuliaji...',
                'layout_type' => 'grid',
                'external_url' => 'https://www.skysports.com/football',
                'display_style' => 'hero-card',
                'display_layout' => 'standard',
                'is_featured_in_row' => true,
                'is_prime' => true,
                'is_visible' => true, // ADD THIS
                'published_at' => now()->subHours(2),
                'seed_filename' => 'article-soka.jpg', 
            ],
            [
                'title' => 'Tamasha Kuu la Burudani Kung\'aa Wikiendi Hii Pwani',
                'slug' => 'tamasha-kuu-la-burudani-kungaa-wikiendi-hii-pwani',
                'category_id' => $burudaniCategory->id,
                'tentacle_id' => 'TNT-ENT-002',
                'topic_label' => 'Burudani',
                'summary' => 'Wasanii mashuhuri wamethibitisha kuhudhuria tamasha la mwaka huku tiketi zikiisha kwa kasi.',
                'content' => 'Maandalizi ya jukwaa kuu yamekamilika...',
                'layout_type' => 'list',
                'external_url' => 'https://www.skysports.com/football',
                'display_style' => 'list-item',
                'display_layout' => 'compact',
                'is_featured_in_row' => false,
                'is_prime' => false,
                'is_visible' => true, // ADD THIS
                'published_at' => now()->subDays(1),
                'seed_filename' => 'article-burudani.jpg',
            ],
            [
                'title' => 'Maoni: Nini Kinaikwamisha Soka Letu Katika Ngazi ya Kimataifa?',
                'slug' => 'maoni-nini-kinaikwamisha-soka-letu-katika-ngazi-ya-kimataifa',
                'category_id' => $kolamuCategory->id,
                'tentacle_id' => 'TNT-KOL-003',
                'topic_label' => 'Uchambuzi',
                'summary' => 'Tathmini ya kina kuhusu changamoto zinazokabili vilabu vyetu kwenye mashindano makubwa.',
                'content' => 'Ukosefu wa miundombinu thabiti ni mojawapo ya sababu kuu...',
                'layout_type' => 'list',
                'external_url' => null,
                'display_style' => 'list-item',
                'display_layout' => 'compact',
                'is_featured_in_row' => false,
                'is_prime' => false,
                'is_visible' => true, // ADD THIS
                'published_at' => now()->subDays(2),
                // 'seed_filename' => 'article-kolamu.jpg',
            ],
            [
                'title' => 'Mabingwa Watetezi Wapewa Mtihani Mgumu Ulaya',
                'slug' => 'mabingwa-watetezi-wapewa-mtihani-mgumu-ulaya',
                'category_id' => $spotiMajuuCategory->id,
                'tentacle_id' => 'TNT-MAJ-004',
                'topic_label' => 'Soka la Kimataifa',
                'summary' => 'Ratiba mpya imewaweka mabingwa hao kwenye kundi la kifo msimu huu.',
                'content' => 'Mchuano huo unatarajiwa kuvuta hisia za mashabiki wengi kote ulimwenguni...',
                'layout_type' => 'grid',
                'external_url' => 'https://www.skysports.com/champions-league',
                'display_style' => 'standard-card',
                'display_layout' => 'standard',
                'is_featured_in_row' => true,
                'is_prime' => false,
                'is_visible' => true, // ADD THIS
                'published_at' => now()->subDays(3),
                // 'seed_filename' => 'article-majuu-1.jpg',
            ],
            [
                'title' => 'Mchezaji Nyota Akataa Mkataba Mpya, Kutafuta Malisho Mengine',
                'slug' => 'mchezaji-nyota-akataa-mkataba-mpya-kutafuta-malisho-mengine',
                'category_id' => $spotiMajuuCategory->id,
                'tentacle_id' => 'TNT-MAJ-005',
                'topic_label' => 'Usajili',
                'summary' => 'Mazungumzo baina ya wakala na klabu yamegonga mwamba.',
                'content' => 'Inasemekana klabu kadhaa kubwa zimeanza kumnyemelea mshambuliaji huyo...',
                'layout_type' => 'list',
                'external_url' => 'https://www.skysports.com/transfer-centre',
                'display_style' => 'list-item',
                'display_layout' => 'compact',
                'is_featured_in_row' => false,
                'is_prime' => false,
                'is_visible' => true, // ADD THIS
                'published_at' => now()->subDays(4),
                // 'seed_filename' => 'article-majuu-2.jpg',
            ],
        ];

        foreach ($articles as $data) {
            // 1. Safely pull filename using null coalescing
            $filename = $data['seed_filename'] ?? null;
            
            if (array_key_exists('seed_filename', $data)) {
                unset($data['seed_filename']);
            }

            // 2. Persist text payload attributes safely
            $article = Article::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );

           // 3. Process image layer ONLY if a filename was explicitly declared
            if ($filename) {
                if ($article->wasRecentlyCreated || $article->getMedia('featured_image')->isEmpty()) {

                    // Use public/storage/seeds for dummy images
                    $localSeedPath = public_path('storage' . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . $filename);

                    if (file_exists($localSeedPath)) {
                        try {
                            $article->addMedia($localSeedPath)
                                ->preservingOriginal()
                                ->toMediaCollection('featured_image');

                            $this->command->info("Successfully attached local media to: \"{$article->title}\"");
                        } catch (\Exception $e) {
                            Log::error("Spatie failed to process local file asset [{$article->id}]: " . $e->getMessage());
                            $this->command->error("Spatie disk processing error on item: {$article->title}");
                        }
                    } else {
                        // Try alternative path
                        $altPath = public_path('seeds' . DIRECTORY_SEPARATOR . $filename);
                        if (file_exists($altPath)) {
                            try {
                                $article->addMedia($altPath)
                                    ->preservingOriginal()
                                    ->toMediaCollection('featured_image');

                                $this->command->info("Successfully attached local media to: \"{$article->title}\"");
                            } catch (\Exception $e) {
                                Log::error("Spatie failed to process local file asset [{$article->id}]: " . $e->getMessage());
                                $this->command->error("Spatie disk processing error on item: {$article->title}");
                            }
                        } else {
                            $this->command->warn("Missing local placeholder file at: {$localSeedPath} and {$altPath}. Applied text fields only.");
                        }
                    }
                } else {
                    $this->command->line("Article entry matched: \"{$article->title}\" (Media library state intact)");
                }
            } else {
                $this->command->line("Article processed: \"{$article->title}\" (No seed image requested)");
            }
        }
    }
}