<?php

namespace App\Filament\Resources\ExternalArticles\Pages;

use App\Filament\Resources\ExternalArticles\ExternalArticleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExternalArticle extends EditRecord
{
    protected static string $resource = ExternalArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
