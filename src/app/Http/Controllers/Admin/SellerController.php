<?php

namespace App\Http\Controllers\Admin;

use App\Facades\SellerFacade as Seller;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Seller\StoreSellerRequest;
use App\Http\Requests\Admin\Seller\UpdateSellerRequest;
use App\Http\Resources\Admin\Seller\MinifiedSellerResource;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Seller as SellerModel;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index(): View
    {
        $sellers = SellerModel::whereIsBanned(false)->with('user')->get();
        $sellers = MinifiedSellerResource::collection($sellers)->toArray(\request());

        return view('admin.sellers.index', compact('sellers'));
    }

    public function create(): View
    {
        return view('admin.sellers.create');
    }

    public function edit(SellerModel $seller): View
    {
        $seller = new MinifiedSellerResource($seller);
        $seller = $seller->toArray(\request());
        return view('admin.sellers.edit', compact('seller'));
    }

    public function store(StoreSellerRequest $request): RedirectResponse
    {
        Seller::store($request);
        return redirect()->route('admin.sellers.index');
    }

    public function update(UpdateSellerRequest $request, string $id): RedirectResponse
    {
        Seller::update($request, $id);
        return redirect()->route('admin.sellers.index');
    }

    public function destroy(SellerModel $seller): RedirectResponse
    {
        $seller->is_banned = true;
        $seller->save();
        return back();
    }
}
