<?php

namespace App\Filament\Resources\Galleries;

use App\Filament\Resources\Galleries\Pages\CreateGallery;
use App\Filament\Resources\Galleries\Pages\EditGallery;
use App\Filament\Resources\Galleries\Pages\ListGalleries;
use App\Filament\Resources\Galleries\Schemas\GalleryForm;
use App\Filament\Resources\Galleries\Tables\GalleriesTable;
use App\Models\Gallery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-camera';
    protected static ?string $pluralModelLabel = 'Picha Galleries';
    protected static ?string $recordTitleAttribute = 'GalleryUpdates';
    protected static string | \UnitEnum | null $navigationGroup = 'Multimedia Content';

    public static function form(Schema $schema): Schema
    {
        return GalleryForm::configure($schema);
    }

    

    public static function table(Table $table): Table
    {
        return GalleriesTable::configure($table);
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
            'index' => ListGalleries::route('/'),
            'create' => CreateGallery::route('/create'),
            'edit' => EditGallery::route('/{record}/edit'),
        ];
    }
}
