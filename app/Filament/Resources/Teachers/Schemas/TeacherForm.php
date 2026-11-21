<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Teacher Information')
                    ->description('Enter the personal and contact details of the teacher.')
                    ->icon('heroicon-o-user-circle')
                    ->schema([

                        TextInput::make('name')
                            ->label('Full Name')
                            ->placeholder('Enter teacher full name')
                            ->prefixIcon('heroicon-o-user')
                            ->required()
                            ->maxLength(255)
                            ->validationMessages([
                                'required' => 'Teacher name is required.',
                            ]),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->placeholder('example@gmail.com')
                            ->prefixIcon('heroicon-o-envelope')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->validationMessages([
                                'required' => 'Email address is required.',
                                'email' => 'Please enter a valid email address.',
                                'unique' => 'This email address is already registered.',
                            ]),

                        TextInput::make('phone')
                            ->label('Contact Number')
                            ->placeholder('Enter 10-digit mobile number')
                            ->prefixIcon('heroicon-o-phone')
                            ->tel()
                            ->required()
                            ->length(10)
                            ->numeric()
                            ->validationMessages([
                                'required' => 'Contact number is required.',
                                'length' => 'Contact number must contain exactly 10 digits.',
                                'numeric' => 'Contact number must contain only digits.',
                            ]),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

            ]);
    }
}
