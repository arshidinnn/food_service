<?php

namespace App\Data\Admin\Food;

use App\Enums\UnitType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CreateFoodData extends Data
{
    public function __construct(
        public string $title,
        public string $description,
        public string $image,
        public string $price,
        public string $quantity,
        public string $categoryId,
        public UnitType $unit,
    ){}
}
