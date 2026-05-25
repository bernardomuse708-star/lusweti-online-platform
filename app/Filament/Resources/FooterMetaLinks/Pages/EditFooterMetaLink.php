<?php

namespace App\Filament\Resources\FooterMetaLinks\Pages;

use App\Filament\Resources\FooterMetaLinks\FooterMetaLinkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFooterMetaLink extends EditRecord
{
    protected static string $resource = FooterMetaLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
