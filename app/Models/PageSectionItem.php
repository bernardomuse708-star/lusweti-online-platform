<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSectionItem extends Model
{
    protected $fillable = [
        'page_section_id',
        'article_id',
        'sort_order',
    ];

    public function pageSection(): BelongsTo
    {
        return $this->belongsTo(
            PageSection::class
        );
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(
            Article::class
        );
    }
}