<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('name')->searchable()->sortable()->weight('bold'),
            TextColumn::make('slug')->color('gray'),
            ToggleColumn::make('is_visible_in_nav')->label('In Nav'),
        ])
        ->actions([ EditAction::make() ]);
}
}
