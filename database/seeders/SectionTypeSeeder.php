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
                'name' => 'Spoti Majuu',
                'slug' => 'spoti-majuu',
                'component' => 'spoti-majuu',
                'livewire_component' => 'frontend.spoti-majuu-teaser-row',
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
        ];

        foreach ($types as $type) {

            SectionType::updateOrCreate(
                ['slug' => $type['slug']],
                $type
            );
        }
    }
}