<?php

namespace App\Http\Controllers\Admin;

use App\Facades\FoodFacade as Food;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Food\StoreFoodRequest;
use App\Http\Requests\Admin\Food\UpdateFoodRequest;
use App\Http\Resources\Admin\Food\MinifiedFoodResource;
use App\Models\Food as FoodModel;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FoodController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Seller $seller */
        $seller = $user->seller()->first();

        $foods = MinifiedFoodResource::collection($seller->foods()->get())->toArray(\request());
        return view('admin.foods.index', compact('foods'));
    }

    public function create(): View {
        return view('admin.foods.create');
    }


    public  function store(StoreFoodRequest $request): RedirectResponse
    {
        Food::store($request);
        return redirect()
            ->route('admin.foods.index')
            ->with('success', __('Food created successfully'));
    }

    public function show(FoodModel $food) {}

    public function edit(FoodModel $food): View {
        return view('admin.foods.edit', compact('food'));
    }

    public function update(UpdateFoodRequest $request, FoodModel $food): RedirectResponse
    {
        Food::update($request, $food);

        return redirect()
            ->route('admin.foods.index')
            ->with('success', __('Food updated successfully'));
    }

    public function destroy(FoodModel $food): RedirectResponse
    {
        Food::delete($food);

        return redirect()
            ->route('admin.foods.index')
            ->with('success', __('Food deleted successfully'));
    }
}
