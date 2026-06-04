<?php

namespace App\Filament\Resources\Burudanis;

use App\Filament\Resources\Burudanis\Pages\CreateBurudani;
use App\Filament\Resources\Burudanis\Pages\EditBurudani;
use App\Filament\Resources\Burudanis\Pages\ListBurudanis;
use App\Filament\Resources\Burudanis\Schemas\BurudaniForm;
use App\Filament\Resources\Burudanis\Tables\BurudanisTable;
use App\Models\Burudani;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BurudaniResource extends Resource
{
    protected static ?string $model = Burudani::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

     protected static string | \UnitEnum | null $navigationGroup = 'Content Management';

    protected static ?string $recordTitleAttribute = 'BurudaniUpdates';

    public static function form(Schema $schema): Schema
    {
        return BurudaniForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BurudanisTable::configure($table);
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
            'index' => ListBurudanis::route('/'),
            'create' => CreateBurudani::route('/create'),
            'edit' => EditBurudani::route('/{record}/edit'),
        ];
    }
}
