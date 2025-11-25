<?php

namespace App\Filament\Resources\Conseils;

use App\Filament\Resources\Conseils\Pages\CreateConseil;
use App\Filament\Resources\Conseils\Pages\EditConseil;
use App\Filament\Resources\Conseils\Pages\ListConseils;
use App\Filament\Resources\Conseils\Schemas\ConseilForm;
use App\Filament\Resources\Conseils\Tables\ConseilsTable;
use App\Models\Conseil;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConseilResource extends Resource
{
    protected static ?string $model = Conseil::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ConseilForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConseilsTable::configure($table);
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
            'index' => ListConseils::route('/'),
            'create' => CreateConseil::route('/create'),
            'edit' => EditConseil::route('/{record}/edit'),
        ];
    }
}
