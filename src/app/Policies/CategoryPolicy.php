<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('owner') || $user->hasRole('manager');
    }

    public function view(User $user, Category $category): bool
    {
        return ($user->hasRole('owner') || $user->hasRole('manager'))
            && $user->seller()->first()->id == $category->seller_id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('owner') || $user->hasRole('manager');
    }

    public function update(User $user, Category $category): bool
    {
        return ($user->hasRole('owner') || $user->hasRole('manager'))
            && $user->seller()->first()->id == $category->seller_id;
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->hasRole('owner') && $user->seller()->first()->id == $category->seller_id;
    }
}
