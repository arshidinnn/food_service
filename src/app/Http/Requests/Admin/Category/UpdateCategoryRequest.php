<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_edit' => 'required|string|max:60|unique:categories,name,' . $this->route('category')->id
        ];
    }

    public function attributes(): array
    {
        return [
            'name_edit' => 'name'
        ];
    }
}
