<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\SectionType;
use App\Models\Category;

class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedNyumbaniPageSections();
        $this->seedBurudaniPageSections();
        $this->seedSiasaPageSections();
        $this->seedBiasharaPageSections();
        $this->seedMichezoPageSections();
        $this->seedAfyaPageSections();
    }

    /*
    |--------------------------------------------------------------------------
    | NYUMBANI PAGE (Home)
    |--------------------------------------------------------------------------
    */
    private function seedNyumbaniPageSections(): void
    {
        $page = Page::where('slug', 'nyumbani')->first();

        if (!$page) return;

        $this->upsertSection($page, [
            'title' => 'Magazine',
            'section_type_id' => $this->getSectionType('magazine'),
            'content_source' => 'magazine',
            'category_id' => null,
            'sort_order' => 1,
        ]);

        $this->upsertSection($page, [
            'title' => 'Hadithi',
            'section_type_id' => $this->getSectionType('hadithi'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('hadithi'),
            'sort_order' => 2,
        ]);

        $this->upsertSection($page, [
            'title' => 'Spoti Majuu',
            'section_type_id' => $this->getSectionType('spoti-majuu'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('spoti-majuu'),
            'sort_order' => 3,
        ]);

        $this->upsertSection($page, [
            'title' => 'Burudani',
            'section_type_id' => $this->getSectionType('burudani'),
            'content_source' => 'burudani',
            'category_id' => $this->getCategory('burudani'),
            'sort_order' => 3,
        ]);

        $this->upsertSection($page, [
            'title' => 'Picha',
            'section_type_id' => $this->getSectionType('picha'),
            'content_source' => 'gallery',
            'category_id' => $this->getCategory('picha'),
            'sort_order' => 5,
        ]);

        $this->upsertSection($page, [
            'title' => 'Video',
            'section_type_id' => $this->getSectionType('video'),
            'content_source' => 'video',
            'category_id' => $this->getCategory('video'),
            'sort_order' => 6,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | BURUDANI PAGE
    |--------------------------------------------------------------------------
    */
    private function seedBurudaniPageSections(): void
    {
        $page = Page::where('slug', 'burudani')->first();

        if (!$page) return;

        $this->upsertSection($page, [
            'title' => 'Hadithi',
            'section_type_id' => $this->getSectionType('hadithi'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('hadithi'),
            'sort_order' => 1,
        ]);

        $this->upsertSection($page, [
            'title' => 'Kolamu',
            'section_type_id' => $this->getSectionType('kolamu'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('kolamu'),
            'sort_order' => 2,
        ]);

        $this->upsertSection($page, [
            'title' => 'Picha',
            'section_type_id' => $this->getSectionType('picha'),
            'content_source' => 'gallery',
            'category_id' => $this->getCategory('picha'),
            'sort_order' => 3,
        ]);

        $this->upsertSection($page, [
            'title' => 'Video',
            'section_type_id' => $this->getSectionType('video'),
            'content_source' => 'video',
            'category_id' => $this->getCategory('video'),
            'sort_order' => 4,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SIASA PAGE
    |--------------------------------------------------------------------------
    */
    private function seedSiasaPageSections(): void
    {
        $page = Page::where('slug', 'siasa')->first();

        if (!$page) return;

        $this->upsertSection($page, [
            'title' => 'Habari',
            'section_type_id' => $this->getSectionType('habari'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('hadithi'),
            'sort_order' => 1,
        ]);

        $this->upsertSection($page, [
            'title' => 'Uchambuzi',
            'section_type_id' => $this->getSectionType('uchambuzi'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('kolamu'),
            'sort_order' => 2,
        ]);

        $this->upsertSection($page, [
            'title' => 'Maoni',
            'section_type_id' => $this->getSectionType('maoni'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('kolamu'),
            'sort_order' => 3,
        ]);

        $this->upsertSection($page, [
            'title' => 'Picha',
            'section_type_id' => $this->getSectionType('picha'),
            'content_source' => 'gallery',
            'category_id' => $this->getCategory('picha'),
            'sort_order' => 4,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | BIASHARA PAGE
    |--------------------------------------------------------------------------
    */
    private function seedBiasharaPageSections(): void
    {
        $page = Page::where('slug', 'biashara')->first();

        if (!$page) return;

        $this->upsertSection($page, [
            'title' => 'Hadithi',
            'section_type_id' => $this->getSectionType('hadithi'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('hadithi'),
            'sort_order' => 1,
        ]);

        $this->upsertSection($page, [
            'title' => 'Kolamu',
            'section_type_id' => $this->getSectionType('kolamu'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('kolamu'),
            'sort_order' => 2,
        ]);

        $this->upsertSection($page, [
            'title' => 'Picha',
            'section_type_id' => $this->getSectionType('picha'),
            'content_source' => 'gallery',
            'category_id' => $this->getCategory('picha'),
            'sort_order' => 3,
        ]);

        $this->upsertSection($page, [
            'title' => 'Video',
            'section_type_id' => $this->getSectionType('video'),
            'content_source' => 'video',
            'category_id' => $this->getCategory('video'),
            'sort_order' => 4,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | MICHEZO PAGE
    |--------------------------------------------------------------------------
    */
    private function seedMichezoPageSections(): void
    {
        $page = Page::where('slug', 'michezo')->first();

        if (!$page) return;

        $this->upsertSection($page, [
            'title' => 'Spoti Kenya',
            'section_type_id' => $this->getSectionType('spoti-kenya'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('spoti-kenya'),
            'sort_order' => 1,
        ]);

        $this->upsertSection($page, [
            'title' => 'Spoti Majuu',
            'section_type_id' => $this->getSectionType('spoti-majuu'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('spoti-majuu'),
            'sort_order' => 2,
        ]);

        $this->upsertSection($page, [
            'title' => 'Soka',
            'section_type_id' => $this->getSectionType('spoti-majuu'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('soka'),
            'sort_order' => 3,
        ]);

        $this->upsertSection($page, [
            'title' => 'Uchambuzi',
            'section_type_id' => $this->getSectionType('uchambuzi'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('kolamu'),
            'sort_order' => 4,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | AFYA PAGE
    |--------------------------------------------------------------------------
    */
    private function seedAfyaPageSections(): void
    {
        $page = Page::where('slug', 'afya')->first();

        if (!$page) return;

        $this->upsertSection($page, [
            'title' => 'Hadithi',
            'section_type_id' => $this->getSectionType('hadithi'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('hadithi'),
            'sort_order' => 1,
        ]);

        $this->upsertSection($page, [
            'title' => 'Kolamu',
            'section_type_id' => $this->getSectionType('kolamu'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('kolamu'),
            'sort_order' => 2,
        ]);

        $this->upsertSection($page, [
            'title' => 'Picha',
            'section_type_id' => $this->getSectionType('picha'),
            'content_source' => 'gallery',
            'category_id' => $this->getCategory('picha'),
            'sort_order' => 3,
        ]);

        $this->upsertSection($page, [
            'title' => 'Video',
            'section_type_id' => $this->getSectionType('video'),
            'content_source' => 'video',
            'category_id' => $this->getCategory('video'),
            'sort_order' => 4,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPSERT CORE LOGIC (IDEMPOTENT)
    |--------------------------------------------------------------------------
    */
    private function upsertSection(Page $page, array $data): void
    {
        $page->sections()->updateOrCreate(
            [
                'title' => $data['title'],
            ],
            array_merge($data, ['is_visible' => true])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */
    private function getSectionType(string $slug): int
    {
        return SectionType::where('slug', $slug)->value('id')
            ?? SectionType::firstOrCreate(
                ['slug' => $slug],
                ['name' => ucfirst(str_replace('-', ' ', $slug))]
            )->id;
    }

    private function getCategory(string $slug): ?int
    {
        return Category::where('slug', $slug)->value('id');
    }
}