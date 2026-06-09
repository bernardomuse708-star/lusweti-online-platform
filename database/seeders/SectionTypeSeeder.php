<?php

namespace Database\Seeders;

use App\Models\SectionType;
use Illuminate\Database\Seeder;

class SectionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [

            [
                'name' => 'Hadithi',
                'slug' => 'hadithi',
                'component' => 'hadithi',
                'livewire_component' => 'frontend.hadithi-row',
            ],

            [
                'name' => 'Kolamu',
                'slug' => 'kolamu',
                'component' => 'kolamu',
                'livewire_component' => 'frontend.kolamu-teaser-row',
            ],

            [
                'name' => 'Habari',
                'slug' => 'habari',
                'component' => 'habari',
                'livewire_component' => 'frontend.hadithi-row',
            ],

            [
                'name' => 'Maoni',
                'slug' => 'maoni',
                'component' => 'maoni',
                'livewire_component' => 'frontend.kolamu-teaser-row',
            ],

            [
                'name' => 'Spoti Kenya',
                'slug' => 'spoti-kenya',
                'component' => 'spoti-kenya',
                'livewire_component' => 'frontend.spoti-kenya-teaser-row',
            ],

            [
                'name' => 'Spoti Majuu',
                'slug' => 'spoti-majuu',
                'component' => 'spoti-majuu',
                'livewire_component' => 'frontend.spoti-majuu-teaser-row',
            ],

            [
                'name' => 'Matokeo',
                'slug' => 'matokeo',
                'component' => 'matokeo',
                'livewire_component' => 'frontend.matokeo-row',
            ],

            [
                'name' => 'Uchambuzi',
                'slug' => 'uchambuzi',
                'component' => 'uchambuzi',
                'livewire_component' => 'frontend.uchambuzi-row',
            ],

            [
                'name' => 'Burudani',
                'slug' => 'burudani',
                'component' => 'burudani',
                'livewire_component' => 'frontend.category-teaser-row',
            ],

            [
                'name' => 'Video',
                'slug' => 'video',
                'component' => 'video',
                'livewire_component' => 'frontend.video-teaser-row',
            ],

            [
                'name' => 'Picha',
                'slug' => 'picha',
                'component' => 'picha',
                'livewire_component' => 'frontend.picha-teaser-row',
            ],

            [
                'name' => 'Magazine',
                'slug' => 'magazine',
                'component' => 'magazine',
                'livewire_component' => 'magazine-layout.magazine-home',
            ],
        ];

        foreach ($types as $type) {

            SectionType::updateOrCreate(
                ['slug' => $type['slug']],
                $type
            );
        }
    }
}