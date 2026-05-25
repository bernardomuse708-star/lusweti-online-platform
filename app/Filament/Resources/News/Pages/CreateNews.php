<?php

namespace App\Filament\Resources\News\Pages;

use App\Events\BreakingNewsPublished;
use App\Filament\Resources\News\NewsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;
    protected function afterCreate(): void
    {
        if ($this->record->is_breaking) {
            event(new BreakingNewsPublished($this->record->headline, $this->record->url));
        }
    }
}
