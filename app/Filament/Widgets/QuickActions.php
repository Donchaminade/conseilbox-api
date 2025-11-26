<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Conseils\ConseilResource;
use App\Filament\Resources\Publicites\PubliciteResource;
use App\Filament\Resources\Suggestions\SuggestionResource;
use Filament\Widgets\Widget;

class QuickActions extends Widget
{
    protected string $view = 'filament.widgets.quick-actions';

    protected int|string|array $columnSpan = 'full';

    public function getViewData(): array
    {
        return [
            'actions' => [
                [
                    'label' => 'Nouveau conseil',
                    'description' => 'Publier un contenu validé en quelques clics',
                    'icon' => 'heroicon-o-light-bulb',
                    'url' => ConseilResource::getUrl('create'),
                    'accent' => 'from-orange-500 to-amber-400',
                ],
                [
                    'label' => 'Revue des suggestions',
                    'description' => 'Modérer et approuver les propositions reçues',
                    'icon' => 'heroicon-o-inbox-arrow-down',
                    'url' => SuggestionResource::getUrl(),
                    'accent' => 'from-sky-500 to-blue-500',
                ],
                [
                    'label' => 'Nouvelle publicité',
                    'description' => 'Booster la visibilité des campagnes partenaires',
                    'icon' => 'heroicon-o-megaphone',
                    'url' => PubliciteResource::getUrl('create'),
                    'accent' => 'from-emerald-500 to-lime-400',
                ],
            ],
        ];
    }
}

