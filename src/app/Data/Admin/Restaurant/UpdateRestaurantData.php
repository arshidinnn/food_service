<?php

namespace App\Data\Admin\Restaurant;

use League\Uri\Idna\Option;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UpdateRestaurantData extends Data
{
    public function __construct(
        public string $name,
        public Optional|string $description,
        public null|string $image,
    ){}
}
