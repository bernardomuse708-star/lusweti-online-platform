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
        // Schema::create('picha_layout_tables', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
if (!Schema::hasTable('categories')) {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('bg_color', 7)->default('#F5911E'); // Dynamic visual configuration hex code
            $table->string('text_color', 7)->default('#FFFFFF');
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
}
if (!Schema::hasTable('galleries')) {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('tentacle_id')->unique(); // Hard natural invariant business key for absolute idempotency
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image_path')->nullable();
            $table->timestamp('published_at')->useCurrent();
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            // Covered composite index tailored for high-speed chronological streaming allocations
            $table->index(['category_id', 'is_visible', 'published_at', 'id'], 'idx_picha_stream_performance');
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('categories');
        // Schema::dropIfExists('picha_layout_tables');
    }
};
