<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FooterMetaLink;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GlobalFooterComponentsSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // 1. Seed Dynamic Taxonomy Elements Index Map
        $categories = [
            ['name' => 'Soka', 'slug' => 'soka', 'is_visible_in_footer' => true, 'sort_weight' => 10, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Burudani', 'slug' => 'burudani', 'is_visible_in_footer' => true, 'sort_weight' => 20, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kolamu', 'slug' => 'kolamu', 'is_visible_in_footer' => true, 'sort_weight' => 30, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Spoti Majuu', 'slug' => 'spoti-majuu', 'is_visible_in_footer' => true, 'sort_weight' => 40, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Spoti Kenya', 'slug' => 'spoti-kenya', 'is_visible_in_footer' => true, 'sort_weight' => 50, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mafumbo', 'slug' => 'mafumbo', 'is_visible_in_footer' => true, 'sort_weight' => 60, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Hadithi', 'slug' => 'hadithi', 'is_visible_in_footer' => true, 'sort_weight' => 70, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Video', 'slug' => 'video', 'is_visible_in_footer' => true, 'sort_weight' => 80, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Picha', 'slug' => 'picha', 'is_visible_in_footer' => true, 'sort_weight' => 90, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
        ];
        Category::upsert($categories, ['slug'], ['name', 'is_visible_in_footer', 'sort_weight', 'is_active', 'updated_at']);

        // 2. Seed Compliance Links & External Portals
        $metaLinks = [
            ['system_key' => 'contact_us', 'title' => 'Contact us', 'url' => 'https://mcl.co.tz/#contact', 'open_in_new_tab' => true, 'sort_weight' => 1, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['system_key' => 'webmail', 'title' => 'Webmail', 'url' => 'http://tzwebmail2.tz.nationmedia.com:9090/owa', 'open_in_new_tab' => true, 'sort_weight' => 2, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['system_key' => 'mwanaclick', 'title' => 'MwanaClick', 'url' => 'https://mwanaclick.com', 'open_in_new_tab' => true, 'sort_weight' => 3, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['system_key' => 'faq', 'title' => 'Frequently asked questions', 'url' => 'https://nation.africa/kenya/frequently-asked-questions-303716', 'open_in_new_tab' => true, 'sort_weight' => 4, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['system_key' => 'privacy_policy', 'title' => 'NMG Privacy Policy', 'url' => 'https://nation.africa/kenya/nmg-privacy-policy-303724', 'open_in_new_tab' => true, 'sort_weight' => 5, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['system_key' => 'terms_of_use', 'title' => 'Terms of use', 'url' => 'https://nation.africa/kenya/terms-of-use-303726', 'open_in_new_tab' => true, 'sort_weight' => 6, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['system_key' => 'terms_conditions', 'title' => 'Terms and Conditions of Use', 'url' => 'https://nation.africa/kenya/terms-and-conditions', 'open_in_new_tab' => true, 'sort_weight' => 7, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['system_key' => 'blog_rules', 'title' => 'Our Blog Rules', 'url' => 'https://nation.africa/kenya/our-blog-rules-549010', 'open_in_new_tab' => true, 'sort_weight' => 8, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
        ];
        FooterMetaLink::upsert($metaLinks, ['system_key'], ['title', 'url', 'open_in_new_tab', 'sort_weight', 'is_active', 'updated_at']);
    }
}