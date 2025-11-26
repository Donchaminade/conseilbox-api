<?php

namespace App\Filament\Widgets;

use App\Models\Conseil;
use Filament\Support\Colors\Color;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class PublicitePerformanceChart extends ChartWidget
{
    protected ?string $heading = 'Engagement mensuel';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $months = collect(range(5, 0))
            ->map(fn (int $i) => Carbon::now()->subMonths($i)->startOfMonth());

        $from = $months->first();

        /** @var Collection<int, array{month: string, status: string, aggregate_count: int}> $rows */
        $rows = Conseil::query()
            ->whereBetween('created_at', [$from, Carbon::now()])
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m-01') as month, status, COUNT(*) as aggregate_count")
            ->groupBy('month', 'status')
            ->get();

        $grouped = $rows->groupBy('month');

        $publishedCounts = [];
        $suggestionCounts = [];

        foreach ($months as $month) {
            $key = $month->format('Y-m-01');
            $byStatus = $grouped->get($key, collect())->groupBy('status');

            $publishedCounts[] = (int) ($byStatus->get(Conseil::STATUS_PUBLISHED, collect())->sum('aggregate_count'));
            $suggestionCounts[] = (int) collect($byStatus)->flatten(1)->sum('aggregate_count');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Conseils publiés',
                    'data' => $publishedCounts,
                    'backgroundColor' => Color::Orange[500],
                    'borderColor' => Color::Orange[400],
                    'tension' => 0.45,
                    'fill' => true,
                ],
                [
                    'label' => 'Suggestions reçues',
                    'data' => $suggestionCounts,
                    'backgroundColor' => Color::Indigo[500],
                    'borderColor' => Color::Indigo[400],
                    'borderDash' => [6, 6],
                    'type' => 'line',
                    'tension' => 0.35,
                ],
            ],
            'labels' => $months->map(fn (Carbon $month) => $month->translatedFormat('M Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

