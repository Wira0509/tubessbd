<?php

namespace App\Filament\Widgets;

use App\Models\ItineraryCategory;
use Filament\Widgets\ChartWidget;

class ItineraryCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Itinerary per Kategori';

    protected static ?int $sort = 1;
    protected static ?string $maxWidth = 'full';

    protected function getData(): array
    {
        $categories = ItineraryCategory::withCount('itineraries')
        ->having('itineraries_count', '>', 0) // hanya ambil kategori dengan itinerary
        ->get();
        // SELECT * FROM

        return [
            'datasets' => [
                [
                    'label' => 'Itineraries',
                    'data' => $categories->pluck('itineraries_count'),
                    'backgroundColor' => $this->generateColors($categories->count()),
                ],
            ],
            'labels' => $categories->pluck('title')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getColumns(): int
    {
        return 2; // atau 3 jika kamu ingin lebih lebar
    }

    protected function getExtraAttributes(): array
    {
        return [
            'style' => 'height: 500px;', // membuat chart tinggi
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'boxWidth' => 12,
                        'padding' => 10,
                        'font' => [
                            'size' => 11,
                        ],
                    ],
                ],
            ],
            'maintainAspectRatio' => false,
            'responsive' => true,
        ];
    }

    private function generateColors($count): array
    {
        $colors = [
            '#f87171', '#fbbf24', '#34d399', '#60a5fa', '#a78bfa',
            '#f472b6', '#fb923c', '#22d3ee', '#c084fc', '#4ade80',
            '#e879f9', '#818cf8', '#fde047', '#facc15', '#16a34a',
            '#3b82f6', '#9333ea', '#e11d48', '#7c3aed', '#ec4899',
        ];

        return array_slice($colors, 0, $count);
    }
}
