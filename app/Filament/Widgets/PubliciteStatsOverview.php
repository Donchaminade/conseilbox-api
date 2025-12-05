<?php

namespace App\Filament\Widgets;

use App\Models\Publicite;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PubliciteStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalPublicites = Publicite::count();
        $activePublicites = Publicite::where('is_active', true)->where('end_date', '>=', Carbon::now())->count();
        $expiringSoonPublicites = Publicite::where('is_active', true)
                                          ->where('end_date', '>=', Carbon::now())
                                          ->where('end_date', '<=', Carbon::now()->addWeek()) // Expiring within 1 week
                                          ->count();
        $newPublicitesThisWeek = Publicite::where('created_at', '>=', Carbon::now()->subWeek())->count();
        $newPublicitesThisMonth = Publicite::where('created_at', '>=', Carbon::now()->subMonth())->count();


        return [
            Stat::make('Total des publicités', $totalPublicites)
                ->description('Toutes les publicités enregistrées')
                ->descriptionIcon('heroicon-m-rectangle-stack'),
            Stat::make('Publicités actives', $activePublicites)
                ->description('Publicités actuellement diffusées')
                ->descriptionIcon('heroicon-m-play-circle')
                ->color('success'),
            Stat::make('Expirant bientôt', $expiringSoonPublicites)
                ->description('Publicités se terminant dans la semaine')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning'),
            Stat::make('Nouvelles cette semaine', $newPublicitesThisWeek)
                ->description('Ajoutées au cours des 7 derniers jours')
                ->descriptionIcon('heroicon-m-plus')
                ->color('info'),
            Stat::make('Nouvelles ce mois-ci', $newPublicitesThisMonth)
                ->description('Ajoutées au cours des 30 derniers jours')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
        ];
    }
}
