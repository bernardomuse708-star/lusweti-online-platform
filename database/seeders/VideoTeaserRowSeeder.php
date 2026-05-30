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
            // Local video example (without youtube_id)
            [
                'video_category_id' => $category->id,
                'tentacle_id'       => '5469075-53',
                'title'             => 'Local Video: Highlights from the match',
                'slug'              => Str::slug('Local Video: Highlights from the match'),
                'youtube_id'        => null,
                'published_at'      => $targetTime->subMinutes(20),
                'created_at'        => $targetTime,
                'updated_at'        => $targetTime,
            ],
        ], ['tentacle_id'], ['title', 'slug', 'youtube_id', 'published_at', 'updated_at']);

        // Add thumbnails and local video clip to videos using Media Library
        $videos = Video::all();
        $thumbnailImage = 'article-soka.jpg';
        $thumbnailPath = public_path('storage' . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . $thumbnailImage);

        // Path to a sample local MP4 from storage
        $localVideoPath = public_path('storage' . DIRECTORY_SEPARATOR . '1' . DIRECTORY_SEPARATOR . '01KSQTCDQBKT92ZGA30H7XCY0P.mp4');

        foreach ($videos as $video) {
            // Attach thumbnail to all videos
            if ($video->getMedia('video_thumbnail')->isEmpty()) {
                if (file_exists($thumbnailPath)) {
                    try {
                        $video->addMedia($thumbnailPath)
                            ->preservingOriginal()
                            ->toMediaCollection('video_thumbnail');
                        $this->command->info("Successfully attached thumbnail to: \"{$video->title}\"");
                    } catch (\Exception $e) {
                        $this->command->error("Failed to attach thumbnail to video: " . $e->getMessage());
                    }
                } else {
                    // Try alternative path
                    $altPath = public_path('seeds' . DIRECTORY_SEPARATOR . $thumbnailImage);
                    if (file_exists($altPath)) {
                        try {
                            $video->addMedia($altPath)
                                ->preservingOriginal()
                                ->toMediaCollection('video_thumbnail');
                            $this->command->info("Successfully attached thumbnail to: \"{$video->title}\"");
                        } catch (\Exception $e) {
                            $this->command->error("Failed to attach thumbnail to video: " . $e->getMessage());
                        }
                    }
                }
            }

            // Attach local MP4 to local video entries (those without youtube_id)
            if (!$video->youtube_id && $video->getMedia('clip_payload')->isEmpty()) {
                if (file_exists($localVideoPath)) {
                    try {
                        $video->addMedia($localVideoPath)
                            ->preservingOriginal()
                            ->toMediaCollection('clip_payload');
                        $this->command->info("Successfully attached local video clip to: \"{$video->title}\"");
                    } catch (\Exception $e) {
                        $this->command->error("Failed to attach local video clip: " . $e->getMessage());
                    }
                } else {
                    $this->command->warn("Local video file not found at: {$localVideoPath}");
                }
            }
        }
    }
}