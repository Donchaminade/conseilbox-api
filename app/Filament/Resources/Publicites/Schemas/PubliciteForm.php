<?php

namespace App\Filament\Resources\Publicites\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PubliciteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ])
                    ->schema([
                        Section::make('Détails de la campagne')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Titre de la publicité')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('content')
                                    ->label('Contenu de la publicité')
                                    ->rows(6)
                                    ->maxLength(65535),
                            ]),
                        Section::make('Ciblage & visibilité')
                            ->schema([
                                FileUpload::make('image_url')
                                    ->label('Image')
                                    ->image()
                                    ->directory('publicites')
                                    ->imageEditor()
                                    ->downloadable()
                                    ->helperText("Choisis une image depuis ta galerie/appareil. Elle sera stockée dans l’espace de stockage interne de l’application."),
                                TextInput::make('target_url')
                                    ->label('URL cible')
                                    ->helperText("Lien vers lequel l’utilisateur sera redirigé en cliquant sur la publicité (page d’atterrissage, article, offre, etc.).")
                                    ->url()
                                    ->maxLength(255),
                                Toggle::make('is_active')
                                    ->label('Active')
                                    ->inline(false)
                                    ->default(false),
                            ]),
                    ]),
            ]);
    }
}
