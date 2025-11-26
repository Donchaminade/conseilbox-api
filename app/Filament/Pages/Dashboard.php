<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\OverviewStats;
use App\Filament\Widgets\PublicitePerformanceChart;
use App\Filament\Widgets\QuickActions;
use App\Filament\Widgets\SuggestionsTableWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Tableau de bord';

    public function getWidgets(): array
    {
        return [
            OverviewStats::class,
            QuickActions::class,
            PublicitePerformanceChart::class,
            SuggestionsTableWidget::class,
        ];
    }
}

