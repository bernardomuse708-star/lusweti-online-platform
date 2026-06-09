<?php

declare(strict_types=1);

use App\Models\Article;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('page_section_items')) {
            return;
        }

        Schema::create('page_section_items', function (Blueprint $table): void {
            $table->id();

            $table->foreignId('page_section_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Article::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('sort_order')
                ->default(0);

            $table->timestamps();

            $table->unique([
                'page_section_id',
                'article_id',
            ]);

            $table->index([
                'page_section_id',
                'sort_order',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_section_items');
    }
};