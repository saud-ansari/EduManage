<?php

namespace App\Filament\Resources\Courses\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class CoursesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('name')
                    ->label('Course Name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('teacher.name')
                    ->label('Assigned Teacher')
                    ->placeholder('Not Assigned')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('duration')
                    ->label('Duration')
                    ->badge()
                    ->color('warning'),

                TextColumn::make('fees')
                    ->label('Course Fees')
                    ->formatStateUsing(
                        fn($state) => '₹' . number_format((float) $state, 2)
                    )
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('students_count')
                    ->label('Students Enrolled')
                    ->counts('students')
                    ->formatStateUsing(fn($state) => $state . ' ' .
                        ($state == 1 ? 'Student' : 'Students'))
                    ->badge()
                    ->color('success')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Created On')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->defaultSort('id', 'desc')
            ->striped()
            ->paginated([10, 25, 50])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation(),
            ]);
    }
}
