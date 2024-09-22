<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfProfileComplete
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            redirect()->route('admin.loginForm');
        }

        /** @var User $user */
        $user = Auth::user();

        if (!empty($user->first_name) && !empty($user->last_name)) {
            return redirect()->back();
        }

        return $next($request);
    }
}
