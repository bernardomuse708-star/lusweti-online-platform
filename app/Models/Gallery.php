<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'tentacle_id',
        'title',
        'slug',
        'image_path',
        'published_at',
        'is_visible'
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope query method providing a clean, thread-safe timeline lookup stream
     */
    public function scopePublishedStream(Builder $query, int $categoryId): void
    {
        $query->where('category_id', $categoryId)
            ->where('is_visible', true)
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }
}