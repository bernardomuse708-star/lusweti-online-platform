<?php

namespace App\Filament\Resources\SocialLinks\Schemas;


use App\Models\SocialLink;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;




// 'platform_key',

// 'color_class',

// 'sort_weight',

class SocialLinksForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()->schema([
                Section::make('Identity Mapping Assignment')->schema([
                    TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')
                        ->required()
                        ->unique(SocialLink::class, 'slug', ignoreRecord: true),
                    TextInput::make('url')
                        ->label('Target URL')
                        ->required()->url()
                        ->columnSpanFull(),

                    TextInput::make('platform_key')->disabled()->required()
                        ->helperText('System structural key (immutable).'),
                ])->columns(2),

                Section::make('Media Assets URI Resolution')->schema([
                    SpatieMediaLibraryFileUpload::make('logo')
                        ->collection('logo')
                        ->label('Social Link Logo')
                        ->image()
                        ->imageEditor()
                        ->directory('social-links/logos')
                        ->visibility('public')
                        ->downloadable()
                        ->maxSize(10240)
                        ->columnSpanFull()
                        ->disk('public'),
                ]),
            ])->columnSpan(['default' => 3, 'md' => 2]),

            Group::make()->schema([
                Section::make('Publishing Context')->schema([
                    // Select::make('category_id')
                    //     ->relationship('category', 'name')
                    //     ->preload()
                    //     ->searchable()
                    //     ->required(),

                    DateTimePicker::make('published_at')
                        ->required()
                        ->default(now()),

                    Toggle::make('is_visible')
                        ->label('Visibility Status')
                        ->default(true),
                    Toggle::make('is_active')
                        ->label('Push to be seen')
                        ->helperText('Instantly pushes socials via WebSockets.')
                        ->columnSpanFull(),


                ]),
            ])->columnSpan(['default' => 3, 'md' => 1]),
        ])->columns(3);
    }
}
