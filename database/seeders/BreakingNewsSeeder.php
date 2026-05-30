<?php

namespace Database\Seeders;

use App\Models\BreakingNews;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BreakingNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $breakingNews = BreakingNews::updateOrCreate(
            ['id' => 1],
            [
                'title' => '🚨 Major event just happened... ✨ ⚡ 🚀 Andabwa (OGW) Lugari Contituency MP 2027 LIVE',
                'is_active' => true,
                'is_live' => true,
                'url' => '#',
            ]
        );

        // Add featured image using Media Library
        $filename = 'article-soka.jpg';
        $sourcePath = public_path('storage' . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . $filename);

        if ($breakingNews->getMedia('featured_image')->isEmpty()) {
            if (file_exists($sourcePath)) {
                try {
                    $breakingNews->addMedia($sourcePath)
                        ->preservingOriginal()
                        ->toMediaCollection('featured_image');
                    $this->command->info("Successfully attached media to BreakingNews");
                } catch (\Exception $e) {
                    $this->command->error("Failed to attach media to BreakingNews: " . $e->getMessage());
                }
            } else {
                // Try alternative path
                $altPath = public_path('seeds' . DIRECTORY_SEPARATOR . $filename);
                if (file_exists($altPath)) {
                    try {
                        $breakingNews->addMedia($altPath)
                            ->preservingOriginal()
                            ->toMediaCollection('featured_image');
                        $this->command->info("Successfully attached media to BreakingNews");
                    } catch (\Exception $e) {
                        $this->command->error("Failed to attach media to BreakingNews: " . $e->getMessage());
                    }
                } else {
                    $this->command->warn("BreakingNews media file not found at: {$sourcePath} or {$altPath}");
                }
            }
        }
    }
}
