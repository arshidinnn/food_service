<?php

namespace App\Http\Controllers\Admin;

use App\Facades\CategoryFacade as Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category as CategoryModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', CategoryModel::class);
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('create', CategoryModel::class);
        return Category::store($request);
    }

    public function update(UpdateCategoryRequest $request, CategoryModel $category): RedirectResponse
    {
        $this->authorize('update', $category);

        if ($request->string('name_edit') == $category->name) {
            return back();
        }

        return Category::update($request, $category);
    }

    public function destroy(CategoryModel $category): RedirectResponse
    {
        $this->authorize('delete', $category);

        return Category::delete($category);
    }
}
