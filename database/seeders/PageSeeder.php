<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'nyumbani',
                'title' => 'Nyumbani',
                'status' => 'published',
                'is_visible_in_nav' => true,
                'sort_order' => 1,
            ],
            [
                'slug' => 'burudani',
                'title' => 'Burudani',
                'status' => 'published',
                'is_visible_in_nav' => true,
                'sort_order' => 2,
            ],
            [
                'slug' => 'siasa',
                'title' => 'Siasa',
                'status' => 'published',
                'is_visible_in_nav' => true,
                'sort_order' => 3,
            ],
            [
                'slug' => 'biashara',
                'title' => 'Biashara',
                'status' => 'published',
                'is_visible_in_nav' => true,
                'sort_order' => 4,
            ],
            [
                'slug' => 'michezo',
                'title' => 'Michezo',
                'status' => 'published',
                'is_visible_in_nav' => true,
                'sort_order' => 5,
            ],
            [
                'slug' => 'afya',
                'title' => 'Afya',
                'status' => 'published',
                'is_visible_in_nav' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
