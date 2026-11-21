<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Course Details')
                    ->description('Enter the basic information about the course.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([

                        TextInput::make('name')
                            ->label('Course Name')
                            ->placeholder('Example: Full Stack Web Development')
                            ->prefixIcon('heroicon-o-book-open')
                            ->required()
                            ->maxLength(255)
                            ->validationMessages([
                                'required' => 'Course name is required.',
                            ]),

                        TextInput::make('duration')
                            ->label('Course Duration')
                            ->placeholder('Example: 3 Months')
                            ->prefixIcon('heroicon-o-clock')
                            ->required()
                            ->maxLength(255)
                            ->validationMessages([
                                'required' => 'Course duration is required.',
                            ]),

                        Textarea::make('description')
                            ->label('Course Description')
                            ->placeholder('Enter a brief description of the course...')
                            ->rows(4)
                            ->nullable()
                            ->columnSpanFull(),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Course Assignment')
                    ->description('Assign a teacher responsible for this course.')
                    ->icon('heroicon-o-user-group')
                    ->schema([

                        Select::make('teacher_id')
                            ->label('Assigned Teacher')
                            ->relationship('teacher', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Select a teacher')
                            ->nullable()
                            ->native(false)
                            ->helperText('Choose the teacher who will conduct this course.')
                            ->columnSpanFull(),

                    ])
                    ->columnSpanFull(),

                Section::make('Course Settings')
                    ->description('Configure course fees and availability.')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([

                        TextInput::make('fees')
                            ->label('Course Fees')
                            ->placeholder('Enter course fees')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->prefix('₹')
                            ->step(0.01)
                            ->validationMessages([
                                'required' => 'Course fees are required.',
                                'numeric' => 'Please enter a valid amount.',
                                'min' => 'Course fees cannot be negative.',
                            ]),

                        Toggle::make('is_active')
                            ->label('Active Course')
                            ->helperText('Enable this option to make the course available.')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger')
                            ->inline(false),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

            ]);
    }
}
