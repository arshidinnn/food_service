<?php

namespace App\Actions\Admin\Restaurant;

use App\Data\Admin\Restaurant\CreateRestaurantData;
use App\Models\Seller;

class CreateRestaurantAction
{
    public function run(CreateRestaurantData $data, Seller $seller)
    {
        return $seller->restaurant()->create([
            'name' => $data->name,
            'description' => $data->description,
            'image' => $data->image
        ]);
    }
}
