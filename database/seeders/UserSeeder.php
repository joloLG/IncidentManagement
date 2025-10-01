<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Alice',
                'last_name' => 'Anderson',
                'email' => 'alice@example.com',
                'password' => Hash::make('password'),
                'mobile_number' => '555-0101',
                'age' => 30,
                'address' => '123 Main Street, Springfield',
                'role' => 'admin',
            ],
            [
                'first_name' => 'Bob',
                'last_name' => 'Baker',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
                'mobile_number' => '555-0102',
                'age' => 28,
                'address' => '456 Elm Street, Springfield',
                'role' => 'user',
            ],
            [
                'first_name' => 'Carol',
                'last_name' => 'Carter',
                'email' => 'carol@example.com',
                'password' => Hash::make('password'),
                'mobile_number' => '555-0103',
                'age' => 34,
                'address' => '789 Oak Street, Springfield',
                'role' => 'provider',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
