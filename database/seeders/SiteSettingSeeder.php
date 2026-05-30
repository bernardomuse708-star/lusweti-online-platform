<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        // High-performance atomic upsert operation
        SiteSetting::upsert([
            [
                'key' => 'page_tagline',
                'value' => 'Kata kiu ya michezo na burudani',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'site_header_logo',
                'value' => 'resource/crblob/4351492/5c3d71953e078c66977c4abdce89ec1e/ms-logo-svg-data.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'site_header_logo_alt',
                'value' => 'Mwanaspoti',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ], ['key'], ['value', 'updated_at']);

        // Attach logo using Media Library
        $siteSetting = SiteSetting::where('key', 'site_header_logo')->first();
        if ($siteSetting && $siteSetting->getMedia('site_logo')->isEmpty()) {
            // Try to use the existing logo file if it exists
            $logoPath = public_path('resource/crblob/4351492/5c3d71953e078c66977c4abdce89ec1e/ms-logo-svg-data.svg');

            if (file_exists($logoPath)) {
                try {
                    $siteSetting->addMedia($logoPath)
                        ->preservingOriginal()
                        ->toMediaCollection('site_logo');
                    $this->command->info("Successfully attached logo to SiteSetting");
                } catch (\Exception $e) {
                    $this->command->error("Failed to attach logo: " . $e->getMessage());
                }
            } else {
                // Use dummy image as fallback
                $dummyLogoPath = public_path('storage/seeds/article-soka.jpg');
                if (file_exists($dummyLogoPath)) {
                    try {
                        $siteSetting->addMedia($dummyLogoPath)
                            ->preservingOriginal()
                            ->toMediaCollection('site_logo');
                        $this->command->info("Successfully attached dummy logo to SiteSetting");
                    } catch (\Exception $e) {
                        $this->command->error("Failed to attach dummy logo: " . $e->getMessage());
                    }
                }
            }
        }
    }
}
