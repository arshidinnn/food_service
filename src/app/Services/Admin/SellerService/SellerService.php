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
        DB::transaction(function() use ($request) {
            $user = (new FindOrCreateUserAction())->run(CreateUserData::from([
                'email' => $request->string('email'),
                'role' => 'owner',
            ]));

            (new CreateSellerAction())->run(CreateSellerData::from($request->validated()), $user);

            Notification::notifyUser($user, 'owner', isset($user->temporary_password));
        });

        return $this->redirectToSellers(__('Seller created successfully'));
    }

    public function update(UpdateSellerRequest $request, Seller $seller): RedirectResponse
    {
        (new UpdateSellerAction())->run($seller, CreateSellerData::from($request->validated()));

        return $this->redirectToSellers(__('Seller updated successfully'));
    }

    /**
     * Redirect to the sellers index with a success message.
     *
     * @param string $message
     * @return RedirectResponse
     */
    protected function redirectToSellers(string $message): RedirectResponse
    {
        return redirect()->route('admin.sellers.index')->with('success', $message);
    }
}
