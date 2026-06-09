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
        Schema::create('burudanis', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable(); // For the featured article paragraph
            $table->string('image_url')->nullable(); // For the featured article image
            $table->string('topic')->default('Soka');
            $table->boolean('is_prime')->default(false); // For the 'PRIME' badge
            $table->boolean('is_featured')->default(false); // To separate the big layout from the list
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('burudanis');
    }
};
