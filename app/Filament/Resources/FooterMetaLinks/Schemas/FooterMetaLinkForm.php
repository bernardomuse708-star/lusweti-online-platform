<?php

namespace App\Filament\Resources\FooterMetaLinks\Schemas;

use App\Models\FooterMetaLink;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class FooterMetaLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Link Specifications Mapping')->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(
                            fn($state, Set $set, $operation) =>
                            $operation === 'create' ? $set('system_key', Str::snake($state)) : null
                        ),

                    TextInput::make('system_key')
                        ->required()
                        ->disabled(fn($record) => $record !== null)
                        ->unique(FooterMetaLink::class, 'system_key', ignoreRecord: true)
                        ->maxLength(255),

                    TextInput::make('url')
                        ->label('Target Portal URI Location')
                        ->required()
                        ->url()
                        ->columnSpanFull(),
                ])->columns(2),

                Section::make('Visual Sequence & Controls Enforcer')->schema([
                    TextInput::make('sort_weight')
                        ->label('Sequence Execution Weight')
                        ->numeric()
                        ->default(100)
                        ->required(),

                    Toggle::make('open_in_new_tab')
                        ->label('Force Target Blank Window Redirect')
                        ->default(true),

                    Toggle::make('is_active')
                        ->label('Online Visibility Status')
                        ->default(true),
                ])->columns(3)
            ]);
    }
}
