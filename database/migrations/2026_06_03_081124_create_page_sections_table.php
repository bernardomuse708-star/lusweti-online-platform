<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('page_sections')) {
            return;
        }

        Schema::create('page_sections', function (Blueprint $table): void {
            $table->id();

            $table->foreignId('page_id')
                ->constrained()
                ->nullable()
                ->cascadeOnDelete();

            $table->foreignId('section_type_id')
                ->constrained()
                ->nullable()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Source Configuration
            |--------------------------------------------------------------------------
            */

            $table->enum('content_source', [
                'category',
                'manual_articles',
                'gallery',
                'video',
                'burudani',
            ]);

            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | UI
            |--------------------------------------------------------------------------
            */

            $table->string('title');

            $table->integer('sort_order')
                ->default(0);

            $table->boolean('is_visible')
                ->default(true);

            /*
            |--------------------------------------------------------------------------
            | Dynamic Settings
            |--------------------------------------------------------------------------
            */

            $table->json('settings')
                ->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('page_id')->nullable();
            $table->index('section_type_id');
            $table->index('category_id');

            $table->index('content_source');
            $table->index('sort_order');

            $table->index([
                'page_id',
                'is_visible',
                'sort_order',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};