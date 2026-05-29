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
        Schema::create('breaking_news', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('url')->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('is_live')->default(false);

            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_urgent')->default(false);
            $table->integer('priority')->default(0); // replaces ai_score
            $table->integer('views')->default(0);
            $table->integer('clicks')->default(0);
            $table->float('ai_score')->default(0);


            $table->text('original_title')->nullable();
            $table->text('ai_title')->nullable();
            $table->float('ctr_score')->default(0);
            $table->json('variants')->nullable(); // A/B testing


            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->boolean('is_global')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breaking_news');
    }
};
