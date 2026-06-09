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
                'brand_name'        => 'Lusweti',
                'brand_short'       => 'CL',
                'brand_description' => 'Premium sports stories, breaking updates, entertainment and exclusive reports from East Africa and beyond.',
                'copyright_text'    => 'Lusweti Media. All rights reserved.',
                'sections_title'    => 'Sections',
                'information_title' => 'Information',
                // 'footer_decoration' => 'resource/crblob/4367644/a26213978044efb02abdc086cd487b55/footer-decoration-ms-svg-data.svg',
            ]
        );

       
    }
}
