<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class PageVersion extends Model
{


    protected $fillable = [
        'page_id',
        'snapshot',
        'created_by',
    ];

    protected $casts = [
        'snapshot' => 'array',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
    protected static function booted(): void
    {

        static::updating(function ($page) {

            PageVersion::create([
                'page_id' => $page->id,
                'snapshot' => $page->toArray(),
                'created_by' => Auth::id(),
            ]);
        });
    }
}
