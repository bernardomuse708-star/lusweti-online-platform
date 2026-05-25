<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('categories')) {
        Schema::create('video_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('bg_color', 7)->default('#F5911E');
            $table->string('text_color', 7)->default('#FFFFFF');
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });}

        if (!Schema::hasTable('videos')) {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_category_id')->constrained()->cascadeOnDelete();
            $table->string('tentacle_id')->unique(); // Natural immutable business identifier for pure idempotency
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('youtube_id', 11)->index(); // Extracted explicitly for responsive player rendering
            $table->timestamp('published_at')->useCurrent();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            // Covered composite index: executes instantaneous chronologically sorted streams bypass table spaces
            $table->index(['video_category_id', 'is_visible', 'published_at', 'id'], 'idx_video_stream_performance');
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('video_teaser_tables');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('video_categories');
    }
};
