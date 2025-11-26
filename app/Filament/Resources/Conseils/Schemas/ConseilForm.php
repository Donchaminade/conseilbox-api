<?php

namespace App\Filament\Resources\Conseils\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ConseilForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(3)
                    ->schema([
                        Section::make('Contenu Principal')
                            ->columnSpan(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Titre du conseil')
                                    ->required(),
                                Textarea::make('content')
                                    ->label('Contenu du conseil')
                                    ->required()
                                    ->rows(10),
                                Textarea::make('anecdote')
                                    ->label('Anecdote')
                                    ->rows(5),
                            ]),
                        Section::make('Méta-données')
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('author')
                                    ->label('Auteur')
                                    ->required(),
                                TextInput::make('location')
                                    ->label('Lieu'),
                                Select::make('status')
                                    ->label('Statut')
                                    ->options([
                                        'pending' => 'En attente',
                                        'published' => 'Publié',
                                        'rejected' => 'Rejeté',
                                    ])
                                    ->default('pending')
                                    ->required(),
                                TextInput::make('social_link_1')
                                    ->label('Lien social 1'),
                                TextInput::make('social_link_2')
                                    ->label('Lien social 2'),
                                TextInput::make('social_link_3')
                                    ->label('Lien social 3'),
                            ]),
                    ]),
            ]);
    }
}
