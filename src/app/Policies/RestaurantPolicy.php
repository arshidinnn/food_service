<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\User;

class RestaurantPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('owner') || $user->hasRole('super_admin');
    }

    public function view(User $user, Restaurant $restaurant): bool
    {
        if (!$user->hasRole('super_admin') &&
            !($user->hasRole('owner') && $restaurant->seller_id == $user->seller()->first()->id)) {
            return false;
        }

        return true;
    }

    public function createNew(User $user): bool
    {
        if ($user->hasRole('owner')) {
            return !$user->hasRestaurantAsOwner();
        }

        return $user->hasRole('super_admin');
    }

    public function update(User $user, Restaurant $restaurant): bool
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        return $user->hasRole('owner') && $restaurant->seller_id == $user->seller()->first()->id;
    }

    public function delete(User $user, Restaurant $restaurant): bool
    {
        return $user->hasRole('super_admin');
    }
}
