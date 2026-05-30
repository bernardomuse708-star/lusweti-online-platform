<?php

namespace App\Filament\Resources\ExternalArticles;

use App\Filament\Resources\ExternalArticles\Pages\CreateExternalArticle;
use App\Filament\Resources\ExternalArticles\Pages\EditExternalArticle;
use App\Filament\Resources\ExternalArticles\Pages\ListExternalArticles;
use App\Filament\Resources\ExternalArticles\Schemas\ExternalArticleForm;
use App\Filament\Resources\ExternalArticles\Tables\ExternalArticlesTable;
use App\Models\Article;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use PHPUnit\Event\TestRunner\Configured;

class ExternalArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    // 🚀 ADD THESE THREE LINES TO SOLVE THE CONFLICT
    protected static ?string $slug = 'external-articles';
    protected static ?string $navigationLabel = 'External Articles';
    protected static ?string $pluralLabel = 'External Articles';

    protected static string | \UnitEnum | null $navigationGroup = 'Multimedia Content';

    protected static string|BackedEnum|null $navigationIcon ='heroicon-o-globe-alt';

    public static function form(Schema $schema): Schema
    {
        return ExternalArticleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExternalArticlesTable::configure($table);
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
            'index' => ListExternalArticles::route('/'),
            'create' => CreateExternalArticle::route('/create'),
            'edit' => EditExternalArticle::route('/{record}/edit'),
        ];
    }


    public static function canViewAny(): bool
    {
        // Temporarily return true to see if it appears in the sidebar
        return true;
    }
}
