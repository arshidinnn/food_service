<?php

namespace App\Actions\Admin\Food;

use App\Data\Admin\Food\UpdateFoodData;
use App\Models\Food;

class UpdateFoodAction
{
    public function run(UpdateFoodData $data, Food $food): bool
    {
        return $food->update([
            'title' => $data->title,
            'description' => $data->description,
            'image' => $data->image,
            'price' => $data->price,
            'quantity' => $data->quantity,
            'category_id' => $data->categoryId,
            'unit' => $data->unit,
        ]);
    }
}
