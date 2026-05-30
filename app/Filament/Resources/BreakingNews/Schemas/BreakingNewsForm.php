<?php

namespace App\Filament\Resources\BreakingNews\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Schema;
use Filament\Actions\Action as ActionsAction;
use Filament\Support\Colors\Color;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

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
                    ->columnSpanFull()
                    ->suffixAction(
                        ActionsAction::make('extract_og_image')
                            ->icon('heroicon-o-cloud-arrow-down')
                            ->color(Color::Emerald)
                            ->tooltip('Extract Featured Image from URL')
                            ->action(function ($state, $record, $livewire) {
                                if (blank($state)) {
                                    Notification::make()->title('Please enter a valid URL first.')->warning()->send();
                                    return;
                                }

                                if (!$record) {
                                    Notification::make()->title('Please save the breaking news item first.')->warning()->send();
                                    return;
                                }

                                try {
                                    if ($record->extractAndAttachOgImage($state)) {
                                        Notification::make()->title('Featured Image Extracted Successfully!')->success()->send();
                                    } else {
                                        Notification::make()->title('No preview image found or extraction failed.')->warning()->send();
                                    }
                                } catch (\Exception $e) {
                                    Notification::make()->title('Extraction failed: ' . $e->getMessage())->danger()->send();
                                }
                            })
                    ),

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

                SpatieMediaLibraryFileUpload::make('featured_image')
                    ->collection('featured_image')
                    ->label('Featured Image')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull()
                    ->disk('public'),
            ]);
    }
}
