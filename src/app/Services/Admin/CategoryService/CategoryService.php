<?php

namespace App\Services\Admin\CategoryService;

use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Models\Category;
use App\Models\Seller;

class CategoryService
{
    public function get(): array
    {
        /** @var Seller $seller */
        $seller = Seller::query()->first();

        return $seller->categories()->get()->toArray();
    }

    public function store(CategoryRequest $request): void
    {
        /** @var Seller $seller */
        $seller = Seller::query()->first();

        $seller->categories()->create([
            'name' => $request->str('name')
        ]);
    }

    public function update(CategoryRequest $request, Category $category): void
    {
        $category->name = $request->str('name');
        $category->save();
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
