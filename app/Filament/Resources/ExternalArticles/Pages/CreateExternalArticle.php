<?php

namespace App\Filament\Resources\ExternalArticles\Pages;

use App\Filament\Resources\ExternalArticles\ExternalArticleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateExternalArticle extends CreateRecord
{
    protected static string $resource = ExternalArticleResource::class;
}
