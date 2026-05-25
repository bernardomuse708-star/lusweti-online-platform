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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('bg_color', 7)->default('#F5911E');
            $table->string('text_color', 7)->default('#FFFFFF');
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_visible_in_nav')->default(true)->index();
            $table->boolean('is_visible_in_footer')->default(true)->index();
            $table->integer('sort_order')->default(0)->index();
            $table->integer('sort_weight')->default(100)->index(); // sort_weight
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
