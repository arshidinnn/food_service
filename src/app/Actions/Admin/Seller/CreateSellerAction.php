<?php

namespace App\Actions\Admin\Seller;

use App\Data\Admin\Seller\CreateSellerData;
use App\Models\User;

class CreateSellerAction
{
    public function run(CreateSellerData $data, User $user) {
        return $user->seller()->create([
            'name' => $data->name,
            'reg_number' => $data->reg_number,
            'bin' => $data->bin
        ]);
    }
}
