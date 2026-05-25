<?php

namespace App\Filament\Resources\News\Schemas;

use App\Models\News;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('headline')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->required()
                    ->unique(News::class, 'slug', ignoreRecord: true),

                TextInput::make('url')
                    ->label('Target URL')
                    ->required()
                    ->url(),

                Toggle::make('is_breaking')
                    ->label('Push as Live Breaking News')
                    ->helperText('Activating this will instantly push a banner to all active website visitors via WebSockets.')
                    ->default(false),
            ]);
    }
}
