<?php

namespace App\Filament\Resources\ExternalArticles\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExternalArticlesTable
{
    
public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('title')->searchable()->limit(50)->weight('bold'),
            TextColumn::make('external_url')->url(fn($record) => $record->external_url, true)->color('primary')->limit(30),
            TextColumn::make('category.name')->badge(),
        ])
        ->actions([ EditAction::make() ]);
}
}
