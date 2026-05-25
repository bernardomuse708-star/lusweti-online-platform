<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Check if categories exists before creating it
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->string('bg_color', 7)->default('#F5911E');
                $table->string('text_color', 7)->default('#FFFFFF');
                $table->boolean('is_active')->default(true)->index();
                $table->timestamps();
            });
        }

        // Check if articles exists before creating it
        if (!Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                // We assume 'categories' table exists globally now
                $table->foreignId('category_id')->constrained()->cascadeOnDelete();
                $table->string('tentacle_id')->unique();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('summary')->nullable();
                $table->string('image_path')->nullable();
                $table->enum('display_style', ['large', 'thumbnail-left', 'text-only'])->default('text-only');
                $table->timestamp('published_at')->useCurrent();
                $table->timestamps();

                $table->index(['category_id', 'published_at', 'id'], 'idx_hadithi_stream_optimization');
            });
        }
    }

    public function down(): void
    {
        // Only drop if you want this specific migration to be completely reversible
        // WARNING: This will delete the data in these tables
        Schema::dropIfExists('articles');
        Schema::dropIfExists('categories');
    }
};