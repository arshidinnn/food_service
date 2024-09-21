<?php

namespace App\Services\Admin\RestaurantService;

use App\Http\Requests\Admin\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Admin\Restaurant\UpdateRestaurantRequest;
use App\Models\Restaurant;
use App\Models\Seller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RestaurantService
{
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
            $imageUrl = $this->handleImageUpload($request);

            $seller->restaurants()->create([
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
                $this->updateImage($request, $restaurant);
            }

            $restaurant->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error while updating the restaurant.');
        }
    }

    /**
     * @throws Exception
     */
    protected function handleImageUpload(StoreRestaurantRequest $request): string
    {
        if (!$request->hasFile('image')) {
            throw new Exception('No image file provided.');
        }

        $imagePath = $request->file('image')->store('restaurants', 'public');
        return asset('storage/' . $imagePath);
    }

    protected function updateImage(UpdateRestaurantRequest $request, Restaurant $restaurant): void
    {
        if ($restaurant->image && Storage::disk('public')->exists($this->getImagePath($restaurant->image))) {
            Storage::disk('public')->delete($this->getImagePath($restaurant->image));
        }

        $imagePath = $request->file('image')->store('restaurants', 'public');
        $restaurant->image = asset('storage/' . $imagePath);
    }

    protected function getImagePath(string $imageUrl): string
    {
        return str_replace(asset('storage/'), '', $imageUrl);
    }
}
