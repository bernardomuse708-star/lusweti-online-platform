<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class NavigationSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // 1. Prepare raw array data for ultra-fast single bulk insert
        $categories = [
            ['name' => 'Soka', 'slug' => 'soka', 'sort_order' => 1, 'is_visible_in_nav' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Burudani', 'slug' => 'burudani', 'sort_order' => 2, 'is_visible_in_nav' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kolamu', 'slug' => 'kolamu', 'sort_order' => 3, 'is_visible_in_nav' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Spoti Majuu', 'slug' => 'spoti-majuu', 'sort_order' => 4, 'is_visible_in_nav' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Spoti Kenya', 'slug' => 'spoti-kenya', 'sort_order' => 5, 'is_visible_in_nav' => false, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mafumbo', 'slug' => 'mafumbo', 'sort_order' => 6, 'is_visible_in_nav' => false, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hadithi', 'slug' => 'hadithi', 'sort_order' => 7, 'is_visible_in_nav' => false, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Video', 'slug' => 'video', 'sort_order' => 8, 'is_visible_in_nav' => false, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Picha', 'slug' => 'picha', 'sort_order' => 9, 'is_visible_in_nav' => false, 'created_at' => $now, 'updated_at' => $now],
        ];

        // Executes exactly 1 INSERT query instead of 9
        Category::insert($categories);

        // Seed a default baseline Breaking News alert
        News::create([
            'headline' => 'Taifa Stars Yafuzu Michuano ya AFCON!',
            'slug' => Str::slug('Taifa Stars Yafuzu Michuano ya AFCON'),
            'url' => '/ms/soka/taifa-stars-yafuzu',
            'is_breaking' => true,
        ]);

        // 2. Clear out any stale navigation cache immediately
        Cache::forget('header-navigation-categories');
    }
}
