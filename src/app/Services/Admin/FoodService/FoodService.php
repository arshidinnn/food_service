<?php

namespace App\Services\Admin\FoodService;

use App\Actions\Admin\Food\CreateFoodAction;
use App\Actions\Admin\Food\UpdateFoodAction;
use App\Data\Admin\Food\CreateFoodData;
use App\Data\Admin\Food\UpdateFoodData;
use App\Facades\StorageFacade;
use App\Http\Requests\Admin\Food\StoreFoodRequest;
use App\Http\Requests\Admin\Food\UpdateFoodRequest;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\Seller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodService
{
    public function get(): LengthAwarePaginator {
        /** @var Seller $seller */
        $seller = Auth::user()->seller()->first();

        return $seller->foods()->with('category')->paginate(5);
    }
    public function store(StoreFoodRequest $request): RedirectResponse
    {
        DB::transaction(function() use ($request) {
            $imageUrl = StorageFacade::handleImageUpload($request->file('image'), 'foods');

            /** @var Restaurant $restaurant */
            $restaurant = Auth::user()->seller()->first()->restaurant()->first();

            $data = CreateFoodData::from([
                'title' => $request->get('title'),
                'description' => $request->get('description') ?? null,
                'price' => $request->get('price'),
                'quantity' => $request->get('quantity'),
                'categoryId' => $request->get('category'),
                'unit' => $request->get('unit'),
                'image' => $imageUrl,
            ]);

            (new CreateFoodAction())->run($data, $restaurant);
        });

        return $this->redirectToFoods(__('Food created successfully'));
    }

    public function update(UpdateFoodRequest $request, Food $food): RedirectResponse
    {
        DB::transaction(function() use ($request, $food) {
            $imageUrl = $request->hasFile('image')
                ? StorageFacade::updateImage($request->file('image'), $food, 'foods')
                : null;

            $data = UpdateFoodData::from([
                'title' => $request->get('title', $food->title),
                'description' => $request->get('description', $food->description),
                'image' => $imageUrl ?? $food->image,
                'price' => $request->get('price', $food->price),
                'quantity' => $request->get('quantity', $food->quantity),
                'categoryId' => $request->get('category', $food->category_id),
                'unit' => $request->get('unit', $food->unit),
            ]);

            (new UpdateFoodAction())->run($data, $food);
        });

        return $this->redirectToFoods(__('Food updated successfully'));
    }

    public function delete(Food $food): RedirectResponse
    {
        DB::transaction(function() use ($food) {
            StorageFacade::deleteImage($food);
            $food->delete();
        });

        return redirect()
            ->back()
            ->with('success', __('Food deleted successfully'));

    }

    /**
     * Redirect to the sellers index with a success message.
     *
     * @param string $message
     * @return RedirectResponse
     *
     */
    protected function redirectToFoods(string $message): RedirectResponse
    {
        return redirect()->route('admin.foods.index')->with('success', $message);
    }
}
