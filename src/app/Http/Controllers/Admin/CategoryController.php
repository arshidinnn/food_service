<?php

namespace App\Http\Controllers\Admin;

use App\Facades\CategoryFacade as Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Models\Category as CategoryModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        Category::store($request);

        return response()->json([
            'success' => 'Category created successfully'
        ]);
    }

    public function update(CategoryRequest $request, CategoryModel $category): RedirectResponse
    {
        if ($request->str('name') == $category->name) {
            return back();
        }

        Category::update($request, $category);

        return back()
            ->with('success', __('Category updated successfully'));
    }

    public function destroy(CategoryModel $category): RedirectResponse
    {
        Category::delete($category);

        return back()
            ->with('success', __('Category deleted successfully'));
    }
}
