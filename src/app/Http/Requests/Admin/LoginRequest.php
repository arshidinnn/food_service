<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        $this->merge([
            'remember' => $this->has('remember')
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
            'remember' => 'boolean'
        ];
    }
}
