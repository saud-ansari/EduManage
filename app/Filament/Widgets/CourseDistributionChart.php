<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use Filament\Widgets\ChartWidget;

class CourseDistributionChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 1;

    protected ?string $heading = 'Student Distribution by Course';
    protected ?string $description = 'Overview of student enrollment across courses.';
    protected ?string $maxHeight = '320px';

    protected function getData(): array
    {
        $courses = Course::withCount('students')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => $courses->pluck('students_count')->toArray(),
                    'backgroundColor' => [
                        '#6366F1',
                        '#EF4444',
                        '#0EA5E9',
                        '#F59E0B',
                        '#10B981',
                        '#8B5CF6',
                        '#EC4899',
                    ],
                    'borderWidth' => 2,
                    'borderColor' => '#ffffff',
                    'hoverOffset' => 8,
                ],
            ],
            'labels' => $courses->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'cutout' => '65%',
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 18,
                    ],
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
        ];
    }
}
