<?php

namespace App\Actions\Admin\Restaurant;

use App\Data\Admin\Restaurant\UpdateRestaurantData;
use App\Models\Restaurant;

class UpdateRestaurantAction
{
    public function run(Restaurant $restaurant, UpdateRestaurantData $data)
    {
        $restaurant->update([
            'name' => $data->name,
            'description' => $data->description,
            'image' => $data->image ?? $restaurant->image
        ]);
    }
}
