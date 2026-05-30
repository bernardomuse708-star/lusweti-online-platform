<?php

namespace App\Filament\Resources\SocialLinks;

use App\Filament\Resources\SocialLinks\Pages\CreateSocialLinks;
use App\Filament\Resources\SocialLinks\Pages\EditSocialLinks;
use App\Filament\Resources\SocialLinks\Pages\ListSocialLinks;
use App\Filament\Resources\SocialLinks\Schemas\SocialLinksForm;
use App\Filament\Resources\SocialLinks\Tables\SocialLinksTable;
use App\Models\SocialLink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SocialLinksResource extends Resource
{
    protected static ?string $model = SocialLink::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-top-right-on-square';


    protected static ?string $recordTitleAttribute = 'SocialLinksUpate';
    protected static string | \UnitEnum | null $navigationGroup = 'Global Architecture';

    public static function form(Schema $schema): Schema
    {
        return SocialLinksForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SocialLinksTable::configure($table);
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
            'index' => ListSocialLinks::route('/'),
            'create' => CreateSocialLinks::route('/create'),
            'edit' => EditSocialLinks::route('/{record}/edit'),
        ];
    }
}
