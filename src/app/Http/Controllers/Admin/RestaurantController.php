<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Admin\Restaurant\UpdateRestaurantRequest;
use App\Models\Restaurant as RestaurantModel;
use App\Facades\RestaurantFacade as Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;


class RestaurantController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', RestaurantModel::class);
        $restaurants = Restaurant::get();
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
        $this->authorize('createNew', RestaurantModel::class);
        return Restaurant::store($request);
    }

    public function update(UpdateRestaurantRequest $request, RestaurantModel $restaurant): RedirectResponse
    {
        return Restaurant::update($request, $restaurant);
    }

    public function destroy(RestaurantModel $restaurant): RedirectResponse
    {
        $this->authorize('delete', $restaurant);
        $restaurant->delete();
        return back()
            ->with('success', __('Restaurant removed successfully'));
    }
}
