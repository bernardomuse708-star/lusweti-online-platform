<?php

namespace App\Filament\Resources\SectionTypes\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SectionTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Section::make()
                ->columns(2)
                ->schema([

                    TextInput::make('name')
                        ->required(),

                    TextInput::make('slug')
                        ->required(),

                    TextInput::make('component')
                        ->required(),

                    Toggle::make('is_active')
                        ->default(true),

                    Textarea::make('description')
                        ->columnSpanFull(),
                ]),
            ]);
    }
}
