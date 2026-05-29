<?php

namespace App\Filament\Resources\Videos\Schemas;

use App\Models\Video;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()->schema([
                Section::make('Core Parameters Mapping')->schema([
                    TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->required()
                        ->unique(Video::class, 'slug', ignoreRecord: true),
                ])->columns(2),

                Section::make('Media Payload')->schema([

                    // 1. The Reactive Dropdown Toggle
                    Select::make('video_source_type')
                        ->label('Video Source Format')
                        ->options([
                            'youtube' => 'External YouTube Link',
                            'local' => 'Local Server MP4 Upload',
                        ])
                        ->default('youtube')
                        ->live() // Triggers real-time UI updates
                        ->dehydrated(false) // Prevents Filament from saving this virtual field to the DB
                        ->afterStateHydrated(function (Select $component, ?Video $record) {
                            // On edit, auto-select the correct dropdown option based on existing data
                            if ($record) {
                                $component->state($record->youtube_id ? 'youtube' : 'local');
                            }
                        })
                        ->afterStateUpdated(function ($state, Set $set) {
                            // Clear the youtube_id if they switch to local to prevent conflicting logic
                            if ($state === 'local') {
                                $set('youtube_id', null);
                            }
                        }),

                    // 2. YouTube Input (Conditionally Visible)
                    TextInput::make('youtube_id')
                        ->label('YouTube Video ID (11 characters)')
                        ->length(11)
                        ->placeholder('e.g., rAkZb6HUP8g')
                        ->helperText('Fill this if using external YouTube hosting.')
                        ->visible(fn(Get $get) => $get('video_source_type') === 'youtube')
                        ->required(fn(Get $get) => $get('video_source_type') === 'youtube'),

                    // 3. Local MP4 Upload (Conditionally Visible)
                    SpatieMediaLibraryFileUpload::make('clip_payload')
                        ->label('Upload Local MP4 Video Asset')
                        ->collection('clip_payload')
                        ->acceptedFileTypes(['video/mp4'])
                        ->maxSize(102400) // 100MB Max
                        ->helperText('Or upload a local file directly.')
                        ->visible(fn(Get $get) => $get('video_source_type') === 'local')
                        ->required(fn(Get $get) => $get('video_source_type') === 'local'),

                ])->columns(1),
            ])->columnSpan(['default' => 3, 'md' => 2]),

            Group::make()->schema([
                Section::make('Publishing Details')->schema([
                    Select::make('video_category_id')
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
                        ->required()
                        ->disabled() // Keeps it read-only
                        ->dehydrated() // Ensures it is sent to the DB
                        ->default(fn() => 'vid-' . Str::ulid()) // Sets a default if creating new
                        ->afterStateHydrated(function ($component, $state) {
                            // If editing an existing record and it's somehow null, generate a new one
                            if (!$state) {
                                $component->state('vid-' . Str::ulid());
                            }
                        }),
                ]),
            ])->columnSpan(['default' => 3, 'md' => 1]),
        ])->columns(3);
    }
}
