<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_create' => 'required|string|max:60|unique:categories,name'
        ];
    }

    public function attributes(): array
    {
        return [
            'name_create' => 'name'
        ];
    }
}
