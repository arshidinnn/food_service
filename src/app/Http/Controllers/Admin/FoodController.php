<?php

namespace App\Http\Controllers\Admin;

use App\Facades\FoodFacade as Food;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Food\StoreFoodRequest;
use App\Http\Requests\Admin\Food\UpdateFoodRequest;
use App\Models\Food as FoodModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FoodController extends Controller
{
    public function index(): View
    {
        $foods = Food::get();

        return view('admin.foods.index', compact('foods'));
    }

    public function create(): View {
        return view('admin.foods.create');
    }

    public  function store(StoreFoodRequest $request): RedirectResponse
    {
        return Food::store($request);
    }

    public function edit(FoodModel $food): View {
        return view('admin.foods.edit', compact('food'));
    }

    public function update(UpdateFoodRequest $request, FoodModel $food): RedirectResponse
    {
        return Food::update($request, $food);
    }

    public function destroy(FoodModel $food): RedirectResponse
    {
        return Food::delete($food);
    }
}
