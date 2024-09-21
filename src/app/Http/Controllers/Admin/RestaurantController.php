<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Admin\Restaurant\UpdateRestaurantRequest;
use App\Http\Resources\Admin\Restaurant\MinifiedRestaurantResource;
use App\Models\Restaurant as RestaurantModel;
use App\Facades\RestaurantFacade as Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;


class RestaurantController extends Controller
{
    public function index(): View
    {
        $restaurants = RestaurantModel::query()->get();
        $restaurants = MinifiedRestaurantResource::collection($restaurants)->toArray(\request());
        return view('admin.restaurants.index', compact('restaurants'));
    }

    public function show(RestaurantModel $restaurant): View
    {
        return view('admin.restaurants.show', compact('restaurant'));
    }

    public function create(): View
    {
        return view('admin.restaurants.create');
    }

    public function edit(RestaurantModel $restaurant): View
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    public function store(StoreRestaurantRequest $request): RedirectResponse
    {
        Restaurant::store($request);
        return redirect()
            ->route('admin.restaurants.index')
            ->with('success', __('Restaurant created successfully'));
    }

    public function update(UpdateRestaurantRequest $request, RestaurantModel $restaurant): RedirectResponse
    {
        Restaurant::update($request, $restaurant);
        return redirect()
            ->route('admin.restaurants.index')
            ->with('success', __('Restaurant updated successfully'));
    }

    public function destroy(RestaurantModel $restaurant): RedirectResponse
    {
        $restaurant->delete();
        return back()
            ->with('success', __('Restaurant removed successfully'));
    }
}
