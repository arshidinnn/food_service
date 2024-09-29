<?php

namespace App\Http\Requests\Admin\Food;

use App\Enums\UnitType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreFoodRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'image' => 'required|mimes:jpg,jpeg,png|max:10240',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'unit' => ['required', new Enum(UnitType::class)]
        ];
    }
}
