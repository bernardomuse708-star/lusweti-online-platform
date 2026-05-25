<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('categories')) {
            // 1. Core Category Schema (Shared layout taxonomy routing matrix)
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->boolean('is_visible_in_footer')->default(true);
                $table->unsignedInteger('sort_weight')->default(100);
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->index(['is_active', 'is_visible_in_footer', 'sort_weight', 'id'], 'idx_footer_categories_streaming');
            });
        }


        if (!Schema::hasTable('footer_meta_links')) {

            // 2. Footer Meta Utilities & Compliance Links Schema
            Schema::create('footer_meta_links', function (Blueprint $table) {
                $table->id();
                $table->string('system_key')->unique(); // Natural immutable business identifier for pure idempotency
                $table->string('title');
                $table->string('url');
                $table->boolean('open_in_new_tab')->default(true);
                $table->unsignedInteger('sort_weight')->default(100);
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->index(['is_active', 'sort_weight', 'id'], 'idx_footer_meta_links_streaming');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_meta_links');
        Schema::dropIfExists('categories');
    }
};
