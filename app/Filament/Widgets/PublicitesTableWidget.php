<?php

namespace App\Filament\Widgets;

use App\Models\Publicite;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseTableWidget;
use Illuminate\Database\Eloquent\Builder;

class PublicitesTableWidget extends BaseTableWidget
{
    protected static ?string $heading = 'Publicités récentes';

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Publicite::query()
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('title')
                ->label('Titre')
                ->searchable()
                ->sortable(),
            IconColumn::make('is_active')
                ->label('Active')
                ->boolean()
                ->sortable(),
            TextColumn::make('created_at')
                ->label('Créé le')
                ->dateTime()
                ->sortable(),
        ];
    }
}
