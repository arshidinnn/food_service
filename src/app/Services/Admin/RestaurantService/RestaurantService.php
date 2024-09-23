<?php

namespace App\Services\Admin\RestaurantService;

use App\Facades\StorageFacade;
use App\Http\Requests\Admin\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Admin\Restaurant\UpdateRestaurantRequest;
use App\Models\Restaurant;
use App\Models\Seller;
use Exception;
use Illuminate\Support\Facades\DB;

class RestaurantService
{
    public function __construct() {}
    /**
     * @throws Exception
     */
    public function store(StoreRestaurantRequest $request): void
    {
        /** @var Seller|null $seller */
        $seller = Seller::query()->first();

        if (!$seller) {
            throw new Exception('Seller not found.');
        }

        DB::beginTransaction();
        try {
            $imageUrl = StorageFacade::handleImageUpload($request->file('image'), 'restaurants');

            $seller->restaurant()->create([
                'name' => $request->string('name'),
                'description' => $request->string('description') ?? null,
                'image' => $imageUrl,
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error while creating the restaurant.');
        }
    }

    /**
     * @throws Exception
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): void
    {
        DB::beginTransaction();

        try {
            $restaurant->name = $request->string('name');
            $restaurant->description = $request->string('description') ?? null;

            if ($request->hasFile('image')) {
                StorageFacade::updateImage($request->file('image'), $restaurant, 'restaurants');
            }

            $restaurant->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error while updating the restaurant.');
        }
    }


}
