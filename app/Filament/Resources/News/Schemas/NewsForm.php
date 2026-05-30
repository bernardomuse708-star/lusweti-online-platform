<?php

namespace App\Filament\Resources\News\Schemas;

use App\Models\News;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Live Update Mapping')->schema([
                    TextInput::make('headline')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')
                        ->required()
                        ->unique(News::class, 'slug', ignoreRecord: true),
                    TextInput::make('url')
                        ->label('Target URL')
                        ->required()->url()
                        ->columnSpanFull(),
                    Toggle::make('is_breaking')
                        ->label('Push as Live Breaking News')
                        ->helperText('Instantly pushes banner via WebSockets.')
                        ->columnSpanFull(),
                ])->columns(2)->columnSpan(['default' => 3, 'md' => 2]),

                Section::make('Media Assets')->schema([
                    SpatieMediaLibraryFileUpload::make('featured_image')
                        ->collection('featured_image')
                        ->label('Featured Image')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull()
                        ->disk('public'),
                ])->collapsible(),

            ]);
    }
}
