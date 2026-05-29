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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('tentacle_id')->unique();
            $table->string('topic_label')->nullable(); // Added missing structural display column
            $table->string('title');
            $table->text('summary')->nullable();
            $table->string('external_url')->nullable();
            $table->string('display_style')->nullable();
            $table->longText('content')->nullable();
            $table->string('layout_style')->nullable();
            $table->string('layout_type')->default('teaser-image-none'); // large, none, right, text
            $table->string('image_path')->nullable(); // Retained for legacy accessor backwards compatibility
            $table->string('display_layout')->nullable();
            $table->boolean('is_featured_in_row')->nullable();
            $table->boolean('is_prime')->default(false)->index();
            $table->timestamp('published_at')->useCurrent()->index();
            $table->timestamps();

            // Compound index optimizes concurrent index sorting scans
            $table->index(['published_at', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};