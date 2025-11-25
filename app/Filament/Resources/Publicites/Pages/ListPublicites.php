<?php

namespace App\Filament\Resources\Publicites\Pages;

use App\Filament\Resources\Publicites\PubliciteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPublicites extends ListRecords
{
    protected static string $resource = PubliciteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
