<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Stream extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'is_live',
        'livekit_room',
        'description',
        'status',
        'scheduled_for',
    ];


    protected $casts = [
    'scheduled_for' => 'datetime',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function host()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName(): string
    {
        return 'uuid'; // Tells Laravel to look up by UUID column instead of ID
    }

    protected static function booted()
    {
        static::creating(function ($stream) {
            $stream->uuid = (string) Str::uuid();
        });
    }
}
