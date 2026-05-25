<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['headline', 'slug', 'url', 'is_breaking'];

    protected $casts = [
        'is_breaking' => 'boolean',
    ];
}