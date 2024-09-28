<?php

namespace App\Services\Admin\SellerService;

use App\Actions\Admin\Seller\CreateSellerAction;
use App\Actions\Admin\Seller\UpdateSellerAction;
use App\Actions\Admin\User\FindOrCreateUserAction;
use App\Data\Admin\Seller\CreateSellerData;
use App\Data\Admin\User\CreateUserData;
use App\Facades\NotificationFacade as Notification;
use App\Http\Requests\Admin\Seller\StoreSellerRequest;
use App\Http\Requests\Admin\Seller\UpdateSellerRequest;
use App\Models\Seller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class SellerService
{
    public function get(): LengthAwarePaginator
    {
        return Seller::whereIsBanned(false)
            ->with('users')
            ->paginate(7);
    }

    public function store(StoreSellerRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        $data = CreateUserData::from([
            'email' => $request->string('email'),
            'role' => 'owner',
        ]);

        $user = (new FindOrCreateUserAction())->run($data);

        /**@var Seller $seller */
        (new CreateSellerAction())->run(CreateSellerData::from($request->validated()), $user);

        Notification::notifyUser($user, 'owner', isset($user->temporary_password));

        DB::commit();

        return redirect()
            ->route('admin.sellers.index')
            ->with('success', __('Seller created successfully'));
    }

    public function update(UpdateSellerRequest $request, Seller $seller): RedirectResponse
    {
        (new UpdateSellerAction())->run($seller, CreateSellerData::from($request->validated()));

        return redirect()
            ->route('admin.sellers.index')
            ->with('success', __('Seller updated successfully'));
    }
}
