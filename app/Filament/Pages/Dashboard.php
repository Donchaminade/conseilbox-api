<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\OverviewStats;
use App\Filament\Widgets\PublicitePerformanceChart;
use App\Filament\Widgets\QuickActions;
use App\Filament\Widgets\SuggestionsTableWidget;
use App\Filament\Widgets\PublicitesTableWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Tableau de bord';

    public function getWidgets(): array
    {
        return [
            OverviewStats::class,
            SuggestionsTableWidget::class,
            PublicitePerformanceChart::class,
            QuickActions::class,
            PublicitesTableWidget::class,
        ];
    }
}

