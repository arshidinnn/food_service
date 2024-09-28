<?php

namespace App\Data\Admin\Seller;

class UpdateSellerData
{
    public function __construct(
        public string $name,
        public string $reg_number,
        public string $bin
    ){}
}
