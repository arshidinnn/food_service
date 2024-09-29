<?php

namespace App\Services\Admin\CategoryService;

use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    public function get(): LengthAwarePaginator
    {
        return $this->getSeller()->categories()->paginate(6);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->getSeller()->categories()->create([
            'name' => $request->string('name_create')
        ]);

        return $this->redirectBack( __('Category created successfully'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update([
            'name' => $request->string('name_edit')
        ]);

        return $this->redirectBack( __('Category updated successfully'));
    }

    public function delete(Category $category): RedirectResponse
    {
        $category->delete();

        return $this->redirectBack( __('Category deleted successfully'));
    }

    /**
     * Get the seller model for the current authenticated user.
     *
     * @return Seller
     */
    protected function getSeller(): Seller
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->seller()->first();
    }

    /**
     * Redirect back with a success message.
     *
     * @param string $message
     * @return RedirectResponse
     */
    protected function redirectBack(string $message): RedirectResponse
    {
        return back()->with('success', $message);
    }
}
