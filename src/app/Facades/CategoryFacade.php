<?php

namespace App\Facades;

use App\Services\Admin\CategoryService\CategoryService;
use Illuminate\Support\Facades\Facade;

/**
 * @method \Illuminate\Contracts\Pagination\LengthAwarePaginator get()
 * @method static \Illuminate\Http\RedirectResponse store(\App\Http\Requests\Admin\Category\StoreCategoryRequest $request)
 * @method static \Illuminate\Http\RedirectResponse update(\App\Http\Requests\Admin\Category\UpdateCategoryRequest $request, \App\Models\Category $category)
 * @method static \Illuminate\Http\RedirectResponse delete(\App\Models\Category $category)
 *
 * @see CategoryService
 */
class CategoryFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return CategoryService::class;
    }
}
