<?php

namespace App\Actions\Admin\User;

use App\Data\Admin\User\CreateUserData;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\LaravelData\Contracts\BaseData;

class FindOrCreateUserAction
{
    public function run(CreateUserData $data): User
    {
        if (!User::emailExists($data->email)) {
            $user = $this->createNewUser($data);
        } else {
            $user = User::getUserByEmail($data->email);
        }

        $this->assignRole($user, $data->role);

        return $user;
    }

    /**
     * Create a new user with a temporary password.
     *
     * @param CreateUserData $data
     * @return User
     */
    protected function createNewUser(CreateUserData $data): User
    {
        $tempPassword = Str::random(8);

        /** @var User $user */
        $user = User::query()->create([
            'email' => $data->email,
            'temporary_password' => $tempPassword,
            'password' => $tempPassword,
            'is_admin' => true
        ]);

        return $user;
    }

    /**
     * Assign the role to the user.
     *
     * @param User $user
     * @param string $roleName
     * @return void
     */
    protected function assignRole(User $user, string $roleName): void
    {
        $role = Role::query()->where('name', $roleName)->firstOrFail();

        if (!$user->roles()->where('name', $roleName)->exists()) {
            $user->roles()->attach($role);
        }
    }
}
