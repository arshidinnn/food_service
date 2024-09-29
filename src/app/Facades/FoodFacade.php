<?php

namespace App\Facades;

use App\Services\Admin\FoodService\FoodService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Pagination\LengthAwarePaginator get()
 * @method static \Illuminate\Http\RedirectResponse store(\App\Http\Requests\Admin\Food\StoreFoodRequest $request)
 * @method static \Illuminate\Http\RedirectResponse update(\App\Http\Requests\Admin\Food\UpdateFoodRequest $request, \App\Models\Food $food)
 * @method static \Illuminate\Http\RedirectResponse delete(\App\Models\Food $food)
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
