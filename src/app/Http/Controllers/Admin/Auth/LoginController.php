<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm(): View
    {
        return view('admin.auth.index');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $data = [
            'email' => $request->str('email'),
            'password' => $request->str('password')
        ];

        if (!Auth::attempt($data, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        return redirect()->route('admin.dashboard');
    }
}
