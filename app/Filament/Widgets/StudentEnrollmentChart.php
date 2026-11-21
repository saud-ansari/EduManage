<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;

class StudentEnrollmentChart extends ChartWidget
{

    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 1;
    protected ?string $heading = 'Monthly Student Registrations';
    protected ?string $description = 'Overview of student enrollment trends throughout the year.';
    protected function getData(): array
    {
        $monthlyData = Student::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month');

        $data = [];

        for ($month = 1; $month <= 12; $month++) {
            $data[] = $monthlyData->get($month, 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'New Students',
                    'data' => $data,
                ],
            ],

            'labels' => [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}