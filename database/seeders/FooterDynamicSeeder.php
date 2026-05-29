<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class FooterDynamicSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed or Update Brand/Footer Configuration Settings
        FooterSetting::updateOrCreate(
            ['id' => 1],
            [
                'brand_name'        => 'Mwanaspoti',
                'brand_short'       => 'MS',
                'brand_description' => 'Premium sports stories, breaking updates, entertainment and exclusive reports from East Africa and beyond.',
                'copyright_text'    => 'Nation Media Group. All rights reserved.',
                'sections_title'    => 'Sections',
                'information_title' => 'Information',
                'footer_decoration' => 'resource/crblob/4367644/a26213978044efb02abdc086cd487b55/footer-decoration-ms-svg-data.svg',
            ]
        );

        // 2. Define Social Media Infrastructure Data
        $socialLinksData = [
            [
                'platform_key' => 'twitter',
                'name'         => 'Twitter',
                'url'          => 'https://twitter.com',
                'color_class'  => 'hover:border-sky-500 hover:bg-sky-500',
                'sort_weight'  => 1,
                'is_active'    => true,
            ],
            [
                'platform_key' => 'facebook',
                'name'         => 'Facebook',
                'url'          => 'https://facebook.com',
                'color_class'  => 'hover:border-blue-500 hover:bg-blue-500',
                'sort_weight'  => 2,
                'is_active'    => true,
            ],
            [
                'platform_key' => 'instagram',
                'name'         => 'Instagram',
                'url'          => 'https://instagram.com',
                'color_class'  => 'hover:border-pink-500 hover:bg-pink-500',
                'sort_weight'  => 3,
                'is_active'    => true,
            ],
        ];

        // 3. Process records individually to trigger Eloquent lifecycle hooks & media conversions
        foreach ($socialLinksData as $data) {
            $socialLink = SocialLink::updateOrCreate(
                ['platform_key' => $data['platform_key']],
                $data
            );

            // Optimization: Only make a network call if the logo collection is empty
            // Inside your foreach loop
            if ($socialLink->getMedia('logo')->isEmpty()) {
                $path = storage_path("app/seeders/icons/{$data['platform_key']}.svg");

                if (file_exists($path)) {
                    $socialLink->addMedia($path)
                        ->preservingOriginal() // Keeps the file in storage
                        ->toMediaCollection('logo');
                }
            }
        }
    }
}
