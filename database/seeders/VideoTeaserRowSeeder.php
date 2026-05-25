<?php

namespace Database\Seeders;

use App\Models\VideoCategory;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VideoTeaserRowSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Core structural parent initialization mapping identity
        $category = VideoCategory::updateOrCreate(
            ['slug' => 'video'],
            ['name' => 'Videos', 'bg_color' => '#F5911E', 'text_color' => '#FFFFFF', 'is_active' => true]
        );

        $targetTime = now();

        // 2. High-speed atomic compilation matrix mapped directly to provided source tracking keys
        Video::upsert([
            [
                'video_category_id' => $category->id,
                'tentacle_id'       => '5469062-4f',
                'title'             => 'Kisugu awapongeza wachezaji wa Simba',
                'slug'              => Str::slug('Kisugu awapongeza wachezaji wa Simba'),
                'youtube_id'        => 'rAkZb6HUP8g',
                'published_at'      => $targetTime,
                'created_at'        => $targetTime,
                'updated_at'        => $targetTime,
            ],
            [
                'video_category_id' => $category->id,
                'tentacle_id'       => '5469078-50',
                'title'             => 'Ferdinand balozi mpya wa utalii Tanzania',
                'slug'              => Str::slug('Ferdinand balozi mpya wa utalii Tanzania'),
                'youtube_id'        => 'Mt_00HKyomA',
                'published_at'      => $targetTime->subMinutes(5),
                'created_at'        => $targetTime,
                'updated_at'        => $targetTime,
            ],
            [
                'video_category_id' => $category->id,
                'tentacle_id'       => '5469076-51',
                'title'             => 'Haya hapa mapokezi ya Rio Ferdinand Arusha',
                'slug'              => Str::slug('Haya hapa mapokezi ya Rio Ferdinand Arusha'),
                'youtube_id'        => 'A50VhWx2oY0',
                'published_at'      => $targetTime->subMinutes(10),
                'created_at'        => $targetTime,
                'updated_at'        => $targetTime,
            ],
            [
                'video_category_id' => $category->id,
                'tentacle_id'       => '5469074-52',
                'title'             => 'Chobwedo aibukia Airport Arusha kumpokea Rio Ferdinand staa Manchester United',
                'slug'              => Str::slug('Chobwedo aibukia Airport Arusha kumpokea Rio Ferdinand staa Manchester United'),
                'youtube_id'        => 'nIpu1NoKbqM',
                'published_at'      => $targetTime->subMinutes(15),
                'created_at'        => $targetTime,
                'updated_at'        => $targetTime,
            ],
        ], ['tentacle_id'], ['title', 'slug', 'youtube_id', 'published_at', 'updated_at']);
    }
}