<?php

namespace App\Filament\Resources\BreakingNews\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BreakingNewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('title')
                    ->required()
                    ->placeholder('🚨 Major event just happened...')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                TextInput::make('url')
                    ->label('Target URL')
                    ->required()->url()
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Show in ticker')
                    ->default(true),

                Toggle::make('is_live')
                    ->label('LIVE indicator')
                    ->helperText('Adds pulsing red dot'),

                DateTimePicker::make('expires_at')
                    ->label('Auto Expire'),

                TextInput::make('priority')
                    ->numeric()
                    ->default(0)
                    ->helperText('Higher = appears first'),

                Toggle::make('is_urgent')
                    ->label('Urgent News')
                    ->helperText('Bypass priority and show at the very front')
                    ->columnSpanFull(),
            ])          
            ;
    }
}
