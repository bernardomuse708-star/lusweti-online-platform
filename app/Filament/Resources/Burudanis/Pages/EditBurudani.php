<?php

namespace App\Filament\Resources\Burudanis\Pages;

use App\Filament\Resources\Burudanis\BurudaniResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBurudani extends EditRecord
{
    protected static string $resource = BurudaniResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
