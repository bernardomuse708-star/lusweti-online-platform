<?php

namespace App\Filament\Resources\Burudanis\Pages;

use App\Filament\Resources\Burudanis\BurudaniResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBurudanis extends ListRecords
{
    protected static string $resource = BurudaniResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
