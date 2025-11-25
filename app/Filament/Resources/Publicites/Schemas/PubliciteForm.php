<?php

namespace App\Filament\Resources\Publicites\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PubliciteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Titre de la publicité')
                    ->required()
                    ->maxLength(255),
                Textarea::make('content')
                    ->label('Contenu de la publicité')
                    ->maxLength(65535),
                TextInput::make('image_url')
                    ->label('URL de l\'image')
                    ->url()
                    ->maxLength(255),
                TextInput::make('target_url')
                    ->label('URL cible')
                    ->url()
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->label('Active')
                    ->inline(false)
                    ->default(false),
            ]);
    }
}
