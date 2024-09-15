<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'admin@food.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Adminov',
                'email' => 'admin@food.com',
                'password' => 'password',
                'is_admin' => true
            ]
        );
    }
}
