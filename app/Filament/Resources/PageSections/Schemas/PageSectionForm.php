<?php

namespace App\Filament\Resources\PageSections\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class PageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Section::make()
                ->columns(12)
                ->schema([

                    TextInput::make('title')
                        ->required()
                        ->columnSpan(6),

                    Select::make('section_type_id')
                        ->relationship(
                            'sectionType',
                            'name'
                        )
                        ->searchable()
                        ->preload()
                        ->required()
                        ->columnSpan(3),

                    Toggle::make('is_visible')
                        ->default(true)
                        ->columnSpan(3),

                    Select::make('content_source')
                        ->required()
                        ->live()
                        ->options([
                            'category' => 'Category',
                            'manual_articles' => 'Manual Articles',
                            'gallery' => 'Gallery',
                            'video' => 'Video',
                            'burudani' => 'Burudani',
                        ])
                        ->columnSpanFull(),

                    Select::make('category_id')
                        ->relationship(
                            'category',
                            'name'
                        )
                        ->searchable()
                        ->preload()
                        ->visible(
                            fn(Get $get)
                                => $get('content_source')
                                === 'category'
                        )
                        ->required(
                            fn(Get $get)
                                => $get('content_source')
                                === 'category'
                        ),

                    KeyValue::make('settings')
                        ->columnSpanFull(),
                ]),
            ]);
    }
}
