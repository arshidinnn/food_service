<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\CompleteProfileRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfileCompletionController extends Controller
{
    public function index(): View
    {
        return view('admin.auth.complete_profile');
    }

    public function update(CompleteProfileRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $user -> first_name = $request->str('first_name');
        $user -> last_name = $request->str('last_name');
        $user-> password = $request->str('password');
        $user->temporary_password = null;
        $user->save();

        return redirect()->route('admin.dashboard');
    }
}
