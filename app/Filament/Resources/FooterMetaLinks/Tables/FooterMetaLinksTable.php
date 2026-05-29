<?php

namespace App\Filament\Resources\FooterMetaLinks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Support\Facades\Cache;
use Filament\Tables\Table;

class FooterMetaLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Table
                TextColumn::make('title')->searchable()->weight('bold'),
                TextColumn::make('system_key')->fontFamily('mono')->color('gray'),
                TextInputColumn::make('sort_weight')->sortable(), // Allows inline sorting!
                ToggleColumn::make('is_active'),
            ])
            ->defaultSort('sort_weight', 'asc')
            ->actions([
                EditAction::make()->after(fn() => Cache::forget('global_app_footer_data')),
                DeleteAction::make()->after(fn() => Cache::forget('global_app_footer_data')),
            ])->filters([
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
