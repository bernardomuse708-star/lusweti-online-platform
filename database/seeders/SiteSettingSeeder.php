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
            ]
        ], ['key'], ['value', 'updated_at']);
    }
}
