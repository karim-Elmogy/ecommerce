<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfUserAuthenticated
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->check()) {
            return redirect('/');
        }

        return $next($request);
    }

}
