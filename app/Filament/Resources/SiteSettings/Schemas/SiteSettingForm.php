<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Global Key-Value Configuration')->schema([
                    TextInput::make('key')->disabled()->required()
                        ->helperText('System structural key (immutable).'),
                    TextInput::make('value')->label('Tagline/Value text')->required()->maxLength(255),
                ])->columns(1)->columnSpan(['default' => 3, 'md' => 2]),

                Section::make('Site Logo')->schema([
                    SpatieMediaLibraryFileUpload::make('site_logo')
                        ->collection('site_logo')
                        ->label('Site Logo')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull()
                        ->disk('public'),
                ])->collapsible()->visible(fn (callable $get) => $get('key') === 'site_header_logo'),
            ]);
    }
}
