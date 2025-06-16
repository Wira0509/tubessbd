<?php

namespace App\Filament\Widgets;

use App\Models\Itinerary;
use Filament\Widgets\ChartWidget;

class MostCommentedItinerariesChart extends ChartWidget
{
    protected static ?string $heading = 'Itinerary dengan Komentar Terbanyak';
    protected static ?string $maxWidth = 'full';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $itineraries = Itinerary::withCount('comments')
            ->orderByDesc('comments_count')
            ->take(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Komentar',
                    'data' => $itineraries->pluck('comments_count'),
                    'backgroundColor' => '#60a5fa'
                ],
            ],
            'labels' => $itineraries->pluck('title')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getExtraAttributes(): array
    {
        return [
            'style' => 'height: 500px;',
        ];
    }
}
