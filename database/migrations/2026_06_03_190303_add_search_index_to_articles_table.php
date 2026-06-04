<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Create a performance GIN index matching our weights
        // Title = Weight A, Summary/Description = Weight B, Content = Weight C
        DB::statement("
            CREATE INDEX articles_search_gin_idx ON articles USING gin(
                (
                    setweight(to_tsvector('simple', coalesce(title, '')), 'A') ||
                    setweight(to_tsvector('simple', coalesce(summary, '')), 'B') ||
                    setweight(to_tsvector('simple', coalesce(content, '')), 'C')
                )
            );
        ");
    }

    public function down(): void
    {
        DB::statement('DROP INDEX articles_search_gin_idx;');
    }
};
