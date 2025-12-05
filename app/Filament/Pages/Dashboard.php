<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\OverviewStats;
use App\Filament\Widgets\PublicitePerformanceChart;
use App\Filament\Widgets\SuggestionsTableWidget;
use App\Filament\Widgets\PublicitesTableWidget;
use App\Filament\Widgets\PubliciteStatsOverview; // Added

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Tableau de bord';

    public function getWidgets(): array
    {
        return [
            PubliciteStatsOverview::class, // Added
            OverviewStats::class,
            SuggestionsTableWidget::class,
            PublicitesTableWidget::class,
            PublicitePerformanceChart::class,
        ];
    }
}



