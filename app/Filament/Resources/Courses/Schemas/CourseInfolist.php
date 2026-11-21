<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Course Information')
                    ->description('Basic details and description of the course.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([

                        TextEntry::make('name')
                            ->label('Course Name')
                            ->icon('heroicon-o-book-open')
                            ->weight('bold'),

                        TextEntry::make('duration')
                            ->label('Course Duration')
                            ->icon('heroicon-o-clock')
                            ->badge()
                            ->color('gray'),

                        TextEntry::make('description')
                            ->label('Course Description')
                            ->icon('heroicon-o-document-text')
                            ->placeholder('No description available')
                            ->columnSpanFull(),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Assignment & Enrollment')
                    ->description('Teacher assignment and student enrollment details.')
                    ->icon('heroicon-o-user-group')
                    ->schema([

                        TextEntry::make('teacher.name')
                            ->label('Assigned Teacher')
                            ->icon('heroicon-o-user')
                            ->placeholder('Not Assigned'),

                        TextEntry::make('students_count')
                            ->label('Students Enrolled')
                            ->state(fn ($record) => $record->students()->count())
                            ->formatStateUsing(fn ($state) => $state . ' ' .
                                ($state == 1 ? 'Student' : 'Students'))
                            ->icon('heroicon-o-users')
                            ->badge()
                            ->color('success'),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Course Settings')
                    ->description('Course fees and current availability.')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([

                        TextEntry::make('fees')
                            ->label('Course Fees')
                            ->icon('heroicon-o-banknotes')
                            ->formatStateUsing(
                                fn ($state) => '₹' . number_format((float) $state, 2)
                            )
                            ->weight('bold'),

                        IconEntry::make('is_active')
                            ->label('Course Status')
                            ->boolean(),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Record Information')
                    ->description('Course creation and modification timestamps.')
                    ->icon('heroicon-o-information-circle')
                    ->schema([

                        TextEntry::make('created_at')
                            ->label('Created On')
                            ->icon('heroicon-o-calendar-days')
                            ->dateTime('d M Y, h:i A')
                            ->placeholder('Not available'),

                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->icon('heroicon-o-pencil-square')
                            ->dateTime('d M Y, h:i A')
                            ->placeholder('Not available'),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

            ]);
    }
}
