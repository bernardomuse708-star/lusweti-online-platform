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
        // Schema::create('zanzibar_layout_tables', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->string('bg_color', 7)->default('#F5911E');
                $table->string('text_color', 7)->default('#FFFFFF');
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->index(['is_active', 'slug']);
            });
        }
if (!Schema::hasTable('articles')) {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            // Core structural topic tag override (e.g. showing "Soka" label within "Zanzibar" row)
            $table->string('topic_label')->nullable();

            $table->string('tentacle_id')->unique(); // Natural immutable business key for absolute idempotency
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamp('published_at')->useCurrent();
            $table->timestamps();

            // Covered composite index matching front-end component streaming criteria
            $table->index(['category_id', 'published_at', 'id'], 'idx_grid_teaser_streaming_optim');
        });
}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('zanzibar_layout_tables');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('categories');
    }
};
