<?php

namespace App\Facades;

use App\Services\Admin\CategoryService\CategoryService;
use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\Admin\CategoryService\CategoryService
 *
 * @method static array get()
 * @method static void store(\App\Http\Requests\Admin\Category\CategoryRequest $request)
 * @method static void update(\App\Http\Requests\Admin\Category\CategoryRequest $request, \App\Models\Category $category)
 * @method static void delete(\App\Models\Category $category)
 */
class CategoryFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return CategoryService::class;
    }
}
