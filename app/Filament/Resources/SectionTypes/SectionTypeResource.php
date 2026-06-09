<?php

namespace App\Filament\Resources\SectionTypes;

use App\Filament\Resources\SectionTypes\Pages\CreateSectionType;
use App\Filament\Resources\SectionTypes\Pages\EditSectionType;
use App\Filament\Resources\SectionTypes\Pages\ListSectionTypes;
use App\Filament\Resources\SectionTypes\Schemas\SectionTypeForm;
use App\Filament\Resources\SectionTypes\Tables\SectionTypesTable;
use App\Models\SectionType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SectionTypeResource extends Resource
{
    protected static ?string $model = SectionType::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $recordTitleAttribute = 'SectionTypeUpdates';

    protected static string | \UnitEnum | null $navigationGroup= 'CMS Builder';

    public static function form(Schema $schema): Schema
    {
        return SectionTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SectionTypesTable::configure($table);
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
            'index' => ListSectionTypes::route('/'),
            'create' => CreateSectionType::route('/create'),
            'edit' => EditSectionType::route('/{record}/edit'),
        ];
    }
}
