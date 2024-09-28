<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('roles:generate');

        $superAdminRole = Role::whereName('super_admin')->first();

        /** @var User $user */
        $user = User::query()->firstOrCreate(
            ['email' => 'admin@food.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@food.com',
                'password' => 'password',
                'is_admin' => true
            ]
        );

        if ($superAdminRole) {
            $user->roles()->syncWithoutDetaching([$superAdminRole->id]);
        }
    }
}
