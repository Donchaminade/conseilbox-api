<?php

namespace App\Filament\Widgets;

use App\Models\Conseil;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseTableWidget;
use Illuminate\Database\Eloquent\Builder;

class SuggestionsTableWidget extends BaseTableWidget
{
    protected static ?string $heading = 'Suggestions à traiter';

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Conseil::query()
            ->where('status', Conseil::STATUS_PENDING)
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')
                ->label('Titre')
                ->description(fn (Conseil $record) => str($record->content)->limit(60))
                ->wrap()
                ->weight('bold'),
            Tables\Columns\TextColumn::make('author')
                ->label('Auteur')
                ->badge()
                ->color('primary'),
            Tables\Columns\TextColumn::make('location')
                ->label('Ville')
                ->icon('heroicon-m-map-pin')
                ->placeholder('—'),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Réception')
                ->since(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('publish')
                ->label('Publier')
                ->icon('heroicon-m-check')
                ->color('success')
                ->requiresConfirmation()
                ->action(fn (Conseil $record) => $record->update(['status' => Conseil::STATUS_PUBLISHED])),
            Action::make('reject')
                ->label('Rejeter')
                ->icon('heroicon-m-x-mark')
                ->color('danger')
                ->requiresConfirmation()
                ->action(fn (Conseil $record) => $record->update(['status' => Conseil::STATUS_REJECTED])),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }
}

