<?php

namespace App\Policies;

use App\Models\User;

class SellerPolicy
{
    public function anyActions(User $user): bool
    {
        return $user->hasRole('super_admin');
    }
}
