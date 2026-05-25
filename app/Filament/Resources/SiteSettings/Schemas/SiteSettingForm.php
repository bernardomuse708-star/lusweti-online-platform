<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->disabled() // Kept immutable via UI to enforce structural idempotency
                    ->required(),
                TextInput::make('value')
                    ->label('Tagline/Value text')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
