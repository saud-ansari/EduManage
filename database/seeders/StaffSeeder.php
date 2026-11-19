<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'staff@edumanage.com'
            ],
            [
                'name' => 'EduManage Staff',
                'password' => Hash::make('Staff@123'),
                'role' => 'staff',
            ]
        );
    }
}
