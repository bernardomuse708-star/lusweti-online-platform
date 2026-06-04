<?php

namespace App\Filament\Resources\Burudanis\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Schema;

class BurudaniForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('topic')
                    ->default('Soka')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('featured_image')
                    ->collection('featured_image')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull(),
                Textarea::make('summary')
                    ->columnSpanFull(),
                DateTimePicker::make('published_at')
                    ->default(now()),
                Toggle::make('is_featured')
                    ->label('Featured Article (Main Column)'),
                Toggle::make('is_prime')
                    ->label('Is Prime Content'),
            ]);
    }
}
