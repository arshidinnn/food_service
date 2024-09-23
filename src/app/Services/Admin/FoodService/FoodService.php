<?php

namespace App\Services\Admin\FoodService;

use App\Facades\StorageFacade;
use App\Http\Requests\Admin\Food\StoreFoodRequest;
use App\Http\Requests\Admin\Food\UpdateFoodRequest;
use App\Models\Food;
use App\Models\Seller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FoodService
{
    /**
     * @throws Exception
     */
    public function store(StoreFoodRequest $request) {
        /** @var Seller $seller */
        DB::beginTransaction();

        try {
            $imageUrl = StorageFacade::handleImageUpload($request->file('image'), 'foods');

            /** @var User $user */
            $user = Auth::user();

            $seller = $user->seller()->first();

            $food = $seller->foods()->create([
                'title' => $request->get('title'),
                'description' => $request->get('description') ?? null,
                'price' => $request->get('price'),
                'quantity' => $request->get('quantity'),
                'category_id' => $request->get('category'),
                'unit' => $request->get('unit'),
                'image' => $imageUrl,
            ]);

            DB::commit();

            return $food;

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to create food item: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function update(UpdateFoodRequest $request, Food $food): Food
    {
        DB::beginTransaction();

        try {
            if ($request->hasFile('image')) {
                StorageFacade::updateImage($request->file('image'), $food, 'foods');
            }

            $food->update([
                'title' => $request->get('title', $food->title),
                'description' => $request->get('description', $food->description),
                'price' => $request->get('price', $food->price),
                'quantity' => $request->get('quantity', $food->quantity),
                'category_id' => $request->get('category', $food->category_id),
                'unit' => $request->get('unit', $food->unit)
            ]);

            DB::commit();

            return $food;

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to update food item: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function delete(Food $food): void
    {
        DB::beginTransaction();

        try {
            StorageFacade::deleteImage($food);
            $food->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to delete food item: ' . $e->getMessage());
        }
    }
}
