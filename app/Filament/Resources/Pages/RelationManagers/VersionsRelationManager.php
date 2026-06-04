<?php

namespace App\Filament\Resources\Pages\RelationManagers;

use App\Models\PageVersion;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Schemas\Schema;

class VersionsRelationManager extends RelationManager
{
    protected static string $relationship = 'versions';

    protected static ?string $title = 'Version History';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')

            ->columns([

                TextColumn::make('id')
                    ->label('Version')
                    ->badge(),

                TextColumn::make('created_by')
                    ->label('User')
                    ->placeholder('System'),

                TextColumn::make('created_at')
                    ->label('Saved')
                    ->dateTime('d M Y H:i:s')
                    ->sortable(),

            ])

            ->headerActions([])

            ->actions([

                ViewAction::make(),

                Action::make('restore')
                    ->label('Restore')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')

                    ->requiresConfirmation()

                    ->modalHeading('Restore Version')
                    ->modalDescription(
                        'This will restore the page to this version.'
                    )

                    ->action(function (
                        PageVersion $record,
                        VersionsRelationManager $livewire
                    ) {

                        $page = $livewire->getOwnerRecord();

                        $snapshot = $record->snapshot;

                        unset(
                            $snapshot['id'],
                            $snapshot['created_at'],
                            $snapshot['updated_at']
                        );

                        $page->update($snapshot);

                        Notification::make()
                            ->title('Page restored successfully')
                            ->success()
                            ->send();
                    }),

            ])

            ->bulkActions([]);
    }

    // public static function canCreate(): bool
    // {
    //     return false;
    // }

    // public static function canEdit($record): bool
    // {
    //     return false;
    // }

    // public static function canDelete($record): bool
    // {
    //     return false;
    // }
}