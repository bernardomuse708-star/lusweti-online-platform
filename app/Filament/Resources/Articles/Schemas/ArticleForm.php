<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // Newsroom Desks
                Grid::make(3)->schema([
                    Section::make('Headline Mapping Parameters')->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->unique(Article::class, 'slug', ignoreRecord: true),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                    ])->columnSpan(2),

                    Section::make('Structural Controls Enforcer')->schema([
                        Select::make('layout_style')
                            ->options([
                                'featured-large'  => 'Column 1: Prominent Large Item',
                                'thumbnail-right' => 'Column 2: Thumbnail Right Split Item',
                                'text-only'       => 'Column 3: Text Headline Element Only',
                            ])->required(),

                        TextInput::make('tentacle_id')
                            ->label('Natural Unique Identifier')
                            ->default(fn() => 'sm-' . Str::random(10))
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        DateTimePicker::make('published_at')
                            ->required()
                            ->default(now()),

                        Toggle::make('is_prime')
                            ->label('Premium Content Status (PRIME)')
                            ->default(false),
                    ])->columnSpan(1),

                    Section::make('Visual Assets & Context Synopsis Box')->schema([
                        TextInput::make('image_path')
                            ->label('Image Location Resource URI Pointer Path Location'),

                        Textarea::make('summary')
                            ->rows(3),
                    ])->columnSpanFull(),
                ]),





                // Newsroom
                Grid::make(3)->schema([
                    Section::make('Core Narrative Parameters')->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->unique(Article::class, 'slug', ignoreRecord: true),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                    ])->columnSpan(2),

                    Section::make('Layout Distribution Engine')->schema([
                        Select::make('display_layout')
                            ->options([
                                'large-featured'   => 'Column 1: Hero Large Element',
                                'thumbnail-right'  => 'Column 2: Thumbnail Right Split Element',
                                'text-only'        => 'Column 3: Text Headline Element Only',
                            ])->required(),

                        TextInput::make('tentacle_id')
                            ->default(fn() => 'ke-' . Str::random(10))
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        DateTimePicker::make('published_at')
                            ->required()
                            ->default(now()),
                    ])->columnSpan(1),

                    Section::make('Multimedia Assets & Summary Block')->schema([
                        TextInput::make('image_path')
                            ->label('Image Location Resource URI Pointer'),

                        Textarea::make('summary')
                            ->rows(3),
                    ])->columnSpanFull(),
                ]),

                // HadithiTeaser
                Section::make('Story Metadata')->schema([
                    TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->required()
                        ->unique(Article::class, 'slug', ignoreRecord: true),

                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    TextInput::make('tentacle_id')
                        ->default(fn() => 'hadithi-' . time() . '-' . Str::random(4))
                        ->disabled()
                        ->dehydrated()
                        ->required(),
                ])->columns(2),

                Section::make('Presentation Layout Engine')->schema([
                    Select::make('display_style')
                        ->options([
                            'large' => 'Column 1: Prominent Large Layout',
                            'thumbnail-left' => 'Column 2: Split Left-Thumbnail Layout',
                            'text-only' => 'Column 3: Text-Only Collection Layout',
                        ])->required(),

                    TextInput::make('image_path')
                        ->label('Image Resource URI Source Location'),

                    Textarea::make('summary')
                        ->rows(4)
                        ->columnSpanFull(),

                    DateTimePicker::make('published_at')
                        ->required()
                        ->default(now()),
                ])->columns(2),






                // ZanzibarTeaserRow
                Grid::make(3)->schema([
                    Section::make('Identity Matrix Mapping')->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->unique(Article::class, 'slug', ignoreRecord: true),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                    ])->columnSpan(2),

                    Section::make('Structural Placement Context')->schema([
                        TextInput::make('topic_label')
                            ->label('Display Topic Label (e.g. Soka)')
                            ->placeholder('Defaults to category name if left null'),

                        TextInput::make('tentacle_id')
                            ->default(fn() => 'zpl-' . Str::ulid())
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        DateTimePicker::make('published_at')
                            ->required()
                            ->default(now()),
                    ])->columnSpan(1),

                    Section::make('Media Assets & Paragraph Composition Summary')->schema([
                        TextInput::make('image_path')
                            ->label('Asset Image URI path pointer location location'),

                        Textarea::make('summary')
                            ->rows(4)
                            ->required(),
                    ])->columnSpanFull(),
                ]),

                // Editorial Office
                Grid::make(3)->schema([
                    Section::make('Headline Content Mapping')->schema([
                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->unique(Article::class, 'slug', ignoreRecord: true),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->preload()
                            ->searchable()
                            ->required(),
                    ])->columnSpan(2),

                    Section::make('Structural Placement Controls')->schema([
                        Select::make('layout_style')
                            ->options([
                                'featured-large'  => 'Column 1: Prominent Feature Element',
                                'right-thumbnail' => 'Column 2: Split Right-Thumbnail Item',
                                'text-only'       => 'Column 3: Text-Only Stream Entry',
                            ])->required(),

                        TextInput::make('tentacle_id')
                            ->default(fn() => 'op-' . Str::random(8))
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        DateTimePicker::make('published_at')
                            ->required()
                            ->default(now()),

                        Toggle::make('is_prime')
                            ->label('Premium Access Flag (PRIME)')
                            ->default(false),
                    ])->columnSpan(1),

                    Section::make('Paragraph Layout & Extracted Asset Resources')->schema([
                        TextInput::make('image_path')
                            ->label('Image Resource URI path pointer location location'),

                        Textarea::make('summary')
                            ->rows(3),
                    ])->columnSpanFull(),
                ]),


                //CategoryTeaserRow 

                Section::make('Core Content Set')->schema([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                
                TextInput::make('slug')
                    ->required()
                    ->unique(Article::class, 'slug', ignoreRecord: true),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('tentacle_id')
                    ->default(fn () => 'manual-' . Str::random(8))
                    ->required()
                    ->disabled()
                    ->dehydrated(),
            ])->columns(2),

            Section::make('Layout Strategy')->schema([
                TextInput::make('image_path')
                    ->label('Image URL Asset'),

                Toggle::make('is_featured_in_row')
                    ->label('Featured Block Assignment')
                    ->helperText('Forces this element to fill the prominent 2/3 teaser layout slot.'),

                Textarea::make('summary')->rows(3),
                
                DateTimePicker::make('published_at')
                    ->required()
                    ->default(now()),
            ]),


                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->required()
                    ->unique(Article::class, 'slug', ignoreRecord: true),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable(),

                TextInput::make('tentacle_id')
                    ->default(fn() => 'manual-' . Str::random(8))
                    ->required()
                    ->disabled()
                    ->dehydrated(),

                Select::make('layout_type')

                    ->options([
                        'teaser-image-large' => 'Large Top Image Layout',
                        'teaser-image-none'  => 'Text-Only Structural Layout',
                        'teaser-image-right' => 'Split Right Thumbnail Layout',
                        'teaser-text'        => 'Inline Bold Summary Layout',
                    ])->required(),

                TextInput::make('image_path')
                    ->label('Image URL Asset'),
                Textarea::make('summary')->rows(3),

                Textarea::make('summary')->rows(3),
                RichEditor::make('content'),

                Toggle::make('is_prime')
                    ->label('Premium Status Badge (PRIME)'),
                Toggle::make('is_featured_in_row')
                    ->label('Featured Block Assignment')
                    ->helperText('Forces this element to fill the prominent 2/3 teaser layout slot.'),
                DateTimePicker::make('published_at')
                    ->required()
                    ->default(now()),

            ]);
    }
}
