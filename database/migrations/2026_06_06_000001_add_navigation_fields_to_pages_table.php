<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table): void {
            $table->boolean('is_visible_in_nav')->default(true)->after('status');
            $table->integer('sort_order')->default(0)->after('is_visible_in_nav');
            $table->index('is_visible_in_nav');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table): void {
            $table->dropIndex(['is_visible_in_nav']);
            $table->dropIndex(['sort_order']);
            $table->dropColumn(['is_visible_in_nav', 'sort_order']);
        });
    }
};
