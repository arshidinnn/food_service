<?php

namespace App\Actions\Admin\Seller;

use App\Data\Admin\Seller\CreateSellerData;
use App\Models\Seller;
use Spatie\LaravelData\Data;

class UpdateSellerAction extends Data
{
    public function run(Seller $seller, CreateSellerData $data): void
    {
        $seller->update([
            'name' => $data->name,
            'bin' => $data->bin,
            'reg_number' => $data->reg_number,
        ]);
    }
}
