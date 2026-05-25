<?php

namespace App\Filament\Resources\Videos\Schemas;

use App\Models\Video;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)->schema([
                Section::make('Core Parameters Mapping')->schema([
                    TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state))),
                    
                    TextInput::make('slug')
                        ->required()
                        ->unique(Video::class, 'slug', ignoreRecord: true),

                    Select::make('video_category_id')
                        ->relationship('category', 'name')
                        ->preload()
                        ->searchable()
                        ->required(),
                ])->columnSpan(2),

                Section::make('Structural Constraints Enforcer')->schema([
                    TextInput::make('youtube_id')
                        ->label('YouTube Video ID (11 characters)')
                        ->length(11)
                        ->required()
                        ->placeholder('e.g., rAkZb6HUP8g'),

                    TextInput::make('tentacle_id')
                        ->label('Tracking Business Key')
                        ->default(fn() => 'vid-' . Str::ulid())
                        ->disabled()
                        ->dehydrated()
                        ->required(),

                    DateTimePicker::make('published_at')
                        ->required()
                        ->default(now()),

                    Toggle::make('is_visible')
                        ->label('Is Published Visibility Status')
                        ->default(true),
                ])->columnSpan(1),
            ])
            ]);
    }
}
