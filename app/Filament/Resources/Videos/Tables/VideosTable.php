<?php

namespace App\Filament\Resources\Videos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class VideosTable
{
   public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('title')->searchable()->weight('bold'),
            TextColumn::make('category.name')->badge()->color('warning'),
            TextColumn::make('youtube_id')
                ->label('Source')
                ->formatStateUsing(fn ($state) => $state ? 'YouTube' : 'Local File')
                ->badge()
                ->color(fn ($state) => $state ? 'danger' : 'success'),
            ToggleColumn::make('is_visible'),
            TextColumn::make('published_at')->dateTime()->sortable(),
        ])
        ->actions([ EditAction::make() ]);
}
}
