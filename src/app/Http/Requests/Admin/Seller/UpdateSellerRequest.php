<?php

namespace App\Http\Requests\Admin\Seller;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSellerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:sellers,name,' . $this->route('seller'),
            'bin' => 'required|string|size:12|unique:sellers,bin,' . $this->route('seller'),
            'reg_number' => 'required|string|max:50',
        ];
    }
}

