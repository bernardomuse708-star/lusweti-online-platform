<?php
// app/Services/HeadlineAIService.php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PageCacheService
{

    public static function remember($page)
    {
        return Cache::remember("page:{$page->id}", 3600, function () use ($page) {

                return $page->load([
                    'sections.sectionType',
                    'sections.category',
                    'sections.items.article',
                ]);
            });
    }

    public static function flush($pageId)
    {
        Cache::forget("page:{$pageId}");
    }
}
