<?php

namespace App\Filament\Resources\FooterMetaLinks\Pages;

use App\Filament\Resources\FooterMetaLinks\FooterMetaLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFooterMetaLinks extends ListRecords
{
    protected static string $resource = FooterMetaLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
