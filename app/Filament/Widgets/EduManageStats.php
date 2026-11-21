<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EduManageStats extends BaseWidget
{
    protected function getColumns(): int
    {
        return 3;
    }

    protected static ?int $sort = 1;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [

            // Total Students
            Stat::make(
                'Total Students',
                Student::count()
            )
                ->description('All active student records')
                ->descriptionIcon('heroicon-m-users')
                ->chart([5, 8, 12, 10, 18, 22, 30])
                ->color('success'),

            // Total Courses
            Stat::make('Total Courses', number_format(Course::count()))
                ->description('Courses available in the system')
                ->descriptionIcon('heroicon-m-book-open')
                ->icon('heroicon-o-academic-cap')
                ->color('info'),

            // Total Teachers
            Stat::make('Total Teachers', number_format(Teacher::count()))
                ->description('Registered teaching staff')
                ->descriptionIcon('heroicon-m-user-group')
                ->icon('heroicon-o-user-group')
                ->color('warning'),

            // New Students This Month
            Stat::make(
                'New Students This Month',
                number_format(
                    Student::whereBetween('created_at', [
                        now()->startOfMonth(),
                        now()->endOfMonth(),
                    ])->count()
                )
            )
                ->description('New registrations this month')
                ->descriptionIcon('heroicon-m-user-plus')
                ->icon('heroicon-o-user-plus')
                ->color('primary'),

            // Active Courses
            Stat::make(
                'Active Courses',
                number_format(Course::where('is_active', true)->count())
            )
                ->description('Currently available courses')
                ->descriptionIcon('heroicon-m-check-circle')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            // Unassigned Students
            Stat::make(
                'Unassigned Students',
                number_format(Student::whereNull('course_id')->count())
            )
                ->description('Students without course allocation')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->icon('heroicon-o-user-minus')
                ->color('danger'),

        ];
    }
}
