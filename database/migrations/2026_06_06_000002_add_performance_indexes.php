<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Articles performance indexes
        Schema::table('articles', function (Blueprint $table) {
            $table->index(['category_id', 'is_visible', 'published_at', 'id'], 'articles_category_published_index');
            $table->index(['is_featured_in_row', 'published_at'], 'articles_featured_index');
            $table->index(['layout_style', 'category_id'], 'articles_layout_index');
        });

        // Categories performance indexes
        Schema::table('categories', function (Blueprint $table) {
            $table->index(['slug', 'is_active'], 'categories_slug_active_index');
            $table->index(['is_active', 'sort_order'], 'categories_active_sort_index');
        });

        // Page sections performance indexes
        Schema::table('page_sections', function (Blueprint $table) {
            $table->index(['page_id', 'sort_order'], 'page_sections_page_sort_index');
            $table->index(['section_type_id', 'is_visible'], 'page_sections_type_visible_index');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex('articles_category_published_index');
            $table->dropIndex('articles_featured_index');
            $table->dropIndex('articles_layout_index');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex('categories_slug_active_index');
            $table->dropIndex('categories_active_sort_index');
        });

        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropIndex('page_sections_page_sort_index');
            $table->dropIndex('page_sections_type_visible_index');
        });
    }
};
