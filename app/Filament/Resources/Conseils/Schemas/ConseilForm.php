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
                    ->columns([
                        'default' => 1,
                        'md' => 3,
                    ])
                    ->schema([
                        Section::make('Contenu principal')
                            ->columnSpan(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Titre du conseil')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('content')
                                    ->label('Contenu du conseil')
                                    ->required()
                                    ->rows(8),
                                Textarea::make('anecdote')
                                    ->label('Anecdote')
                                    ->rows(4),
                            ]),
                        Section::make('Méta-données')
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('author')
                                    ->label('Auteur')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('location')
                                    ->label('Lieu')
                                    ->maxLength(255),
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
                                    ->label('Lien social 1')
                                    ->url()
                                    ->maxLength(255),
                                TextInput::make('social_link_2')
                                    ->label('Lien social 2')
                                    ->url()
                                    ->maxLength(255),
                                TextInput::make('social_link_3')
                                    ->label('Lien social 3')
                                    ->url()
                                    ->maxLength(255),
                            ]),
                    ]),
            ]);
    }
}
