<?php

namespace App\Filament\Resources\Suggestions;

use App\Filament\Resources\Conseils\Schemas\ConseilForm;
use App\Filament\Resources\Conseils\Tables\ConseilsTable;
use App\Filament\Resources\Suggestions\Pages\CreateSuggestion;
use App\Filament\Resources\Suggestions\Pages\EditSuggestion;
use App\Filament\Resources\Suggestions\Pages\ListSuggestions;
use App\Models\Conseil;
use Filament\Resources\Resource;
use Filament\Schemas\Schema; // Changed from Filament\Forms\Form
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SuggestionResource extends Resource
{
    protected static ?string $model = Conseil::class;

    protected static ?string $navigationLabel = 'Suggestions'; // Keep label for clarity

    protected static ?string $recordTitleAttribute = 'title'; // Keep title attribute for clarity

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('status', 'pending');
    }

    public static function form(Schema $schema): Schema // Changed signature
    {
        return ConseilForm::configure($schema); // Pass $schema
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
            'index' => Pages\ListSuggestions::route('/'),
            'create' => Pages\CreateSuggestion::route('/create'),
            'edit' => Pages\EditSuggestion::route('/{record}/edit'),
        ];
    }
}
