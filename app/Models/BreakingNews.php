<?php

namespace App\Models;

use App\Events\BreakingNewsUpdated;
use Illuminate\Database\Eloquent\Model;
use App\Services\HeadlineAiService;


class BreakingNews extends Model
{
    // App\Models\BreakingNews.php

    protected $fillable = [
        'title',
        'url',
        'is_active',
        'is_live',
        'is_urgent', // Add this
        'expires_at',
        'priority',
        'ai_score',  // Add this if you want to manual override or seed it
    ];

    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }


    public function getDisplayTitleAttribute()
    {
        return $this->ai_title ?: $this->title;
    }


    public function getImageUrlAttribute()
    {
        return asset($this->image_path);
    }

    public function updateScore()
    {
        $this->ai_score =
            ($this->views * 0.3) +
            ($this->clicks * 0.6) +
            ($this->is_urgent ? 100 : 0) +
            (now()->diffInMinutes($this->created_at) < 10 ? 50 : 0);

        $this->saveQuietly();
    }

    protected static function booted(): void
    {
        static::created(function () {
            try {
                event(new BreakingNewsUpdated());
            } catch (\Exception $e) {
                report($e);
            }
        });

        static::updated(function () {
            try {
                event(new BreakingNewsUpdated());
            } catch (\Exception $e) {
                report($e);
            }
        });

        static::deleted(function () {
            try {
                event(new BreakingNewsUpdated());
            } catch (\Exception $e) {
                report($e);
            }
        });

        static::created(function ($item) {
            // Queue AI processing to avoid blocking saves
            dispatch(function () use ($item) {
                try {
                    $ai = app(HeadlineAiService::class);

                    $item->updateQuietly([
                        'original_title' => $item->title,
                        'ai_title' => $ai->rewrite($item->title),
                    ]);
                } catch (\Exception $e) {
                    report($e);
                }
            })->delay(now()->addSeconds(1));
        });
    }
}
