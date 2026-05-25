<?php

declare(strict_types=1);

namespace App\Filament\Resources\FooterMetaLinks;

use App\Filament\Resources\FooterMetaLinks\Pages\CreateFooterMetaLink;
use App\Filament\Resources\FooterMetaLinks\Pages\EditFooterMetaLink;
use App\Filament\Resources\FooterMetaLinks\Pages\ListFooterMetaLinks;
use App\Filament\Resources\FooterMetaLinks\Schemas\FooterMetaLinkForm;
use App\Filament\Resources\FooterMetaLinks\Tables\FooterMetaLinksTable;
use App\Models\FooterMetaLink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FooterMetaLinkResource extends Resource
{
    protected static ?string $model = FooterMetaLink::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-link';
    protected static string | \UnitEnum | null $navigationGroup = 'Global Architecture';
    protected static ?string $recordTitleAttribute = 'FooterUpdates';
    protected static ?string $modelLabel = 'Footer Link';

    public static function form(Schema $schema): Schema
    {
        return FooterMetaLinkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FooterMetaLinksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFooterMetaLinks::route('/'),
            'create' => CreateFooterMetaLink::route('/create'),
            'edit' => EditFooterMetaLink::route('/{record}/edit'),
        ];
    }
}
