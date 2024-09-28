<?php

namespace App\Http\Requests\Admin\Restaurant;

use App\Rules\ValidSellerForAdmin;
use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image' => 'required|mimes:jpg,jpeg,png|max:10240',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'seller' => [new ValidSellerForAdmin(), 'exists:sellers,name']
        ];
    }
}
