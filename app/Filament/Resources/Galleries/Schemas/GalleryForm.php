<?php

namespace App\Filament\Resources\Galleries\Schemas;

use App\Models\Gallery;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->schema([
                Section::make('Identity Mapping Assignment')->schema([
                    TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state))),
                    
                    TextInput::make('slug')
                        ->required()
                        ->unique(Gallery::class, 'slug', ignoreRecord: true),

                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->preload()
                        ->searchable()
                        ->required(),
                ])->columnSpan(2),

                Section::make('Structural Constraints Enforcer')->schema([
                    TextInput::make('tentacle_id')
                        ->label('Tracking Business Key')
                        ->default(fn() => 'pic-' . Str::ulid())
                        ->disabled()
                        ->dehydrated()
                        ->required(),

                    DateTimePicker::make('published_at')
                        ->required()
                        ->default(now()),

                    Toggle::make('is_visible')
                        ->label('Is Published Visibility')
                        ->default(true),
                ])->columnSpan(1),

                Section::make('Media Assets URI Resolution')->schema([
                    TextInput::make('image_path')
                        ->label('Cover Image Source Location URL path pointer')
                        ->required(),
                ])->columnSpanFull(),
            ])
            ]);
    }
}
