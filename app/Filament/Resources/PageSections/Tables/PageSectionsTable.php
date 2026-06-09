<?php

namespace App\Filament\Resources\PageSections\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('sort_order')
                    ->label('#'),

                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('sectionType.name')
                    ->badge(),

                TextColumn::make('content_source')
                    ->badge(),

                IconColumn::make('is_visible')
                    ->boolean(),


            ])
            // ->actions([
            //     Action::make('preview')
            //         ->icon('heroicon-o-eye')
            //         ->url(fn($record) => route(
            //             'pages.preview',
            //             $record->preview_token
            //         ))
            //         ->openUrlInNewTab()
            // ])
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
            ])

            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->recordTitleAttribute('title')
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
