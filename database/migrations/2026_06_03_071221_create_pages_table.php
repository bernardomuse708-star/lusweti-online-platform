<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pages')) {
            return;
        }

        Schema::create('pages', function (Blueprint $table): void {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->longText('description')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Hero Banner
            |--------------------------------------------------------------------------
            */

            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();

            $table->string('hero_button_text')->nullable();
            $table->string('hero_button_url')->nullable();

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Publishing Workflow
            |--------------------------------------------------------------------------
            */

            
            $table->enum('status', [
                'draft',
                'scheduled',
                'published',
                'archived',
            ])->default('draft');

            /*
            |--------------------------------------------------------------------------
            | Preview
            |--------------------------------------------------------------------------
            */

            $table->uuid('preview_token')
                ->nullable()
                ->unique();
            $table->timestamp('published_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Performance Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('slug');
            $table->index([
                'status',
                'published_at',
            ]);

            $table->index('published_at');

            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
