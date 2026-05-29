<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Form
                Section::make('Global Key-Value Configuration')->schema([
                    TextInput::make('key')->disabled()->required()
                        ->helperText('System structural key (immutable).'),
                    TextInput::make('value')->label('Tagline/Value text')->required()->maxLength(255),
                ])->columns(1)->columnSpan(['default' => 3, 'md' => 2])
            ]);
    }
}
