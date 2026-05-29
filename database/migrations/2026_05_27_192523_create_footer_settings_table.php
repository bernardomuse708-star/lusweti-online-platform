<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('footer_settings')) {

            Schema::create('footer_settings', function (Blueprint $table) {

                $table->id();

                // BRAND
                $table->string('brand_name')->default('Mwanaspoti');
                $table->string('brand_short')->default('MS');

                $table->text('brand_description')->nullable();

                $table->string('copyright_text')
                    ->default('Nation Media Group. All rights reserved.');

                // SECTION HEADERS
                $table->string('sections_title')
                    ->default('Sections');

                $table->string('information_title')
                    ->default('Information');

                // LOGO / DECORATION
                $table->string('footer_decoration')->nullable();

                $table->timestamps();
            });
        }

       if (! Schema::hasTable('social_links')) {

            Schema::create('social_links', function (Blueprint $table) {

                $table->id();

                $table->string('name');

                $table->string('platform_key')->unique();

                $table->string('url');

                $table->string('color_class')
                    ->nullable();

                $table->unsignedInteger('sort_weight')
                    ->default(100);

                $table->boolean('is_active')
                    ->default(true);

                $table->timestamps();

                $table->index([
                    'is_active',
                    'sort_weight',
                    'id',
                ], 'idx_social_links_stream');
            });
        }
        
    }

    public function down(): void
    {
        Schema::dropIfExists('social_links');
        Schema::dropIfExists('footer_settings');
    }
};