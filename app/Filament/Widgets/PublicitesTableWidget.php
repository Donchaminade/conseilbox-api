<?php

namespace App\Filament\Widgets;

use App\Models\Publicite;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn; // Added for image preview
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action; // Corrected namespace for row actions
use Filament\Widgets\TableWidget as BaseTableWidget;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon; // Added for date formatting

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
                ->defaultImageUrl(url('/images/logodark.png')), // Fallback image
            TextColumn::make('title')
                ->label('Titre')
                ->searchable()
                ->sortable(),
            TextColumn::make('content')
                ->label('Aperçu du contenu')
                ->wrap()
                ->limit(50), // Show a snippet of the content
            TextColumn::make('target_url')
                ->label('URL Cible')
                ->url(fn (Publicite $record): string => $record->target_url)
                ->openUrlInNewTab()
                ->wrap()
                ->placeholder('Pas d\'URL cible'),
            TextColumn::make('start_date')
                ->label('Début')
                ->date('d/m/Y') // Format the date
                ->sortable(),
            TextColumn::make('end_date')
                ->label('Fin')
                ->date('d/m/Y') // Format the date
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
            Action::make('view_edit')
                ->label('Voir/Modifier')
                ->url(fn (Publicite $record): string => \App\Filament\Resources\Publicites\PubliciteResource::getUrl('edit', ['record' => $record]))
                ->icon('heroicon-o-pencil'),
        ];
    }
}
