<?php

namespace App\Filament\Widgets;

use App\Models\Publicite;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn; // Added for image preview
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Widgets\TableWidget as BaseTableWidget;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Filament\Infolists\Components\Section; // Added for Infolist styling
use Filament\Infolists\Components\TextEntry; // Added for Infolist display
use Filament\Infolists\Components\ImageEntry; // Added for Infolist image display
use Filament\Infolists\Infolist; // Added for Infolist modal

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
            ImageColumn::make('image_url')
                ->label('Image')
                ->square()
                ->defaultImageUrl(url('/images/logodark.png')),
            TextColumn::make('title')
                ->label('Titre')
                ->searchable()
                ->sortable(),
            TextColumn::make('content')
                ->label('Aperçu du contenu')
                ->wrap()
                ->limit(50),
            TextColumn::make('target_url')
                ->label('URL Cible')
                ->url(fn (Publicite $record): string => $record->target_url)
                ->openUrlInNewTab()
                ->wrap()
                ->placeholder('Pas d\'URL cible'),
            TextColumn::make('start_date')
                ->label('Début')
                ->date('d/m/Y')
                ->sortable(),
            TextColumn::make('end_date')
                ->label('Fin')
                ->date('d/m/Y')
                ->sortable(),
            IconColumn::make('is_active')
                ->label('Active')
                ->boolean()
                ->sortable(),
            TextColumn::make('created_at')
                ->label('Créé le')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('preview')
                ->label('Prévisualiser')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->modalHeading(fn (Publicite $record) => 'Prévisualisation : ' . $record->title)
                ->modalSubmitAction(false) // Disable submit button in modal
                ->modalCancelActionLabel('Fermer') // Change cancel button label
                ->modalContent(fn (Publicite $record) => view('filament.widgets.publicite-preview-modal', [
                    'record' => $record,
                ])),
        ];
    }
}

