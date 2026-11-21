<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentStudents extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Student::query()
                    ->with('courseDetails')
                    ->latest()
                    ->limit(5)
            )
            ->heading('Recent Student Registrations')
            ->striped()
            ->paginated(true)
            ->columns([

                TextColumn::make('name')
                    ->label('Student')
                    ->searchable()
                    ->weight('medium')
                    ->description(fn (Student $record): string => $record->email)
                    ->icon('heroicon-m-user-circle')
                    ->iconColor('gray')
                    ->size('sm'),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->placeholder('—')
                    ->icon('heroicon-m-phone')
                    ->iconColor('gray')
                    ->size('sm'),

                TextColumn::make('courseDetails.name')
                    ->label('Course')
                    ->badge()
                    ->color('info')
                    ->placeholder('Not assigned'),

                TextColumn::make('created_at')
                    ->label('Registered')
                    ->date('d M Y')
                    ->description(fn (Student $record): string => 
                        $record->created_at->diffForHumans()
                    )
                    ->sortable()
                    ->size('sm'),

            ]);
    }
}