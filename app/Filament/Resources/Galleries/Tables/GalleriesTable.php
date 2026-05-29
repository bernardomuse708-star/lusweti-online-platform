<?php

namespace App\Filament\Resources\Galleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn; // Specialized Spatie Column Engine
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([SpatieMediaLibraryImageColumn::make('cover')->collection('cover')->square(),
            TextColumn::make('title')->searchable()->weight('bold'),
            TextColumn::make('category.name')->badge(),
            ToggleColumn::make('is_visible')->label('Visible'),
            TextColumn::make('published_at')->date()->sortable(),
        ])
        ->actions([    EditAction::make() ]);
    }
}