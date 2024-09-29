<?php

namespace App\Actions\Admin\Food;

use App\Data\Admin\Food\CreateFoodData;
use App\Models\Restaurant;

class CreateFoodAction
{
    public function run(CreateFoodData $data, Restaurant $restaurant)
    {
        return $restaurant
            ->foods()
            ->create([
                'title' => $data->title,
                'description' => $data->description,
                'price' => $data->price,
                'quantity' => $data->quantity,
                'unit' => $data->unit,
                'category_id' => $data->categoryId,
                'image' => $data->image,
            ]);
    }
}
