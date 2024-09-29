<?php

namespace App\Policies;

use App\Models\Food;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FoodPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('owner') || $user->hasRole('manager');
    }

    public function view(User $user, Food $food): bool
    {
        return $user->hasRole('owner') || $user->hasRole('manager');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('owner') || $user->hasRole('manager');
    }

    public function update(User $user, Food $food): bool
    {
        return $user->hasRole('owner') || $user->hasRole('manager');
    }

    public function delete(User $user, Food $food): bool
    {
        return $user->hasRole('owner') || $user->hasRole('manager');
    }
}
