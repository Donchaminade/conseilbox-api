<?php

namespace App\Filament\Resources\Publicites\Pages;

use App\Filament\Resources\Publicites\PubliciteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPublicite extends EditRecord
{
    protected static string $resource = PubliciteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
