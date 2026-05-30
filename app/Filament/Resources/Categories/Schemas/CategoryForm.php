<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Category Details')->schema([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->required()
                    ->unique(Category::class, 'slug', ignoreRecord: true),

                Toggle::make('is_visible_in_nav')
                    ->label('Show in Main Navigation')
                    ->default(true)
                    ->columnSpanFull(),
            ])->columns(2)->columnSpan(['default' => 3, 'md' => 2]),

            Section::make('Media Assets')->schema([
                SpatieMediaLibraryFileUpload::make('featured_image')
                    ->collection('featured_image')
                    ->label('Category Featured Image')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull()
                    ->disk('public'),
            ])->collapsible(),
        ])->columns(3);
    }
}