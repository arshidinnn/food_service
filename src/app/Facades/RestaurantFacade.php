<?php

namespace App\Facades;

use App\Services\Admin\RestaurantService\RestaurantService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void store(\App\Http\Requests\Admin\Restaurant\StoreRestaurantRequest $request)
 * @method static void update(\App\Http\Requests\Admin\Restaurant\UpdateRestaurantRequest $request, \App\Models\Restaurant $restaurant)
 *
 * @see RestaurantService
 */
class RestaurantFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return RestaurantService::class;
    }
}
