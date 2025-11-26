<?php

namespace App\Filament\Widgets;

use App\Models\Conseil;
use App\Models\Publicite;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class OverviewStats extends StatsOverviewWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getCards(): array
    {
        $published = Conseil::where('status', Conseil::STATUS_PUBLISHED)->count();
        $pending = Conseil::where('status', Conseil::STATUS_PENDING)->count();
        $activeAds = Publicite::where('is_active', true)->count();

        $trendWindow = Carbon::now()->subDays(7);
        $recentPublished = Conseil::where('status', Conseil::STATUS_PUBLISHED)
            ->where('created_at', '>=', $trendWindow)
            ->count();
        $recentSuggestions = Conseil::where('created_at', '>=', $trendWindow)->count();

        return [
            Stat::make('Conseils publiés', $published)
                ->description("{$recentPublished} nouveaux sur 7 jours")
                ->descriptionIcon('heroicon-o-bolt')
                ->color('warning')
                ->chart($this->getSparklineData(Conseil::STATUS_PUBLISHED)),
            Stat::make('Suggestions en attente', $pending)
                ->description("{$recentSuggestions} reçues récemment")
                ->descriptionIcon('heroicon-o-clock')
                ->color('info')
                ->chart($this->getSparklineData(Conseil::STATUS_PENDING)),
            Stat::make('Publicités actives', $activeAds)
                ->description('Visibilité en cours')
                ->descriptionIcon('heroicon-o-signal')
                ->color('success')
                ->chart($this->getSparklineData()),
        ];
    }

    /**
     * @return list<int>
     */
    private function getSparklineData(?string $status = null): array
    {
        $startDate = Carbon::today()->subDays(6);

        $rows = Conseil::query()
            ->when($status, fn ($q) => $q->where('status', $status))
            ->whereBetween('created_at', [$startDate, Carbon::now()])
            ->selectRaw('DATE(created_at) as day, COUNT(*) as aggregate_count')
            ->groupBy('day')
            ->pluck('aggregate_count', 'day');

        return collect(range(6, 0))
            ->map(function (int $daysAgo) use ($rows): int {
                $day = Carbon::today()->subDays($daysAgo)->toDateString();

                return (int) ($rows[$day] ?? 0);
            })
            ->toArray();
    }
}

