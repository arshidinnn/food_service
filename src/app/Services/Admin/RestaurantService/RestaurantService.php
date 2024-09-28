<?php

namespace App\Services\Admin\RestaurantService;

use App\Actions\Admin\Restaurant\CreateRestaurantAction;
use App\Actions\Admin\Restaurant\UpdateRestaurantAction;
use App\Data\Admin\Restaurant\CreateRestaurantData;
use App\Data\Admin\Restaurant\UpdateRestaurantData;
use App\Facades\StorageFacade;
use App\Http\Requests\Admin\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Admin\Restaurant\UpdateRestaurantRequest;
use App\Models\Restaurant;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestaurantService
{
    public function get(): LengthAwarePaginator
    {
        /** @var User $user */
        $user = Auth::user();
        return $this->getRestaurantsBasedOnUserRole($user);
    }

    public function store(StoreRestaurantRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $seller = $this->findSellerForUser($user, $request);

        DB::transaction(function () use ($request, $seller) {
            $imageUrl = StorageFacade::handleImageUpload($request->file('image'), 'restaurants');

            $data = CreateRestaurantData::from([
                'name' => $request->string('name'),
                'description' => $request->string('description'),
                'image' => $imageUrl,
            ]);

            (new CreateRestaurantAction())->run($data, $seller);
        });

        return $this->redirectToRestaurants(__('Restaurant created successfully.'));
    }

    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): RedirectResponse
    {
        DB::transaction(function () use ($request, $restaurant) {
            $image = $request->hasFile('image')
                ? StorageFacade::updateImage($request->file('image'), $restaurant, 'restaurants')
                : $restaurant->image;

            $data = UpdateRestaurantData::from([
                'name' => $request->string('name'),
                'description' => $request->string('description'),
                'image' => $image
            ]);

            (new UpdateRestaurantAction())->run($restaurant, $data);
        });

        return $this->redirectToRestaurants(__('Restaurant updated successfully.'));
    }

    /**
     * Finds the seller for a user, depending on their role.
     *
     * @param User $user
     * @param StoreRestaurantRequest $request
     * @return Seller
     */
    protected function findSellerForUser(User $user, StoreRestaurantRequest $request): Seller
    {
        return $user->hasRole('super_admin')
            ? Seller::whereName($request->string('seller'))->first()
            : $user->seller()->first();
    }

    /**
     * Retrieves restaurants based on the user's role.
     *
     * @param User $user
     * @return LengthAwarePaginator
     */
    protected function getRestaurantsBasedOnUserRole(User $user): LengthAwarePaginator
    {
        return $user->hasRole('super_admin')
            ? Restaurant::query()->paginate(5)
            : Restaurant::whereSellerId($user->seller()->value('id'))->paginate(5);
    }

    /**
     * Redirects to the restaurant index route with a success message.
     *
     * @param string $message
     * @return RedirectResponse
     */
    protected function redirectToRestaurants(string $message): RedirectResponse
    {
        return redirect()->route('admin.restaurants.index')->with('success', $message);
    }
}
