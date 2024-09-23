<?php

namespace App\Facades;

use App\Services\Admin\FoodService\FoodService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\Food store(\App\Http\Requests\Admin\Food\StoreFoodRequest $request)
 * @method static \App\Models\Food update(\App\Http\Requests\Admin\Food\UpdateFoodRequest $request, \App\Models\Food $food)
 * @method static void delete(\App\Models\Food $food)
 *
 * @see FoodService
 */
class FoodFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FoodService::class;
    }
}

