<?php

namespace App\Filament\Resources\Publicites;

use App\Filament\Resources\Publicites\Pages\CreatePublicite;
use App\Filament\Resources\Publicites\Pages\EditPublicite;
use App\Filament\Resources\Publicites\Pages\ListPublicites;
use App\Filament\Resources\Publicites\Schemas\PubliciteForm;
use App\Filament\Resources\Publicites\Tables\PublicitesTable;
use App\Models\Publicite;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PubliciteResource extends Resource
{
    protected static ?string $model = Publicite::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return PubliciteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PublicitesTable::configure($table);
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
            'index' => ListPublicites::route('/'),
            'create' => CreatePublicite::route('/create'),
            'edit' => EditPublicite::route('/{record}/edit'),
        ];
    }
}
