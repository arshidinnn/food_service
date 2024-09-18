<?php

namespace App\Http\Requests\Admin\Seller;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSellerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'bin' => 'required|string|max:12|unique:sellers,bin',
            'reg_number' => 'required|string|max:50',
        ];
    }
}
