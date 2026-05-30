<?php

namespace App\Filament\Resources\Galleries\Schemas;

use App\Models\Gallery;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload; // Standard Media Engine Component
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()->schema([
                Section::make('Identity Mapping Assignment')->schema([
                    TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state))),
                    
                    TextInput::make('slug')
                        ->required()
                        ->unique(Gallery::class, 'slug', ignoreRecord: true),
                ])->columns(2),

                Section::make('Media Assets URI Resolution')->schema([
                    SpatieMediaLibraryFileUpload::make('cover')
                        ->collection('cover')
                        ->label('Gallery Cover Image')
                        ->image()
                        ->imageEditor()
                        ->directory('galleries/covers')
                        ->visibility('public')
                        ->downloadable()
                        ->maxSize(10240)
                        ->disk('public')
                        ->required()
                        ->columnSpanFull(),
                ]),
            ])->columnSpan(['default' => 3, 'md' => 2]),

            Group::make()->schema([
                Section::make('Publishing Context')->schema([
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->preload()
                        ->searchable()
                        ->required(),

                    DateTimePicker::make('published_at')
                        ->required()
                        ->default(now()),

                    Toggle::make('is_visible')
                        ->label('Visibility Status')
                        ->default(true),

                    TextInput::make('tentacle_id')
                        ->label('Tracking Business Key')
                        ->default(fn() => 'pic-' . Str::ulid())
                        ->disabled()
                        ->dehydrated()
                        ->required(),
                ]),
            ])->columnSpan(['default' => 3, 'md' => 1]),
        ])->columns(3);
    }
}