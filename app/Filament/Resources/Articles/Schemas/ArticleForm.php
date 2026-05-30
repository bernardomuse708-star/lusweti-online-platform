<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group as ComponentsGroup;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            ComponentsGroup::make()->schema([
                Section::make('Headline Mapping Parameters')->schema([
                    TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state))),

                    TextInput::make('slug')
                        ->required()
                        ->unique(Article::class, 'slug', ignoreRecord: true),

                    Textarea::make('summary')
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2),

                Section::make('Core Narrative Composition')->schema([
                    RichEditor::make('content')
                        ->required()
                        ->columnSpanFull(),
                ]),

                Section::make('Visual Assets')->schema([
                    SpatieMediaLibraryFileUpload::make('featured_image')
                        ->collection('featured_image')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull()
                        ->disk('public'),
                ])->collapsible(),
            ])->columnSpan(['default' => 3, 'md' => 2]),

            ComponentsGroup::make()->schema([
                Section::make('Publishing & Taxonomy')->schema([
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->preload()
                        ->searchable()
                        ->required(),

                    DateTimePicker::make('published_at')
                        ->required()
                        ->default(now()),

                    Toggle::make('is_prime')
                        ->label('Premium Content (PRIME)')
                        ->default(false),
                ]),

                Section::make('Layout Engine')->schema([
                    Select::make('layout_style')
                        ->options([
                            'featured-large'  => 'Column 1: Prominent Large',
                            'thumbnail-right' => 'Column 2: Thumbnail Right',
                            'text-only'       => 'Column 3: Text Only',
                        ])->required(),

                    Select::make('layout_type')
                        ->options([
                            'teaser-image-large' => 'Large Top Image',
                            'teaser-image-none'  => 'Text-Only Structural',
                            'teaser-image-right' => 'Split Right Thumbnail',
                            'teaser-text'        => 'Inline Bold Summary',
                        ])->required(),

                    Toggle::make('is_featured_in_row')
                        ->label('Featured Block Assignment')
                        ->helperText('Forces this element to fill the prominent 2/3 layout slot.'),
                        
                    TextInput::make('topic_label')
                        ->label('Topic Label (e.g. Soka)')
                        ->placeholder('Defaults to category'),

                    TextInput::make('tentacle_id')
                        ->label('Natural Unique Identifier')
                        ->default(fn() => 'sm-' . Str::random(10))
                        ->disabled()
                        ->dehydrated()
                        ->required(),
                ]),
            ])->columnSpan(['default' => 3, 'md' => 1]),
        ])->columns(3);
    }
}