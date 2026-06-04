<?php

namespace App\Filament\Resources\Pages\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;


class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Select::make('section_type_id')
                    ->relationship('sectionType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('content_source')
                    ->required()
                    ->live()
                    ->options([
                        'category' => 'Category',
                        'manual_articles' => 'Manual Articles',
                        'gallery' => 'Gallery',
                        'video' => 'Video',
                        'burudani' => 'Burudani',
                    ]),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->visible(fn($get) => $get('content_source') === 'category'),

                Toggle::make('is_visible')
                    ->default(true),

                KeyValue::make('settings')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
        
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->recordTitleAttribute('title')

            ->columns([
                TextColumn::make('sort_order')
                    ->label('#'),

                TextColumn::make('title')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('sectionType.name')
                    ->badge(),

                TextColumn::make('content_source')
                    ->badge(),

                IconColumn::make('is_visible')
                    ->boolean(),
            ])

            ->headerActions([
                CreateAction::make()
                    ->label('Add Section')
                    ->icon('heroicon-o-plus'),
            ])

            ->reorderable('sort_order')
            ->filters([
                //
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
