<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('layout_style')->badge(),
                IconColumn::make('is_prime')->boolean()->label('PRIME'),
                TextColumn::make('display_layout')->badge(),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('category.name')->sortable(),
                TextColumn::make('layout_type'),
                TextColumn::make('display_style'),
                TextColumn::make('topic_label')->label('Display Topic'),
                IconColumn::make('is_featured_in_row')->boolean(),
                TextColumn::make('published_at')->dateTime()->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                SelectFilter::make('category')->relationship('category', 'name'),
            ])
            ->actions([
                EditAction::make()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
