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
if (!Schema::hasTable('articles')) {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('tentacle_id')->unique(); // Hard natural invariant unique key for pure idempotency
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->string('image_path')->nullable();

            // Layout Distribution Matrix Engine
            $table->enum('layout_style', ['featured-large', 'thumbnail-right', 'text-only'])->default('text-only');

            $table->boolean('is_prime')->default(false)->index();
            $table->timestamp('published_at')->useCurrent();
            $table->timestamps();

            // Covering composite index tailored for high-speed timeline streaming allocations
            $table->index(['category_id', 'published_at', 'id'], 'idx_spotimajuu_feed_streaming');
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('categories');
        // Schema::dropIfExists('spoti_majuu_layout_tables');
    }
};
