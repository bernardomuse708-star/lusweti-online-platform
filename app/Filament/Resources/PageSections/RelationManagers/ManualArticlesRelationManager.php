<?php

namespace App\Filament\Resources\PageSections\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ManualArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'article.title';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('article_id')
                    ->relationship('article', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('article.title')
            ->reorderable('sort_order')
            ->defaultSort('sort_order')

            ->columns([

                TextColumn::make('article.title')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('article.category.name')
                    ->badge(),

                TextColumn::make('article.published_at')
                    ->since(),
            ])

            ->headerActions([
                CreateAction::make()
                    ->label('Add Article'),
            ])

            ->actions([
                DeleteAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
