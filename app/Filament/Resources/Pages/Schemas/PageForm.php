<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Page Builder')
                ->persistTabInQueryString()

                ->tabs([

                    /*
                    |--------------------------------------------------------------------------
                    | PAGE SETTINGS
                    |--------------------------------------------------------------------------
                    */

                    Tabs\Tab::make('Page')
                        ->icon('heroicon-o-document-text')
                        ->schema([

                            Section::make('Page Details')
                                ->columns(12)
                                ->schema([

                                    TextInput::make('title')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->columnSpan(8)
                                        ->maxLength(255),

                                    TextInput::make('slug')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->columnSpan(4),

                                    Textarea::make('description')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    /*
                    |--------------------------------------------------------------------------
                    | HERO
                    |--------------------------------------------------------------------------
                    */

                    Tabs\Tab::make('Hero Banner')
                        ->icon('heroicon-o-photo')
                        ->schema([

                            Section::make()
                                ->columns(12)
                                ->schema([

                                    TextInput::make('hero_title')
                                        ->columnSpan(6),

                                    TextInput::make('hero_button_text')
                                        ->columnSpan(3),

                                    TextInput::make('hero_button_url')
                                        ->columnSpan(3),

                                    Textarea::make('hero_subtitle')
                                        ->rows(4)
                                        ->columnSpan(8),

                                    FileUpload::make('hero_image')
                                        ->image()
                                        ->imageEditor()
                                        ->directory('hero-banners')
                                        ->columnSpan(4),
                                ]),
                        ]),

                    /*
                    |--------------------------------------------------------------------------
                    | SEO
                    |--------------------------------------------------------------------------
                    */

                    Tabs\Tab::make('SEO')
                        ->icon('heroicon-o-globe-alt')
                        ->schema([

                            Section::make('Search Engine Optimisation')
                                ->schema([

                                    TextInput::make('seo_title')
                                        ->maxLength(70)
                                        ->live(),

                                    Textarea::make('seo_description')
                                        ->rows(3)
                                        ->maxLength(160)
                                        ->live(),
                                ]),
                        ]),

                    /*
                    |--------------------------------------------------------------------------
                    | PUBLISHING
                    |--------------------------------------------------------------------------
                    */

                    Tabs\Tab::make('Publishing')
                        ->icon('heroicon-o-clock')
                        ->schema([

                            Section::make()
                                ->columns(2)
                                ->schema([

                                    Select::make('status')
                                        ->required()
                                        ->options([
                                            'draft' => 'Draft',
                                            'scheduled' => 'Scheduled',
                                            'published' => 'Published',
                                            'archived' => 'Archived',
                                        ]),

                                    DateTimePicker::make('published_at')
                                        ->seconds(false),
                                ]),
                        ]),
                ]),
            ]);
    }
}
