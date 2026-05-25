<?php

namespace App\Filament\Resources\FooterMetaLinks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Cache;
use Filament\Tables\Table;

class FooterMetaLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('system_key')->fontFamily('monospace'),
                TextColumn::make('url')->limit(40),
                TextColumn::make('sort_weight')->label('Weight')->sortable(),
                IconColumn::make('is_active')->boolean()->label('Status'),
            ])
            ->defaultSort('sort_weight', 'asc')
            ->actions([
                EditAction::make()->after(fn () => Cache::forget('global_app_footer_data')),
                DeleteAction::make()->after(fn () => Cache::forget('global_app_footer_data')),
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
