<?php

namespace App\Facades;

use App\Services\Admin\SellerService\SellerService;
use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static void store(\App\Http\Requests\Admin\Seller\StoreSellerRequest $request)
 * @method static void update(\App\Http\Requests\Admin\Seller\UpdateSellerRequest $request, string $sellerId)
 *
 * @see SellerService
 */
class SellerFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return SellerService::class;
    }
}
