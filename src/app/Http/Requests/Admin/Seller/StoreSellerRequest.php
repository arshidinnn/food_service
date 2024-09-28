<?php

namespace App\Http\Requests\Admin\Seller;

use App\Models\Seller;
use App\Models\User;
use App\Rules\CheckUniqueAssociation;
use Illuminate\Foundation\Http\FormRequest;

class StoreSellerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:sellers,name',
            'bin' => 'required|string|size:12|unique:sellers,bin',
            'reg_number' => 'required|string|max:50',
            'email' => ['required', 'email', 'max:255', new CheckUniqueAssociation(new User, 'seller')],
        ];
    }
}
