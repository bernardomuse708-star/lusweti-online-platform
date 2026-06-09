<?php

namespace App\Filament\Resources\Subscribers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SubscriberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()->schema([
                Section::make('Subscriber Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Active',
                                'pending' => 'Pending',
                                'unsubscribed' => 'Unsubscribed',
                            ])
                            ->default('active')
                            ->required(),
                        DateTimePicker::make('subscribed_at')
                            ->label('Subscribed At')
                            ->default(now())
                            ->required(),
                        DateTimePicker::make('unsubscribed_at')
                            ->label('Unsubscribed At'),
                        Textarea::make('notes')
                            ->label('Notes')
                            ->rows(3),
                    ])
                    ->columns(2),
            ]),
        ])->columns(1);
    }
}
