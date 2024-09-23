<?php

namespace App\Enums;

enum UnitType: string
{
    case Kilogram = 'kg';
    case Gram = 'g';
    case Liter = 'l';
    case Milliliter = 'ml';
    case Piece = 'pcs';

    public static function getValues(): array {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
