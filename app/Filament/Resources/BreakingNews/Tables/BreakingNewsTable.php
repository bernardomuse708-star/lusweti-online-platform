<?php

namespace App\Filament\Resources\BreakingNews\Tables;

use App\Events\BreakingNewsUpdated;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BreakingNewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title')->limit(100)->searchable(),
                TextColumn::make('url')->limit(30),
                IconColumn::make('is_live')->boolean(),
                IconColumn::make('is_active')->boolean(),

                TextColumn::make('priority')->sortable(),

                TextColumn::make('expires_at')->since(),
            ])
            ->defaultSort('priority', 'desc')
            ->actions([
                EditAction::make()
                    ->after(fn() => broadcast(new BreakingNewsUpdated())),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->after(fn() => broadcast(new BreakingNewsUpdated())),
                ]),
            ]);

        // ->actions([
        //     EditAction::make(),
        //     DeleteAction::make(),
        // ]);
    }
}
