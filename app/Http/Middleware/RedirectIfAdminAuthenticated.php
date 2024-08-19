<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RedirectIfAdminAuthenticated
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.home'); // Redirect authenticated admin users to the admin dashboard
        }

        return $next($request);
    }
}
