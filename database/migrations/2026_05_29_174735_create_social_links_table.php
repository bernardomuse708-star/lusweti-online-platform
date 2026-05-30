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
        // Schema::create('social_links', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name')->unique();
        //     $table->string('color_class')->nullable();
        //     $table->string('platform_key')->unique();
        //     $table->string('slug')->unique();
        //     $table->string('url')->nullable()->after('slug');
        //     $table->boolean('is_visible')->default(true);
        //     $table->unsignedInteger('sort_weight')->default(100);
        //     $table->boolean('is_active')->default(true);
        //     $table->timestamps();
        // });

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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_links');
    }
};
