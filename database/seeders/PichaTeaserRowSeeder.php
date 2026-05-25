<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PichaTeaserRowSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Idempotent validation/lookup for parent styling configuration context
        $category = Category::updateOrCreate(
            ['slug' => 'picha'],
            ['name' => 'Picha', 'bg_color' => '#F5911E', 'text_color' => '#FFFFFF', 'is_active' => true]
        );

        $now = now();

        // 2. High-speed atomic data payload compilation mapped directly to your markup entities
        Gallery::upsert([
            [
                'category_id'  => $category->id,
                'tentacle_id'  => '5467648-81',
                'title'        => 'Rio Ferdinand avutiwa na utalii wa Serengeti',
                'slug'         => Str::slug('Rio Ferdinand avutiwa na utalii wa Serengeti'),
                'image_path'   => '/resource/image/5467650/landscape_ratio3x2/300/200/145f8510d7fc5603b0f6decc72b99665/JF/rio-pc.jpg',
                'published_at' => Carbon::create(2026, 5, 21, 14, 0, 0),
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'category_id'  => $category->id,
                'tentacle_id'  => '5465104-82',
                'title'        => 'Rio Ferdinand atua nchini, mamia wampokea',
                'slug'         => Str::slug('Rio Ferdinand atua nchini mamia wampokea'),
                'image_path'   => '/resource/image/5465106/landscape_ratio3x2/300/200/85a846865dee62f193b53c75fda8f465/NB/rio-pc.jpg',
                'published_at' => Carbon::create(2026, 5, 19, 11, 30, 0),
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'category_id'  => $category->id,
                'tentacle_id'  => '5455798-83',
                'title'        => 'Namna Barcelona ilivyoshangilia ubingwa wa 29 La Liga',
                'slug'         => Str::slug('Namna Barcelona ilivyoshangilia ubingwa wa 29 La Liga'),
                'image_path'   => '/resource/image/5455810/landscape_ratio3x2/300/200/4500ea463392d62d71838bb0f5f65a33/qs/barca-pc.jpg',
                'published_at' => Carbon::create(2026, 5, 12, 18, 45, 0),
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'category_id'  => $category->id,
                'tentacle_id'  => '5352936-84',
                'title'        => 'MKAPA',
                'slug'         => Str::slug('MKAPA'),
                'image_path'   => '/resource/blob/5352938/ac4bf6a14a8d54e9a7f847e1b6f4eaa6/mka-01-data.png',
                'published_at' => Carbon::create(2026, 2, 9, 10, 15, 0),
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
        ], ['tentacle_id'], ['title', 'slug', 'image_path', 'published_at', 'updated_at']);
    }
}