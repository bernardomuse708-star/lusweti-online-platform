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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable()->unique();
            $table->string('tentacle_id')->nullable()->unique();
            $table->text('description')->nullable();
            $table->string('video_category_id')->nullable();
            $table->string('youtube_id')->unique();
            $table->timestamp('published_at')->useCurrent()->index();
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_visible')->default(true)->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
