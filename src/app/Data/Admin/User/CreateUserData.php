<?php

namespace App\Data\Admin\User;

use Spatie\LaravelData\Data;

class CreateUserData extends Data
{
    public function __construct(
        public string $email,
        public string $role
    ) {
    }
}
