<?php

namespace App\Facades;

use App\Services\Admin\RestaurantService\RestaurantService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Contracts\Pagination\LengthAwarePaginator get()
 * @method static \Illuminate\Http\RedirectResponse store(\App\Http\Requests\Admin\Restaurant\StoreRestaurantRequest $request)
 * @method static \Illuminate\Http\RedirectResponse update(\App\Http\Requests\Admin\Restaurant\UpdateRestaurantRequest $request, \App\Models\Restaurant $restaurant)
 *
 * @see RestaurantService
 */
class RestaurantFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return RestaurantService::class;
    }
}
