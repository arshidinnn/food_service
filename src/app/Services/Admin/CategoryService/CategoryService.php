<?php

namespace App\Services\Admin\CategoryService;

use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Models\Category;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    public function get(): array
    {
        /** @var User $user */
        $user = Auth::user();

        $seller = $user->seller()->first();

        return $seller->categories()->get()->toArray();
    }

    public function store(CategoryRequest $request): void
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Seller $seller*/
        $seller = $user->seller()->first();

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
