<?php

namespace App\Facades;

use App\Services\Admin\SellerService\SellerService;
use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static \Illuminate\Contracts\Pagination\LengthAwarePaginator get()
 * @method static \Illuminate\Http\RedirectResponse store(\App\Http\Requests\Admin\Seller\StoreSellerRequest $request)
 * @method static \Illuminate\Http\RedirectResponse update(\App\Http\Requests\Admin\Seller\UpdateSellerRequest $request, \App\Models\Seller $seller)
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
