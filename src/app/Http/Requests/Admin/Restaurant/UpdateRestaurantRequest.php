<?php

namespace App\Http\Requests\Admin\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image' => 'nullable|mimes:jpg,jpeg,png|max:10240',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500'
        ];
    }
}
