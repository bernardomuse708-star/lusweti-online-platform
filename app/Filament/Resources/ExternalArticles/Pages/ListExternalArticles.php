<?php

namespace App\Filament\Resources\ExternalArticles\Pages;

use App\Filament\Resources\ExternalArticles\ExternalArticleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExternalArticles extends ListRecords
{
    protected static string $resource = ExternalArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
