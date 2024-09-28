<?php

namespace App\Data\Admin\Restaurant;


use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CreateRestaurantData extends Data
{
    public function __construct(
        public string $name,
        public Optional|string $description,
        public string $image
    ){}
}
