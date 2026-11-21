<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TeacherInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Teacher Profile')
                    ->description('Personal and contact information of the teacher.')
                    ->icon('heroicon-o-user-circle')
                    ->schema([

                        TextEntry::make('name')
                            ->label('Full Name')
                            ->icon('heroicon-o-user')
                            ->weight('bold'),

                        TextEntry::make('email')
                            ->label('Email Address')
                            ->icon('heroicon-o-envelope')
                            ->copyable(),

                        TextEntry::make('phone')
                            ->label('Contact Number')
                            ->icon('heroicon-o-phone')
                            ->copyable(),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Assigned Courses')
                    ->description('Courses currently associated with this teacher.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([

                        TextEntry::make('courses.name')
                            ->label('Courses')
                            ->badge()
                            ->color('info')
                            ->separator(','),

                    ])
                    ->columnSpanFull(),

                Section::make('EduManage Account Information')
                    ->description('User account and record timestamps.')
                    ->icon('heroicon-o-information-circle')
                    ->schema([

                        TextEntry::make('user.name')
                            ->label('Linked User')
                            ->icon('heroicon-o-user')
                            ->placeholder('Not linked'),

                        TextEntry::make('created_at')
                            ->label('Registered On')
                            ->dateTime('d M Y, h:i A')
                            ->placeholder('Not available'),

                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime('d M Y, h:i A')
                            ->placeholder('Not available'),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

            ]);
    }
}
