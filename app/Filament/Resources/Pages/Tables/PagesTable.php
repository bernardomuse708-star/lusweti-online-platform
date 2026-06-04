<?php

namespace App\Filament\Resources\Pages\Tables;

use App\Models\Page;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table

        ->defaultSort('updated_at', 'desc')
            ->columns([
                 TextColumn::make('title')
                ->searchable()
                ->sortable()
                ->weight(FontWeight::Bold),

            TextColumn::make('slug')
                ->copyable()
                ->badge(),

            TextColumn::make('sections_count')
                ->counts('sections')
                ->badge(),

            TextColumn::make('status')
                ->badge()
                ->sortable(),

            TextColumn::make('published_at')
                ->dateTime(),

            TextColumn::make('updated_at')
                ->since(),
        ])

        ->filters([

            SelectFilter::make('status')
                ->options([
                    'draft' => 'Draft',
                    'scheduled' => 'Scheduled',
                    'published' => 'Published',
                    'archived' => 'Archived',
                ]),
        ])

        ->actions([

            ViewAction::make(),

            EditAction::make(),

            Action::make('preview')
    ->icon('heroicon-o-eye')
    ->url(fn (Page $record) =>
        route('page.preview', ['token' => $record->preview_token])
    )
    ->openUrlInNewTab()
            ]);
    }
}
