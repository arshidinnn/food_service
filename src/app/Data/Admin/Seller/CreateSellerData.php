<?php

namespace App\Data\Admin\Seller;

use Spatie\LaravelData\Data;

class CreateSellerData extends Data
{
    public function __construct(
        public string $name,
        public string $reg_number,
        public string $bin
    ){}
}
