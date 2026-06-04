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
        $this->seedHomePageSections();
        $this->seedSportsPageSections();
        $this->seedBurudaniPageSections();
    }

    /*
    |--------------------------------------------------------------------------
    | HOME PAGE
    |--------------------------------------------------------------------------
    */
    private function seedHomePageSections(): void
    {
        $page = Page::firstOrCreate(
            ['slug' => 'home'],
            ['title' => 'Home']
        );

        $this->upsertSection($page, [
            'title' => 'Top Stories',
            'section_type_id' => $this->getSectionType('hadithi'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('news'),
            'sort_order' => 1,
        ]);

        $this->upsertSection($page, [
            'title' => 'Spoti Majuu',
            'section_type_id' => $this->getSectionType('spoti-majuu'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('sports'),
            'sort_order' => 2,
        ]);

        $this->upsertSection($page, [
            'title' => 'Burudani',
            'section_type_id' => $this->getSectionType('burudani'),
            'content_source' => 'burudani',
            'category_id' => null,
            'sort_order' => 3,
        ]);

        $this->upsertSection($page, [
            'title' => 'Picha',
            'section_type_id' => $this->getSectionType('picha'),
            'content_source' => 'gallery',
            'category_id' => null,
            'sort_order' => 4,
        ]);

        $this->upsertSection($page, [
            'title' => 'Video',
            'section_type_id' => $this->getSectionType('video'),
            'content_source' => 'video',
            'category_id' => null,
            'sort_order' => 5,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SPORTS PAGE
    |--------------------------------------------------------------------------
    */
    private function seedSportsPageSections(): void
    {
        $page = Page::firstOrCreate(
            ['slug' => 'sports'],
            ['title' => 'Sports']
        );

        $this->upsertSection($page, [
            'title' => 'Spoti Majuu Headlines',
            'section_type_id' => $this->getSectionType('spoti-majuu'),
            'content_source' => 'category',
            'category_id' => $this->getCategory('sports'),
            'sort_order' => 1,
        ]);

        $this->upsertSection($page, [
            'title' => 'Latest Sports Videos',
            'section_type_id' => $this->getSectionType('video'),
            'content_source' => 'video',
            'category_id' => null,
            'sort_order' => 2,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | BURUDANI PAGE
    |--------------------------------------------------------------------------
    */
    private function seedBurudaniPageSections(): void
    {
        $page = Page::firstOrCreate(
            ['slug' => 'burudani'],
            ['title' => 'Burudani']
        );

        $this->upsertSection($page, [
            'title' => 'Latest Burudani Stories',
            'section_type_id' => $this->getSectionType('burudani'),
            'content_source' => 'burudani',
            'category_id' => null,
            'sort_order' => 1,
        ]);

        $this->upsertSection($page, [
            'title' => 'Entertainment Gallery',
            'section_type_id' => $this->getSectionType('picha'),
            'content_source' => 'gallery',
            'category_id' => null,
            'sort_order' => 2,
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
            $data
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