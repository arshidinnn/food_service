<?php

namespace App\Http\Controllers\Admin;

use App\Facades\SellerFacade as Seller;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Seller\StoreSellerRequest;
use App\Http\Requests\Admin\Seller\UpdateSellerRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Seller as SellerModel;

class SellerController extends Controller
{
    public function index(): View
    {
        $this->authorize('anyActions', SellerModel::class);
        $sellers = Seller::get();
        return view('admin.sellers.index', compact('sellers'));
    }

    public function create(): View
    {
        $this->authorize('anyActions', SellerModel::class);
        return view('admin.sellers.create');
    }

    public function edit(SellerModel $seller): View
    {
        $this->authorize('anyActions', SellerModel::class);
        return view('admin.sellers.edit', compact('seller'));
    }

    public function store(StoreSellerRequest $request): RedirectResponse
    {
        $this->authorize('anyActions', SellerModel::class);

        return Seller::store($request);

    }

    public function update(UpdateSellerRequest $request, SellerModel $seller): RedirectResponse
    {
        $this->authorize('anyActions', SellerModel::class);

        return Seller::update($request, $seller);
    }

    public function destroy(SellerModel $seller): RedirectResponse
    {
        $this->authorize('anyActions', SellerModel::class);

        $seller->is_banned = true;
        $seller->save();
        return back()
            ->with('success', __('Seller removed successfully'));
    }
}
