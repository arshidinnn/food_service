<?php

namespace App\Enums;

enum RoleType: string
{
    case SuperAdmin = 'super_admin';
    case Owner = 'owner';
    case Manager = 'manager';
    case HeadChef = 'chef';

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
